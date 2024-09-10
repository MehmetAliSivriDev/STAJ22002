import 'package:country_flags/country_flags.dart';
import 'package:easy_localization/easy_localization.dart';
import 'package:flutter/material.dart';
import 'package:kartal/kartal.dart';
import 'package:kartela_app/product/util/custom_dialogs.dart';
import '../../../core/lang/locale_list.dart';
import '../../../core/lang/locale_strings.dart';
import '../../../product/constant/product_colors.dart';
import '../../../product/constant/product_padding.dart';
import '../../../product/mixin/show_bottom_sheet.dart';
import '../../../product/widget/divider_close_button.dart';
import 'package:provider/provider.dart';

import '../../../product/constant/product_box_decorations.dart';
import '../view_model/settings_view_model.dart';

class SettingsView extends StatelessWidget with ShowBottomSheet {
  const SettingsView({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(LocaleStrings.settings.tr()),
      ),
      body: Padding(
        padding: const ProductPadding.allHigh(),
        child: _buildBody(context),
      ),
    );
  }

  Widget _buildBody(BuildContext context) {
    return SingleChildScrollView(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.start,
        children: [
          Padding(
            padding: const ProductPadding.bottomHigh(),
            child: customSettingsLTile(
              context: context,
              title: LocaleStrings.changeLanguageSettingTitle.tr(),
              subtitle: LocaleStrings.changeLanguageSettingSubtitle.tr(),
              leadingIcon: Icons.language,
              onTap: () {
                showCustomSheet(context, _buildLanguages(context));
              },
            ),
          ),
          Padding(
            padding: const ProductPadding.bottomHigh(),
            child: customSettingsLTile(
                context: context,
                title: LocaleStrings.synchronizeDataSettingTitle.tr(),
                subtitle: LocaleStrings.synchronizeDataSettingSubtitle.tr(),
                leadingIcon: Icons.sync,
                onTap: () {
                  context
                      .read<SettingsViewModel>()
                      .synchronizeData(context: context);
                }),
          ),
          Padding(
            padding: const ProductPadding.bottomHigh(),
            child: customSettingsLTile(
                context: context,
                title: LocaleStrings.transferDataTitle.tr(),
                subtitle: LocaleStrings.transferDataSubtitle.tr(),
                leadingIcon: Icons.sync,
                onTap: () {
                  context.read<SettingsViewModel>().showPassDialog(
                      context: context, pType: ProcessType.ordersToServer);
                }),
          ),
          customSettingsLTile(
              context: context,
              title: LocaleStrings.getOrdersFromServerTitle.tr(),
              subtitle: LocaleStrings.getOrdersFromServerSubtitle.tr(),
              leadingIcon: Icons.sync,
              onTap: () {
                context.read<SettingsViewModel>().warninWhenOrdersFSTL(
                    context: context, pType: ProcessType.ordersFromServer);
              }),
        ],
      ),
    );
  }

  Widget _buildLanguages(BuildContext context) {
    return SizedBox(
      width: context.sized.dynamicWidth(1),
      height: context.sized.dynamicHeight(0.4),
      child: Column(
        children: [
          const DividerCloseButton(),
          Padding(
            padding: const ProductPadding.allHigh(),
            child: languageLTile(
                context: context,
                language: LocaleStrings.turkish.tr(),
                countryCode: "TR"),
          ),
          Padding(
            padding: const ProductPadding.allHigh(),
            child: languageLTile(
                context: context,
                language: LocaleStrings.english.tr(),
                countryCode: "US"),
          ),
        ],
      ),
    );
  }

  Widget customSettingsLTile(
      {required BuildContext context,
      required String title,
      required String subtitle,
      required IconData leadingIcon,
      required void Function() onTap}) {
    return Container(
      width: context.sized.dynamicWidth(1),
      height: context.sized.dynamicHeight(0.11),
      decoration: ProductBoxDecorations.settingsDecoration(),
      child: ListTile(
        onTap: () => onTap(),
        leading: Icon(
          leadingIcon,
          size: context.sized.dynamicWidth(0.08),
        ),
        title: Text(
          title,
          style: context.general.textTheme.titleMedium,
        ),
        subtitle: Text(
          subtitle,
          style: context.general.textTheme.bodyMedium,
        ),
      ),
    );
  }

  Widget languageLTile(
      {required BuildContext context,
      required String language,
      required String countryCode}) {
    return Card(
      color: ProductColors.instance.white,
      elevation: 5,
      child: ListTile(
        onTap: () async {
          CustomDialogs.showLoadingDialog(context: context);

          if (countryCode == "TR") {
            context.setLocale(
                LocaleList.getLocale(localeName: LocaleNames.TURKISH));
          } else if (countryCode == "US") {
            context.setLocale(
                LocaleList.getLocale(localeName: LocaleNames.ENGLISH));
          }

          await Future.delayed(const Duration(milliseconds: 500));

          if (context.mounted) {
            Navigator.pop(context);
            Navigator.pop(context);
          }
        },
        leading: CountryFlag.fromCountryCode(
          countryCode,
          width: context.sized.dynamicWidth(0.12),
          height: context.sized.dynamicHeight(0.05),
        ),
        title: Text(
          language,
          style: context.general.textTheme.titleMedium,
        ),
        trailing: const Icon(Icons.language_outlined),
      ),
    );
  }
}
