import 'package:flutter/material.dart';
import 'package:kartal/kartal.dart';
import 'product_border_radius.dart';
import 'product_colors.dart';

class ProductInputDecoration extends InputDecoration {
  ProductInputDecoration.searchTFDecoration({required String hint})
      : super(
            hintText: hint,
            suffixIcon: const Icon(Icons.search),
            suffixIconColor: ProductColors.instance.grey600,
            border: OutlineInputBorder(
                borderRadius: ProductBorderRadius.circularHigh(),
                borderSide: BorderSide(
                    style: BorderStyle.solid,
                    color: ProductColors.instance.grey400)));

  ProductInputDecoration.loginTF(BuildContext context, String hintText)
      : super(
          hintStyle: context.general.textTheme.bodyMedium!
              .copyWith(color: ProductColors.instance.grey),
          filled: true,
          fillColor: ProductColors.instance.grey200,
          enabledBorder: OutlineInputBorder(
            borderRadius: BorderRadius.circular(8),
            borderSide: BorderSide(
              strokeAlign: 1,
              width: 1.5,
              style: BorderStyle.solid,
              color: ProductColors.instance.grey300,
            ),
          ),
          border: OutlineInputBorder(
            borderRadius: BorderRadius.circular(8),
            borderSide: BorderSide(
              strokeAlign: 0.1,
              width: 0.1,
              color: ProductColors.instance.grey300,
            ),
          ),
          hintText: hintText,
        );
}
