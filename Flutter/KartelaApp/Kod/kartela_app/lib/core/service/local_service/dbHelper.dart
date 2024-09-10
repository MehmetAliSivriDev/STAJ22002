// ignore_for_file: file_names

import 'dart:io';

import 'package:kartela_app/core/model/kartela_data_model.dart';
import 'package:kartela_app/core/model/order_model.dart';
import 'package:kartela_app/core/model/order_number_model.dart';
import 'package:path_provider/path_provider.dart';
import 'package:sqflite/sqflite.dart';

class DbHelper {
  //Kartela Data Tablosu Bilgileri
  String tblName = 'KartelaData';
  String colKDataId = 'Id';
  String colKDataBar = 'Bar';
  String colKDataVaryant = 'Varyant';
  String colKDataDesen = 'Desen';
  String colKDataCom = 'Com';
  String colKDataDesenKod = 'DesenKod';
  String colKDataKG = 'Kg';
  String colKDataEN = 'En';
  String colKDataRenk = 'Renk';
  String colKDataTip = 'Tip';
  String colKDatakEn = 'KEn';
  String colKDataTarih = 'Tarih';
  String colKDataActive = 'Active';

  //Sipariş Tablosu Bilgileri
  String tblNameOrders = 'Orders';
  String colOId = 'Id';
  String colOCompanyName = 'CompanyName';
  String colOEmail = 'Email';
  String colOPhone = 'Phone';
  String colOKartelaBar = 'KartelaBar';
  String colOCount = 'orderCount';
  String colODate = 'ODate';
  String colOHour = 'OHour';
  String colOOrderNumber = 'OrderNumber';
  String colODeliveredCount = 'DeliveredCount';
  String colOisActive = 'isActive';

  DbHelper._internal();
  static final _dbHelper = DbHelper._internal();

  factory DbHelper() {
    return _dbHelper;
  }

  static Database? _db;

  Future<Database> get db async {
    _db ??= await createDb();
    return _db!;
  }

  Future<Database> createDb() async {
    Directory directory = await getApplicationDocumentsDirectory();
    String path = "${directory.path}PeyKartela.db";
    var kartelaDb = await openDatabase(path, version: 1, onCreate: create);
    return kartelaDb;
  }

  void create(Database db, int version) async {
    await db.execute('''
    CREATE TABLE $tblName (
      $colKDataId INTEGER PRIMARY KEY AUTOINCREMENT,
      $colKDataBar TEXT,
      $colKDataVaryant TEXT,
      $colKDataDesen TEXT,
      $colKDataCom TEXT,
      $colKDataDesenKod TEXT,
      $colKDataKG TEXT,
      $colKDataEN TEXT,
      $colKDataRenk TEXT,
      $colKDataTip TEXT,
      $colKDatakEn TEXT,
      $colKDataTarih TEXT,
      $colKDataActive TEXT
    )    
    ''');

    await db.execute('''
    CREATE TABLE $tblNameOrders (
      $colOId INTEGER PRIMARY KEY AUTOINCREMENT,
      $colOCompanyName TEXT,
      $colOEmail TEXT,
      $colOPhone TEXT,
      $colOKartelaBar TEXT,
      $colOCount TEXT,
      $colODate TEXT,
      $colOHour TEXT,
      $colOOrderNumber TEXT,
      $colODeliveredCount TEXT,
      $colOisActive TEXT
    )    
    ''');
  }

  //Quaries

  //Kartela

  Future<List> deleteKartelaTable() async {
    Database db = await this.db;
    var result = await db.rawQuery('DROP TABLE $tblName');
    return result;
  }

  Future<List<KartelaDataModel>?> getKartelaData() async {
    Database db = await this.db;
    var result =
        await db.transaction((txn) => txn.rawQuery('SELECT * FROM $tblName'));
    // var result = await db.rawQuery('SELECT * FROM $tblName');
    return result.map((data) => KartelaDataModel.fromJson(data)).toList();
  }

