import 'package:easy_localization/easy_localization.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:kartal/kartal.dart';
import 'package:kartela_app/core/model/kartela_data_model.dart';
import 'package:kartela_app/features/order/view_model/order_view_model.dart';
import 'package:kartela_app/product/constant/product_border_radius.dart';
import 'package:kartela_app/product/constant/product_colors.dart';
import 'package:kartela_app/product/widget/kartela_data_container.dart';
import 'package:provider/provider.dart';
import '../../../core/lang/locale_strings.dart';
import '../../../core/model/order_model.dart';
import '../../../product/constant/product_padding.dart';

class OrderView extends StatelessWidget {
  const OrderView({
    super.key,
    required this.model,
  });

  final KartelaDataModel model;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: _buildAppBar(context),
      body: _buildBody(context),
    );
  }

  Widget _buildBody(BuildContext context) {
    return SingleChildScrollView(
      child: Padding(
        padding: const ProductPadding.allMedium(),
        child: Column(
          children: [
            Padding(
              padding: const ProductPadding.verticalHigh(),
              child:
                  KartelaDataContainer(model: model, isShoppingActive: false),
            ),
            Padding(
              padding: const ProductPadding.verticalHigh(),
              child: _buildMRow(context),
            ),
            Padding(
              padding: const ProductPadding.verticalHigh(),
              child: SizedBox(
                width: context.sized.dynamicWidth(0.6),
                child: _buildOrderButton(context),
              ),
            )
          ],
        ),
      ),
    );
  }

  Widget _buildOrderButton(BuildContext context) {
    return FilledButton(
        onPressed: () {
          if (context.read<OrderViewModel>().numberOfOrderController.text ==
              '') {
            context.read<OrderViewModel>().numberOfOrderController.text = "1";
          }

          var order = OrderModel(
            product: model,
            orderCount:
                context.read<OrderViewModel>().numberOfOrderController.text,
          );

          context
              .read<OrderViewModel>()
              .addOrderToCart(context: context, order: order);
        },
        child: Text(
          LocaleStrings.addToCart.tr(),
          style: context.general.textTheme.titleMedium!
              .copyWith(color: ProductColors.instance.white),
        ));
  }

  Widget _buildMRow(BuildContext context) {
    return Row(
      mainAxisAlignment: MainAxisAlignment.center,
      children: [
        FilledButton.tonal(
            onPressed: () {
              context.read<OrderViewModel>().decreaseOrder();
            },
            child: Icon(Icons.remove, size: context.sized.dynamicWidth(0.06))),
        Padding(
          padding: const ProductPadding.horizontalHigh(),
          child: SizedBox(
            width: context.sized.dynamicWidth(0.3),
            child: TextField(
              inputFormatters: [
                FilteringTextInputFormatter.allow(RegExp(r'[0-9]')),
              ],
              controller:
                  context.read<OrderViewModel>().numberOfOrderController,
              keyboardType: TextInputType.number,
              decoration: InputDecoration(
                suffixText: "m",
                hintStyle: context.general.textTheme.bodyLarge!
                    .copyWith(color: ProductColors.instance.grey600),
                border: OutlineInputBorder(
                  borderRadius: ProductBorderRadius.circularHigh30(),
                  borderSide: BorderSide(
                    color: ProductColors.instance.grey200,
                  ),
                ),
              ),
            ),
          ),
        ),
        FilledButton.tonal(
            onPressed: () {
              context.read<OrderViewModel>().increaseOrder();
            },
            child: Icon(Icons.add, size: context.sized.dynamicWidth(0.06)))
      ],
    );
  }

  AppBar _buildAppBar(BuildContext context) {
    return AppBar(
      title: Text(LocaleStrings.order.tr()),
      leading: IconButton(
          onPressed: () {
            context.read<OrderViewModel>().numberOfOrderController.text = "1";
            context.read<OrderViewModel>().count = 1;

            Navigator.pop(context);
          },
          icon: Icon(
            Icons.close,
            size: context.sized.dynamicWidth(0.06),
          )),
    );
  }
}
