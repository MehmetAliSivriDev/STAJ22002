import 'package:easy_localization/easy_localization.dart';
import 'package:flutter/material.dart';
import 'package:kartal/kartal.dart';
import 'package:kartela_app/features/order_past/view_model/order_past_view_model.dart';
import 'package:kartela_app/product/constant/product_border_radius.dart';
import 'package:kartela_app/product/mixin/show_bottom_sheet.dart';
import 'package:provider/provider.dart';

import '../../../core/lang/locale_strings.dart';
import '../../../product/constant/product_colors.dart';
import '../../../product/constant/product_padding.dart';
import '../../../product/widget/divider_close_button.dart';
import '../../../product/widget/kartela_data_container.dart';

class OrderPastView extends StatelessWidget with ShowBottomSheet {
  const OrderPastView({super.key, required this.orderNumber});

  final String orderNumber;

  @override
  Widget build(BuildContext context) {
    Future.microtask(() =>
        Provider.of<OrderPastViewModel>(context, listen: false)
            .getOrders(orderNumber: orderNumber));
    return Scaffold(
      appBar: _buildAppBar(context),
      body: _buildBody(context),
    );
  }

  AppBar _buildAppBar(BuildContext context) {
    return AppBar(
      title: Text(LocaleStrings.orderPastTitle.tr()),
      leading: IconButton(
          onPressed: () {
            Navigator.pop(context);
          },
          icon: Icon(
            Icons.close,
            size: context.sized.dynamicWidth(0.06),
          )),
    );
  }

  Widget _buildBody(BuildContext context) {
    return Padding(
      padding: const ProductPadding.allLow(),
      child: Consumer<OrderPastViewModel>(
        builder: (context, viewModel, _) {
          return viewModel.isLoading == true
              ? const Center(
                  child: CircularProgressIndicator(),
                )
              : ListView.builder(
                  itemCount: viewModel.orders?.length ?? 0,
                  itemBuilder: (context, index) {
                    return Padding(
                      padding: const ProductPadding.verticalLow(),
                      child: Stack(
                        children: [
                          _buildOrderCard(context, viewModel, index),
                          _buildOrderStateContainer(context, viewModel, index),
                        ],
                      ),
                    );
                  },
                );
        },
      ),
    );
  }