  Future<List<KartelaDataModel>?> getKartelaDataWBarcode(
      {required String barcode}) async {
    Database db = await this.db;
    var result = await db
        .query(tblName, where: '$colKDataBar = ?', whereArgs: [barcode]);
    return result.map((data) => KartelaDataModel.fromJson(data)).toList();
  }

  Future<List<KartelaDataModel>?> getKartelaDataWTypes(
      {required String type}) async {
    Database db = await this.db;
    var result =
        await db.query(tblName, where: '$colKDataTip = ?', whereArgs: [type]);
    return result.map((data) => KartelaDataModel.fromJson(data)).toList();
  }

  Future<List<KartelaDataModel>?> getKartelaDataWColors(
      {required String color}) async {
    Database db = await this.db;
    var result =
        await db.query(tblName, where: '$colKDataRenk = ?', whereArgs: [color]);
    return result.map((data) => KartelaDataModel.fromJson(data)).toList();
  }

  Future<List<String>?> getKartelaDataTypes() async {
    Database db = await this.db;
    var result = await db.transaction(
        (txn) => txn.rawQuery('SELECT DISTINCT $colKDataTip FROM $tblName'));
    return result
        .map((data) => KartelaDataModel.fromJsonJustType(data).tip ?? "")
        .toList();
  }

  Future<List<String>?> getKartelaDataColors() async {
    Database db = await this.db;
    var result = await db.transaction(
        (txn) => txn.rawQuery('SELECT DISTINCT $colKDataRenk FROM $tblName'));
    return result
        .map((data) => KartelaDataModel.fromJsonJustColor(data).renk ?? "")
        .toList();
  }

  Future<int> kartelaDataAdd(
      {required KartelaDataModel kartelaDataModel}) async {
    Database db = await this.db;
    var result = await db.insert(tblName, kartelaDataModel.toJson());
    return result;
  }

  Future<int> deleteKartelaData({required String id}) async {
    Database db = await this.db;
    var result =
        await db.rawDelete('DELETE FROM $tblName WHERE $colKDataId = $id');
    return result;
  }

  Future<int> deleteAllKartelaData() async {
    Database db = await this.db;
    var result = await db.rawDelete('DELETE FROM $tblName');
    return result;
  }

  //Orders

  Future<List<OrderModel>?> getOrdersWEmail({required String email}) async {
    Database db = await this.db;
    var result = await db.transaction((txn) => txn.rawQuery('''
        SELECT o.$colOId,k.$colKDataBar, k.$colKDataVaryant, k.$colKDataDesen, k.$colKDataCom, k.$colKDataDesenKod,
         k.$colKDataKG,k.$colKDataEN, k.$colKDataRenk, k.$colKDataTip, k.$colKDatakEn, k.$colKDataTarih, 
         k.$colKDataActive,o.$colOCount,o.$colODate,o.$colOHour,o.$colOCompanyName,o.$colOEmail,o.$colOPhone, 
         o.$colOOrderNumber,o.$colODeliveredCount,o.$colOisActive
         FROM $tblName k, $tblNameOrders o WHERE k.$colKDataBar = o.$colOKartelaBar
         AND o.$colOEmail = ?
         ''', [email]));

    return result.map((data) => OrderModel.fromJson(data)).toList();
  }

  Future<List<OrderModel>?> getOrdersWEmailAONumber(
      {required String email, required String orderNumber}) async {
    Database db = await this.db;
    var result = await db.transaction((txn) => txn.rawQuery('''
        SELECT o.$colOId,k.$colKDataBar, k.$colKDataVaryant, k.$colKDataDesen, k.$colKDataCom, k.$colKDataDesenKod,
         k.$colKDataKG,k.$colKDataEN, k.$colKDataRenk, k.$colKDataTip, k.$colKDatakEn, k.$colKDataTarih, 
         k.$colKDataActive,o.$colOCount,o.$colODate,o.$colOHour,o.$colOCompanyName,o.$colOEmail,o.$colOPhone, 
         o.$colOOrderNumber,o.$colODeliveredCount,o.$colOisActive
         FROM $tblName k, $tblNameOrders o WHERE k.$colKDataBar = o.$colOKartelaBar
         AND o.$colOEmail = ? AND o.$colOOrderNumber = ?
         ''', [email, orderNumber]));

    return result.map((data) => OrderModel.fromJson(data)).toList();
  }

