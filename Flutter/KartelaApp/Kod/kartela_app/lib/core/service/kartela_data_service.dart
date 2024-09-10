import 'dart:convert';
import 'dart:io';
import 'package:easy_localization/easy_localization.dart';
import 'package:http/http.dart' as http;
import 'package:kartela_app/core/cache/cache_manager.dart';
import '../lang/locale_strings.dart';
import '../model/kartela_data_model.dart';
import '../model/order_model.dart';
import 'local_service/dbHelper.dart';
import '../../product/network/product_network_manager.dart';
import '../../product/util/custom_exception.dart';

abstract class IKartelaDataService {
  DbHelper dbHelper = DbHelper();
  Future<void> synchronizeData();
  Future<List<KartelaDataModel>?> getKartelaData();
  Future<int> ordersToServer();
  Future<void> ordersFromServerToLocale();
  Future<String> getLastOrderNumber();
}

class KartelaDataService extends IKartelaDataService {
  List _dataFromApi = [];

  @override
  Future<List<KartelaDataModel>?> getKartelaData() async {
    try {
      final response =
          await http.get(ProductNetworkManager.instance.getKartelaData);

      if (response.statusCode == HttpStatus.ok) {
        _dataFromApi = json.decode(response.body);

        return _dataFromApi
            .map((data) => KartelaDataModel.fromJson(data))
            .toList();
      } else {
        return [];
      }
    } catch (e) {
      throw CustomException(LocaleStrings.errorOccured.tr());
    }
  }

  @override
  Future<void> synchronizeData() async {
    try {
      dbHelper.createDb().then((value) => null);
      List<KartelaDataModel>? serviceData = await getKartelaData();

      if (serviceData != null) {
        await dbHelper.deleteAllKartelaData();
        for (var data in serviceData) {
          await dbHelper.kartelaDataAdd(kartelaDataModel: data);
        }
      }

      String lastOrderNumber = await getLastOrderNumber();
      // String lastOrderNumber = "";

      if (lastOrderNumber == "") {
        lastOrderNumber = "0";
      }

      await CacheManager.instance.saveLastOrderNumber(value: lastOrderNumber);
    } on CustomException catch (e) {
      throw CustomException(e.message);
    }
  }

  @override
  Future<int> ordersToServer() async {
    dbHelper.createDb().then((value) => null);
    List<OrderModel>? serviceData = await dbHelper.getOrders();
    int result = -1;
    if (serviceData != null && serviceData.isNotEmpty) {
      for (var data in serviceData) {
        if (data.product != null) {
          Map<String, String> body = {
            "CompanyName": data.companyName.toString(),
            "Email": data.email.toString(),
            "Phone": data.phone.toString(),
            "KartelaBar": data.product!.bar.toString(),
            "orderCount": data.orderCount.toString(),
            "ODate": data.date.toString(),
            "OHour": data.hour.toString(),
            "OrderNumber": data.orderNumber.toString()
          };

          final response = await http
              .post(ProductNetworkManager.instance.insertOrder, body: body);

          if (response.statusCode == HttpStatus.ok) {
            result = int.parse(json.decode(response.body));

            if (result == 0) {
              return result;
            }
          }
        }
      }
      return result;
    } else {
      return result;
    }
  }

  @override
  Future<void> ordersFromServerToLocale() async {
    try {
      List<OrderModel>? orders;

      final response = await http.get(ProductNetworkManager.instance.getOrders);

      if (response.statusCode == HttpStatus.ok) {
        _dataFromApi = json.decode(response.body);
        orders = _dataFromApi
            .map((data) => OrderModel.fromJsonWhileOrdersFSTL(data))
            .toList();
      }

      if (orders != null && orders.isNotEmpty) {
        dbHelper.createDb().then((value) => null);
        await dbHelper.deleteAllOrderData();
        for (var data in orders) {
          await dbHelper.orderAddFromServerData(orderModel: data);
        }
      }

      String lastOrderNumber = await getLastOrderNumber();

      if (lastOrderNumber == "") {
        lastOrderNumber = "0";
      }

      await CacheManager.instance.saveLastOrderNumber(value: lastOrderNumber);
    } catch (e) {
      throw CustomException(LocaleStrings.errorOccured.tr());
    }
  }

  @override
  Future<String> getLastOrderNumber() async {
    try {
      final response =
          await http.get(ProductNetworkManager.instance.getLastOrderNumber);

      if (response.statusCode == HttpStatus.ok) {
        _dataFromApi = json.decode(response.body);

        if (_dataFromApi.isEmpty) {
          return "";
        }
        return _dataFromApi[0]["OrderNumber"].toString();
      }
      return "";
    } catch (e) {
      throw CustomException(LocaleStrings.nGetLastOrderNumber.tr());
    }
  }
}