  Widget _buildOrderCard(
      BuildContext context, OrderPastViewModel viewModel, int index) {
    return Card(
      elevation: 6,
      child: Padding(
        padding: const ProductPadding.allLow(),
        child: Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [
            _buildOrderInfo(context, viewModel, index),
            _buildCardButtons(context, viewModel, index),
          ],
        ),
      ),
    );
  }

  Widget _buildOrderStateContainer(
      BuildContext context, OrderPastViewModel viewModel, int index) {
    return Positioned(
      top: 0,
      right: context.sized.dynamicWidth(0.25),
      child: Container(
          width: context.sized.dynamicWidth(0.2),
          height: context.sized.dynamicHeight(0.028),
          decoration: BoxDecoration(
              borderRadius: ProductBorderRadius.circularHigh30(),
              color: viewModel.orders?[index].isActive == "0"
                  ? ProductColors.instance.green
                  : ProductColors.instance.blue),
          child: Icon(
              size: context.sized.dynamicWidth(0.05),
              color: ProductColors.instance.white,
              viewModel.orders?[index].isActive == "0"
                  ? Icons.check
                  : Icons.watch_later_outlined)),
    );
  }

  Widget _buildCardButtons(
      BuildContext context, OrderPastViewModel viewModel, int index) {
    return Column(
      mainAxisAlignment: MainAxisAlignment.spaceBetween,
      crossAxisAlignment: CrossAxisAlignment.end,
      children: [
        _buildMButton(context, viewModel, index),
        _buildDetail(context, viewModel, index),
        _buildDateAndHour(viewModel, index, context),
        _buildOrderNumber(viewModel, index, context)
      ],
    );
  }

  Widget _buildOrderNumber(
      OrderPastViewModel viewModel, int index, BuildContext context) {
    return Row(
      children: [
        Padding(
          padding: const ProductPadding.horizontalMedium(),
          child: Text(
              "${LocaleStrings.orderNumber.tr()} : ${viewModel.orders?[index].orderNumber ?? ""}",
              style: context.general.textTheme.titleSmall),
        ),
      ],
    );
  }

  Widget _buildDateAndHour(
      OrderPastViewModel viewModel, int index, BuildContext context) {
    return Row(
      children: [
        Padding(
          padding: const ProductPadding.horizontalMedium(),
          child: Text(viewModel.orders?[index].date ?? "",
              style: context.general.textTheme.titleSmall),
        ),
        Text(viewModel.formatTimeString(viewModel.orders?[index].hour ?? ""),
            style: context.general.textTheme.titleSmall),
      ],
    );
  }

  Widget _buildMButton(
      BuildContext context, OrderPastViewModel viewModel, int index) {
    return TextButton(
        onPressed: () {},
        child: Text(
          "${viewModel.orders?[index].orderCount} m",
          style: TextStyle(fontSize: context.sized.dynamicWidth(0.06)),
        ));
  }

  Widget _buildDetail(
      BuildContext context, OrderPastViewModel viewModel, int index) {
    return Padding(
      padding: const ProductPadding.horizontalMedium(),
      child: IconButton(
        onPressed: () {
          showCustomSheet(
              context, _buildOrderDetail(context, viewModel, index));
        },
        icon: Icon(
          Icons.info_outline,
          color: ProductColors.instance.blue700,
          size: context.sized.dynamicWidth(0.08),
        ),
      ),
    );
  }

  Widget _buildOrderDetail(
      BuildContext context, OrderPastViewModel viewModel, int index) {
    return SizedBox(
      width: context.sized.dynamicWidth(1),
      height: context.sized.dynamicHeight(0.6),
      child: Padding(
        padding: const ProductPadding.allMedium(),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const DividerCloseButton(),
            Padding(
              padding: const ProductPadding.bottomHighPlus25(),
              child: Text(LocaleStrings.productDetailTitle.tr(),
                  style: context.general.textTheme.headlineSmall!
                      .copyWith(color: ProductColors.instance.grey600)),
            ),
            KartelaDataContainer(
                model: viewModel.orders![index].product!,
                isShoppingActive: false)
          ],
        ),
      ),
    );
  }

  Widget _buildOrderInfo(
      BuildContext context, OrderPastViewModel viewModel, int index) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Padding(
          padding: const ProductPadding.bottomLow(),
          child: Row(
            children: [
              Text(
                "${LocaleStrings.barcode.tr()} : ",
                style: context.general.textTheme.titleMedium,
              ),
              Text(viewModel.orders?[index].product?.bar ?? "",
                  style: context.general.textTheme.bodyLarge),
            ],
          ),
        ),
        Padding(
          padding: const ProductPadding.bottomLow(),
          child: Row(
            children: [
              Text(
                "${LocaleStrings.patternCode.tr()} : ",
                style: context.general.textTheme.titleMedium,
              ),
              Text(
                  context
                          .read<OrderPastViewModel>()
                          .orders?[index]
                          .product
                          ?.desenKod ??
                      "",
                  style: context.general.textTheme.bodyLarge),
            ],
          ),
        ),
        Padding(
          padding: const ProductPadding.bottomLow(),
          child: Row(
            children: [
              Text(
                "${LocaleStrings.color.tr()} : ",
                style: context.general.textTheme.titleMedium,
              ),
              Text(
                  context
                          .read<OrderPastViewModel>()
                          .orders?[index]
                          .product
                          ?.renk ??
                      "",
                  style: context.general.textTheme.bodyLarge),
            ],
          ),
        ),
        Padding(
          padding: const ProductPadding.bottomLow(),
          child: Row(
            children: [
              Text(
                "${LocaleStrings.type.tr()} :",
                style: context.general.textTheme.titleMedium,
              ),
              Text(
                  context
                          .read<OrderPastViewModel>()
                          .orders?[index]
                          .product
                          ?.tip ??
                      "",
                  style: context.general.textTheme.bodyLarge),
            ],
          ),
        ),
      ],
    );
  }
}