  Future<List<OrderNumberModel>?> getOrderNumbersWEmail(
      {required String email}) async {
    Database db = await this.db;
    var result = await db.transaction((txn) => txn.rawQuery('''
        SELECT DISTINCT o.$colOOrderNumber, COUNT(o.$colOOrderNumber) AS Count FROM $tblNameOrders o WHERE
         o.$colOEmail = ? GROUP BY o.$colOOrderNumber
         ''', [email]));

    return result.map((data) => OrderNumberModel.fromJson(data)).toList();
  }

  Future<List<OrderModel>?> getOrders() async {
    Database db = await this.db;
    var result = await db.transaction((txn) => txn.rawQuery('''
        SELECT o.$colOId,k.$colKDataBar, k.$colKDataVaryant, k.$colKDataDesen, k.$colKDataCom, k.$colKDataDesenKod,
         k.$colKDataKG,k.$colKDataEN, k.$colKDataRenk, k.$colKDataTip, k.$colKDatakEn, k.$colKDataTarih, 
         k.$colKDataActive,o.$colOCount,o.$colODate,o.$colOHour,o.$colOCompanyName,o.$colOEmail,o.$colOPhone,
         o.$colOOrderNumber,o.$colODeliveredCount,o.$colOisActive
         FROM $tblName k, $tblNameOrders o WHERE k.$colKDataBar = o.$colOKartelaBar ORDER BY o.$colOId
         '''));

    return result.map((data) => OrderModel.fromJson(data)).toList();
  }

  Future<int> orderAdd(
      {required OrderModel orderModel,
      required String companyName,
      required String email,
      required String phone,
      required String orderNumber,
      required DateTime datetime}) async {
    if (orderModel.orderCount != null &&
        orderModel.product != null &&
        orderModel.product!.bar != null) {
      // DateTime now = DateTime.now();

      Map<String, String> map = {
        colOCompanyName: companyName,
        colOEmail: email,
        colOPhone: phone,
        colOKartelaBar: orderModel.product!.bar!,
        colOCount: orderModel.orderCount!,
        colODate:
            '${datetime.year.toString().padLeft(4, '0')}-${datetime.month.toString().padLeft(2, '0')}-${datetime.day.toString().padLeft(2, '0')}',
        colOHour:
            '${datetime.hour.toString().padLeft(2, '0')}:${datetime.minute.toString().padLeft(2, '0')}:${datetime.second.toString().padLeft(2, '0')}',
        colOOrderNumber: orderNumber,
        colODeliveredCount: "",
        colOisActive: "1"
      };
      Database db = await this.db;
      var result = await db.insert(tblNameOrders, map);
      return result;
    }

    return -1;
  }

  Future<int> orderAddFromServerData({required OrderModel orderModel}) async {
    if (orderModel.orderCount != null &&
        orderModel.product != null &&
        orderModel.product!.bar != null) {
      Database db = await this.db;
      var result = await db.insert(tblNameOrders, orderModel.toJson());
      return result;
    }

    return -1;
  }

  Future<int> deleteOrder({required String id}) async {
    Database db = await this.db;
    var result =
        await db.rawDelete('DELETE FROM $tblNameOrders WHERE $colOId = $id');
    return result;
  }

  Future<int> deleteAllOrderData() async {
    Database db = await this.db;
    var result = await db.rawDelete('DELETE FROM $tblNameOrders');
    return result;
  }
}
