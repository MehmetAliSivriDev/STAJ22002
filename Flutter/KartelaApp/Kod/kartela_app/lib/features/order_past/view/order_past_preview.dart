import 'package:easy_localization/easy_localization.dart';
import 'package:flutter/material.dart';
import 'package:kartal/kartal.dart';
import 'package:kartela_app/features/order_past/view/order_past_view.dart';
import 'package:kartela_app/product/constant/product_box_decorations.dart';
import 'package:kartela_app/product/util/navigator_w_animation.dart';
import 'package:provider/provider.dart';
import '../../../core/lang/locale_strings.dart';
import '../../../product/constant/product_padding.dart';
import '../view_model/order_past_view_model.dart';

class OrderPastPreviw extends StatelessWidget {
  const OrderPastPreviw({super.key});

  @override
  Widget build(BuildContext context) {
    Future.microtask(() =>
        Provider.of<OrderPastViewModel>(context, listen: false)
            .getOrderNumbers());
    return Scaffold(
      appBar: _buildAppBar(context),
      body: _buildBody(context),
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
              : ListView.separated(
                  separatorBuilder: (context, index) {
                    return SizedBox(
                      height: context.sized.dynamicHeight(0.02),
                    );
                  },
                  itemCount: viewModel.orderNumbers?.length ?? 0,
                  itemBuilder: (context, index) {
                    return _buildOrderNumberAndCountContainer(
                        context, viewModel, index);
                  },
                );
        },
      ),
    );
  }

  Widget _buildOrderNumberAndCountContainer(
      BuildContext context, OrderPastViewModel viewModel, int index) {
    return Container(
      decoration: ProductBoxDecorations.settingsDecoration(),
      child: ListTile(
        onTap: () {
          NavigatorWAnimation.bottomToUp(
              context: context,
              widget: OrderPastView(
                orderNumber: viewModel.orderNumbers?[index].orderNumber ?? "",
              ));
        },
        leading: Icon(Icons.shopping_bag_outlined,
            size: context.sized.dynamicWidth(0.08)),
        title: Text(
          "${LocaleStrings.orderNumber.tr()} : ${viewModel.orderNumbers?[index].orderNumber ?? ""}",
          style: context.general.textTheme.titleLarge,
        ),
        subtitle: Text(
          "${LocaleStrings.countOrderNumber.tr()} : ${viewModel.orderNumbers?[index].count ?? ""}",
          style: context.general.textTheme.bodyLarge,
        ),
        trailing: Icon(Icons.arrow_forward_ios,
            size: context.sized.dynamicWidth(0.06)),
      ),
    );
  }

  AppBar _buildAppBar(BuildContext context) {
    return AppBar(
      title: Text(LocaleStrings.orderPastTitle.tr()),
      bottom: PreferredSize(
          preferredSize: Size(
              context.sized.dynamicWidth(1), context.sized.dynamicHeight(0.1)),
          child: _buildCompanyInfoContainer(context)),
    );
  }

  Widget _buildCompanyInfoContainer(BuildContext context) {
    return Consumer<OrderPastViewModel>(
      builder: (context, viewModel, _) {
        return Container(
          decoration: ProductBoxDecorations.settingsDecoration(),
          child: Padding(
            padding: const ProductPadding.allLow(),
            child: Column(
              children: [
                Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    const Icon(Icons.factory_rounded),
                    SizedBox(
                      width: context.sized.dynamicWidth(0.04),
                    ),
                    Text(viewModel.companyName ?? ""),
                    SizedBox(
                      width: context.sized.dynamicWidth(0.04),
                    ),
                    const Icon(Icons.phone),
                    SizedBox(
                      width: context.sized.dynamicWidth(0.04),
                    ),
                    Text(viewModel.phone ?? ""),
                  ],
                ),
                Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    const Icon(Icons.mail),
                    SizedBox(
                      width: context.sized.dynamicWidth(0.04),
                    ),
                    Text(viewModel.email ?? ""),
                  ],
                ),
              ],
            ),
          ),
        );
      },
    );
  }
}
