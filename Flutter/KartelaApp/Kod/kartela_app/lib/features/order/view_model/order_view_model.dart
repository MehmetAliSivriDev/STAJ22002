import 'package:easy_localization/easy_localization.dart';
import 'package:flutter/material.dart';
import 'package:kartela_app/core/lang/locale_strings.dart';
import 'package:kartela_app/core/model/order_model.dart';
import 'package:kartela_app/product/util/custom_dialogs.dart';
import 'package:kartela_app/product/util/custom_snackbar.dart';
import 'package:provider/provider.dart';

import '../../order_cart/view_model/order_cart_view_model.dart';

class OrderViewModel extends ChangeNotifier {
  TextEditingController numberOfOrderController =
      TextEditingController(text: "1");

  int count = 1;

  void increaseOrder() {
    if (numberOfOrderController.text == '') {
      count = 1;
    } else {
      count = int.parse(numberOfOrderController.text);
    }

    count++;
    numberOfOrderController.text = count.toString();
    notifyListeners();
  }

  void decreaseOrder() {
    if (numberOfOrderController.text == '') {
      count = 1;
    } else {
      count = int.parse(numberOfOrderController.text);
    }
    if (count > 1) count--;
    numberOfOrderController.text = count.toString();
    notifyListeners();
  }

  Future<void> addOrderToCart(
      {required BuildContext context, required OrderModel order}) async {
    CustomDialogs.showLoadingDialog(context: context);

    await Future.delayed(const Duration(milliseconds: 400));

    if (context.mounted) {
      context.read<OrderCartViewModel>().addOrder(order: order);
      Navigator.pop(context);
      Navigator.pop(context);
      numberOfOrderController.text = "1";
      count = 1;
      CustomSnackBar.showSuccess(
          context: context, content: LocaleStrings.successAddPToCart.tr());
    }
  }
}
