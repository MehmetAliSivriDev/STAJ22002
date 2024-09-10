import 'package:flutter/material.dart';
import 'product_border_radius.dart';
import 'product_colors.dart';

class ProductBoxDecorations extends BoxDecoration {
  ProductBoxDecorations.settingsDecoration()
      : super(
          border: Border.all(
              color: ProductColors.instance.grey600, style: BorderStyle.solid),
          borderRadius: ProductBorderRadius.circularMedium(),
        );
  ProductBoxDecorations.kartelaDataContainer()
      : super(
            color: ProductColors.instance.deepForest.withOpacity(0.05),
            border: Border.all(
              color: ProductColors.instance.grey400,
              style: BorderStyle.solid,
            ),
            borderRadius: ProductBorderRadius.circularMedium());
}
