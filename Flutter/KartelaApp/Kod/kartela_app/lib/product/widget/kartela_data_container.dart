// ignore_for_file: public_member_api_docs, sort_constructors_first
import 'package:barcode_widget/barcode_widget.dart';
import 'package:easy_localization/easy_localization.dart';
import 'package:flutter/material.dart';
import 'package:kartal/kartal.dart';

import 'package:kartela_app/core/model/kartela_data_model.dart';

import '../../core/lang/locale_strings.dart';
import '../../features/order/view/order_view.dart';
import '../constant/product_box_decorations.dart';
import '../constant/product_colors.dart';
import '../constant/product_padding.dart';
import '../util/navigator_w_animation.dart';

class KartelaDataContainer extends StatelessWidget {
  const KartelaDataContainer({
    super.key,
    required this.model,
    required this.isShoppingActive,
  });

  final KartelaDataModel model;
  final bool isShoppingActive;

  @override
  Widget build(BuildContext context) {
    return Stack(
      children: [
        Container(
          width: context.sized.dynamicWidth(1),
          height: context.sized.dynamicHeight(0.38),
          decoration: ProductBoxDecorations.kartelaDataContainer(),
          child: Padding(
            padding: const ProductPadding.allMedium(),
            child: Column(
              children: [
                SizedBox(
                  width: context.sized.dynamicWidth(1),
                  height: context.sized.dynamicHeight(0.03),
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.start,
                    children: [
                      Text(
                        "${LocaleStrings.variant.tr()} :",
                        style: context.general.textTheme.titleMedium,
                      ),
                      Text(model.varyant ?? "",
                          style: context.general.textTheme.bodyLarge),
                    ],
                  ),
                ),
                SizedBox(
                  height: context.sized.dynamicHeight(0.015),
                ),
                SizedBox(
                  width: context.sized.dynamicWidth(1),
                  height: context.sized.dynamicHeight(0.03),
                  child: SingleChildScrollView(
                    scrollDirection: Axis.horizontal,
                    child: Row(
                      mainAxisAlignment: MainAxisAlignment.spaceBetween,
                      children: [
                        Text(
                          "${LocaleStrings.pattern.tr()} :",
                          style: context.general.textTheme.titleMedium,
                        ),
                        Text(model.desen ?? "",
                            style: context.general.textTheme.bodyLarge),
                        SizedBox(
                          width: context.sized.dynamicWidth(0.05),
                        ),
                        Text(
                          "${LocaleStrings.patternCode.tr()} :",
                          style: context.general.textTheme.titleMedium,
                        ),
                        Text(model.desenKod ?? "",
                            style: context.general.textTheme.bodyLarge),
                      ],
                    ),
                  ),
                ),
                SizedBox(
                  height: context.sized.dynamicHeight(0.015),
                ),
                SizedBox(
                  width: context.sized.dynamicWidth(1),
                  height: context.sized.dynamicHeight(0.03),
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.start,
                    children: [
                      Text(
                        "${LocaleStrings.com.tr()} :",
                        style: context.general.textTheme.titleMedium,
                      ),
                      Text(model.com ?? "",
                          style: context.general.textTheme.bodyLarge),
                    ],
                  ),
                ),
                SizedBox(
                  height: context.sized.dynamicHeight(0.015),
                ),
                SizedBox(
                  width: context.sized.dynamicWidth(1),
                  height: context.sized.dynamicHeight(0.03),
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      Text(
                        "${LocaleStrings.color.tr()} :",
                        style: context.general.textTheme.titleMedium,
                      ),
                      Text(model.renk ?? "",
                          style: context.general.textTheme.bodyLarge),
                      Text(
                        "${LocaleStrings.type.tr()} :",
                        style: context.general.textTheme.titleMedium,
                      ),
                      Text(model.tip ?? "",
                          style: context.general.textTheme.bodyLarge),
                    ],
                  ),
                ),
                SizedBox(
                  height: context.sized.dynamicHeight(0.015),
                ),
                SizedBox(
                  width: context.sized.dynamicWidth(1),
                  height: context.sized.dynamicHeight(0.03),
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      Text(
                        "${LocaleStrings.kg.tr()} :",
                        style: context.general.textTheme.titleMedium,
                      ),
                      Text(model.kg ?? "",
                          style: context.general.textTheme.bodyLarge),
                      Text(
                        "${LocaleStrings.width.tr()} :",
                        style: context.general.textTheme.titleMedium,
                      ),
                      Text(model.en ?? "",
                          style: context.general.textTheme.bodyLarge),
                      Text(
                        "${LocaleStrings.kWidth.tr()} :",
                        style: context.general.textTheme.titleMedium,
                      ),
                      Text(model.kEn ?? "",
                          style: context.general.textTheme.bodyLarge),
                    ],
                  ),
                ),
                SizedBox(
                  height: context.sized.dynamicHeight(0.015),
                ),
                SizedBox(
                  width: context.sized.dynamicWidth(0.6),
                  height: context.sized.dynamicHeight(0.1),
                  child: BarcodeWidget(
                      data: model.bar.toString(), barcode: Barcode.code128()),
                )
              ],
            ),
          ),
        ),
        isShoppingActive
            ? Positioned(
                right: context.sized.dynamicWidth(0.02),
                top: context.sized.dynamicHeight(0.003),
                child: SizedBox(
                  child: OutlinedButton(
                      onPressed: () {
                        NavigatorWAnimation.bottomToUp(
                            context: context, widget: OrderView(model: model));
                      },
                      child: Icon(
                        Icons.shopping_bag_rounded,
                        color: ProductColors.instance.deepForest,
                        size: context.sized.dynamicWidth(0.06),
                      )),
                ),
              )
            : const SizedBox.shrink(),
      ],
    );
  }
}
