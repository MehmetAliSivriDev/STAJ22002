import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import 'package:kartal/kartal.dart';
import '../constant/product_border_radius.dart';
import '../constant/product_colors.dart';

class CustomDialogs {
  static void showLoadingDialog({required BuildContext context}) {
    AlertDialog loadingDialog = AlertDialog(
      elevation: 0,
      backgroundColor: Colors.transparent,
      content: Container(
        height: context.sized.dynamicHeight(0.2),
        decoration: BoxDecoration(
            color: ProductColors.instance.grey400,
            borderRadius: ProductBorderRadius.circularMedium()),
        child: Center(
            child: CircularProgressIndicator(
          color: ProductColors.instance.black,
        )),
      ),
    );

    showDialog(
        barrierDismissible: false,
        context: context,
        builder: (_) => loadingDialog);
  }
}
