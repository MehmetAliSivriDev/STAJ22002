import 'package:easy_localization/easy_localization.dart';
import 'package:flutter/material.dart';
import 'package:kartal/kartal.dart';
import 'package:kartela_app/product/widget/kartela_data_container.dart';
import '../../../core/lang/locale_strings.dart';
import '../view_model/home_view_model.dart';
import '../../../product/constant/product_border_radius.dart';
import '../../../product/constant/product_colors.dart';
import '../../../product/constant/product_padding.dart';
import '../../../product/extension/images_extension.dart';
import '../../../product/extension/lottie_extension.dart';
import 'package:provider/provider.dart';
import '../../../core/routes/routes.dart';

class HomeView extends StatelessWidget {
  const HomeView({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      // floatingActionButtonLocation: FloatingActionButtonLocation.endTop,
      // floatingActionButton: _buildFAButton(context),
      drawer: _buildDrawer(context),
      appBar: AppBar(
        title: Text(LocaleStrings.homeTitle.tr()),
      ),
      body: _buildBody(context),
    );
  }

  Widget _buildBody(BuildContext context) {
    return Column(
      children: [
        Padding(
          padding: const ProductPadding.allMedium(),
          child: Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [_buildScannerContainer(context), _buildTip(context)],
          ),
        ),
        Expanded(
          child: Consumer<HomeViewModel>(
            builder: (context, viewModel, _) {
              return Padding(
                padding: const ProductPadding.allMedium(),
                child: (viewModel.scanResult == 'UNKNOWN' ||
                        viewModel.scannedProduct == null)
                    ? _buildNoKartela(context)
                    : KartelaDataContainer(
                        model: viewModel.scannedProduct!,
                        isShoppingActive: true),
              );
            },
          ),
        )
      ],
    );
  }

  Widget _buildTip(BuildContext context) {
    return Container(
      width: context.sized.dynamicWidth(0.6),
      height: context.sized.dynamicHeight(0.15),
      decoration: BoxDecoration(
          color: ProductColors.instance.grey200,
          border: Border.all(
            color: ProductColors.instance.grey400,
          ),
          borderRadius: ProductBorderRadius.circularMedium()),
      child: SingleChildScrollView(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          crossAxisAlignment: CrossAxisAlignment.center,
          children: [
            Padding(
              padding: const ProductPadding.topLow(),
              child: Text(
                LocaleStrings.kartelaApp.tr(),
                style: context.general.textTheme.headlineSmall,
              ),
            ),
            Padding(
              padding: const ProductPadding.allLow(),
              child: Text(
                LocaleStrings.userScanTip.tr(),
                style: context.general.textTheme.bodyLarge!
                    .copyWith(color: ProductColors.instance.grey850),
              ),
            )
          ],
        ),
      ),
    );
  }

  Widget _buildNoKartela(BuildContext context) {
    return Column(
      children: [
        Padding(
          padding: const ProductPadding.bottomHigh(),
          child: SizedBox(
              width: context.sized.dynamicWidth(1),
              height: context.sized.dynamicHeight(0.4),
              child: Lotties.search_not_found.getLottie),
        ),
        Text(
          LocaleStrings.plsScanKartela.tr(),
          style: context.general.textTheme.headlineMedium!
              .copyWith(color: ProductColors.instance.grey800),
        )
      ],
    );
  }

  Widget _buildScannerContainer(BuildContext context) {
    return InkWell(
      borderRadius: ProductBorderRadius.circularHigh(),
      onTap: () async {
        context.read<HomeViewModel>().scan(context: context);
      },
      child: Container(
        width: context.sized.dynamicWidth(0.3),
        height: context.sized.dynamicHeight(0.15),
        decoration: BoxDecoration(
            color: ProductColors.instance.grey200,
            border: Border.all(
              color: ProductColors.instance.grey400,
            ),
            borderRadius: ProductBorderRadius.circularMedium()),
        child: Icon(Icons.qr_code_scanner_outlined,
            size: context.sized.dynamicWidth(0.15)),
      ),
    );
  }

  // Widget _buildFAButton(BuildContext context) {
  //   return FloatingActionButton(
  //     child: Icon(
  //       Icons.exit_to_app_rounded,
  //       size: context.sized.dynamicWidth(0.08),
  //     ),
  //     onPressed: () => context.read<HomeViewModel>().logout(context: context),
  //   );
  // }

  Widget _buildDrawer(BuildContext context) {
    return Drawer(
      backgroundColor: ProductColors.instance.lightHouse,
      elevation: 0,
      child: Padding(
        padding: const ProductPadding.allLow(),
        child: _buildDrawerItems(context),
      ),
    );
  }

  Widget _buildDrawerItems(BuildContext context) {
    return Column(
      mainAxisAlignment: MainAxisAlignment.end,
      children: [
        // Padding(
        //   padding: const ProductPadding.bottomMedium(),
        //   child: drawerLTile(
        //     context: context,
        //     title: LocaleStrings.dataAddTitle.tr(),
        //     subtitle: LocaleStrings.dataAddSubtitle.tr(),
        //     icon: Icons.add,
        //     onTap: () {},
        //   ),
        // ),
        Padding(
          padding: const ProductPadding.bottomMedium(),
          child: drawerLTile(
            context: context,
            title: LocaleStrings.viewDataTitle.tr(),
            subtitle: LocaleStrings.viewDataSubtitle.tr(),
            icon: Icons.dns_rounded,
            onTap: () => Navigator.pushNamed(context, Routes.DATADISPLAY),
          ),
        ),
        Padding(
          padding: const ProductPadding.bottomMedium(),
          child: drawerLTile(
            context: context,
            title: LocaleStrings.orderCart.tr(),
            subtitle: "",
            icon: Icons.shopping_cart_rounded,
            onTap: () => Navigator.pushNamed(context, Routes.LOGIN),
          ),
        ),
        Padding(
          padding: const ProductPadding.bottomMedium(),
          child: drawerLTile(
            context: context,
            title: LocaleStrings.systemSettings.tr(),
            subtitle: '',
            icon: Icons.settings,
            onTap: () => Navigator.pushNamed(context, Routes.SETTINGS),
          ),
        ),
        SizedBox(
          height: context.sized.dynamicHeight(0.25),
        ),
        Padding(
          padding: const ProductPadding.bottomLow(),
          child: SizedBox(
              height: context.sized.dynamicHeight(0.08),
              width: context.sized.dynamicWidth(0.4),
              child: Image.asset(ImagesPNG.peykan_logo_2.logoPath)),
        ),
      ],
    );
  }

  Widget drawerLTile(
      {required BuildContext context,
      required String title,
      required String subtitle,
      required IconData icon,
      required void Function() onTap}) {
    return Card(
      color: ProductColors.instance.white,
      elevation: 5,
      child: ListTile(
        onTap: () => onTap(),
        leading: Icon(icon),
        title: Text(title, style: context.general.textTheme.titleMedium),
        subtitle: subtitle == ''
            ? null
            : Text(
                subtitle,
                style: context.general.textTheme.bodyMedium,
              ),
        trailing: Icon(
          Icons.arrow_forward_ios,
          size: context.sized.dynamicWidth(0.05),
        ),
      ),
    );
  }
}
