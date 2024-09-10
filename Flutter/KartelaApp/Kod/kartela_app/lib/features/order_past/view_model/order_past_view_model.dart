import 'package:flutter/material.dart';
import 'package:kartela_app/core/cache/cache_manager.dart';
import 'package:kartela_app/core/model/order_number_model.dart';
import 'package:kartela_app/core/service/local_service/dbHelper.dart';

import '../../../core/model/order_model.dart';

class OrderPastViewModel extends ChangeNotifier {
  List<OrderModel>? orders;
  List<OrderNumberModel>? orderNumbers;
  DbHelper dbHelper = DbHelper();

  bool isLoading = false;

  String? email;
  String? companyName;
  String? phone;

  void changeLoading() {
    isLoading = !isLoading;
    notifyListeners();
  }

  Future<void> getOrders({required String orderNumber}) async {
    changeLoading();
    dbHelper.createDb().then((value) => null);

    String? email = await CacheManager.instance.getMail();

    orders = await dbHelper.getOrdersWEmailAONumber(
        email: email ?? "", orderNumber: orderNumber);
    await Future.delayed(const Duration(milliseconds: 500));
    changeLoading();
  }

  Future<void> getOrderNumbers() async {
    changeLoading();
    dbHelper.createDb().then((value) => null);

    email = await CacheManager.instance.getMail();
    companyName = await CacheManager.instance.getCompanyName();
    phone = await CacheManager.instance.getPhoneNumber();

    orderNumbers = await dbHelper.getOrderNumbersWEmail(email: email ?? "");
    await Future.delayed(const Duration(milliseconds: 500));
    changeLoading();
  }

  String formatTimeString(String timeString) {
    String cleanTimeString = timeString.split('.')[0];
    DateTime time = DateTime.parse("1970-01-01T$cleanTimeString");
    return "${time.hour.toString().padLeft(2, '0')}:${time.minute.toString().padLeft(2, '0')}:${time.second.toString().padLeft(2, '0')}";
  }
}
