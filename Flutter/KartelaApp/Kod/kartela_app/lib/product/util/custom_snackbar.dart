import 'package:flutter/material.dart';
import 'package:kartal/kartal.dart';
import '../constant/product_colors.dart';
import '../constant/product_padding.dart';

class CustomSnackBar {
  static void showError(
      {required BuildContext context, required String content}) {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
          content: SingleChildScrollView(
            scrollDirection: Axis.horizontal,
            child: Row(
              mainAxisAlignment: MainAxisAlignment.start,
              children: [
                Padding(
                  padding: const ProductPadding.horizontalLow(),
                  child: Icon(
                    Icons.dangerous_outlined,
                    color: ProductColors.instance.white,
                    size: context.sized.dynamicWidth(0.075),
                  ),
                ),
                Text(content,
                    style: context.general.textTheme.titleMedium!
                        .copyWith(color: ProductColors.instance.white))
              ],
            ),
          ),
          backgroundColor: Colors.red),
    );
  }

  static void showSuccess(
      {required BuildContext context, required String content}) {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
          content: SingleChildScrollView(
            scrollDirection: Axis.horizontal,
            child: Row(
              mainAxisAlignment: MainAxisAlignment.start,
              children: [
                Padding(
                  padding: const ProductPadding.horizontalLow(),
                  child: Icon(
                    Icons.check,
                    color: ProductColors.instance.white,
                    size: context.sized.dynamicWidth(0.075),
                  ),
                ),
                Text(content,
                    style: context.general.textTheme.titleMedium!
                        .copyWith(color: ProductColors.instance.white))
              ],
            ),
          ),
          backgroundColor: Colors.green),
    );
  }
}
