import 'package:easy_localization/easy_localization.dart';
import 'package:flutter/material.dart';
import 'package:kartal/kartal.dart';
import 'package:kartela_app/product/constant/product_pass.dart';
import '../../../core/service/kartela_data_service.dart';
import '../../../product/constant/product_border_radius.dart';
import '../../../product/constant/product_colors.dart';
import '../../../product/util/custom_dialogs.dart';
import '../../../product/util/custom_exception.dart';
import '../../../product/util/custom_snackbar.dart';

import '../../../core/lang/locale_strings.dart';

enum ProcessType { ordersToServer, ordersFromServer }

class SettingsViewModel extends ChangeNotifier {
  final IKartelaDataService _service = KartelaDataService();

  bool isLoading = false;
  TextEditingController passController = TextEditingController();

  void changeLoading() {
    isLoading = !isLoading;
    notifyListeners();
  }

  Future<void> synchronizeData({required BuildContext context}) async {
    try {
      changeLoading();
      if (context.mounted) {
        CustomDialogs.showLoadingDialog(context: context);
      }
      await _service.synchronizeData();
      changeLoading();
      if (context.mounted) {
        Navigator.pop(context);
      }

      if (context.mounted) {
        CustomSnackBar.showSuccess(
            context: context,
            content: LocaleStrings.synchronizeDataSucess.tr());
      }
    } on CustomException catch (e) {
      if (context.mounted) {
        CustomSnackBar.showError(context: context, content: e.message);
      }
    }
  }

  void showPassDialog(
      {required BuildContext context, required ProcessType pType}) {
    AlertDialog passDialog = AlertDialog(
      title: Text(LocaleStrings.pass.tr()),
      content: TextField(
        controller: passController,
        decoration: InputDecoration(
          hintText: LocaleStrings.pass.tr(),
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
      actions: [
        SizedBox(
          width: context.sized.dynamicWidth(0.6),
          child: FilledButton(
              onPressed: () async {
                if (pType == ProcessType.ordersToServer) {
                  CustomDialogs.showLoadingDialog(context: context);
                  await Future.delayed(const Duration(milliseconds: 500));

                  if (context.mounted) {
                    Navigator.pop(context);
                    Navigator.pop(context);
                    if (passController.text == ProductPass.ORDERTOSERVER) {
                      ordersToServer(context: context);
                    } else {
                      CustomSnackBar.showError(
                          context: context,
                          content: LocaleStrings.passError.tr());
                    }
                  }
                } else if (pType == ProcessType.ordersFromServer) {
                  CustomDialogs.showLoadingDialog(context: context);
                  await Future.delayed(const Duration(milliseconds: 500));

                  if (context.mounted) {
                    Navigator.pop(context);
                    Navigator.pop(context);
                    if (passController.text == ProductPass.ORDERTOSERVER) {
                      ordersFromServer(context: context);
                    } else {
                      CustomSnackBar.showError(
                          context: context,
                          content: LocaleStrings.passError.tr());
                    }
                  }
                }
              },
              child: Text(
                LocaleStrings.scontinue.tr(),
                style: context.general.textTheme.titleMedium!
                    .copyWith(color: ProductColors.instance.white),
              )),
        )
      ],
    );

    showDialog(context: context, builder: (_) => passDialog);
  }

  Future<void> ordersToServer({required BuildContext context}) async {
    changeLoading();
    if (context.mounted) {
      CustomDialogs.showLoadingDialog(context: context);
    }
    final response = await _service.ordersToServer();
    changeLoading();
    if (context.mounted) {
      Navigator.pop(context);
    }

    if (response == 1) {
      if (context.mounted) {
        CustomSnackBar.showSuccess(
            context: context, content: LocaleStrings.dataTransferSuccess.tr());
      }
    } else if (response == 2) {
      if (context.mounted) {
        CustomSnackBar.showSuccess(
            context: context,
            content: LocaleStrings.dataTransferAlreadyUpdated.tr());
      }
    } else {
      if (context.mounted) {
        CustomSnackBar.showError(
            context: context, content: LocaleStrings.errorOccured.tr());
      }
    }
  }

  void warninWhenOrdersFSTL(
      {required BuildContext context, required ProcessType pType}) {
    AlertDialog warningDialog = AlertDialog(
      title: Text(
        LocaleStrings.warning.tr(),
      ),
      content: SizedBox(
        width: context.sized.dynamicWidth(1),
        height: context.sized.dynamicHeight(0.176),
        child: Column(
          children: [
            Text(
              LocaleStrings.getOrdersFromServerDialog1.tr(),
              style: context.general.textTheme.titleMedium,
            ),
            Text(
              LocaleStrings.getOrdersFromServerDialog2.tr(),
              style: context.general.textTheme.bodyMedium,
            ),
          ],
        ),
      ),
      actions: [
        TextButton(
            onPressed: () async {
              Navigator.pop(context);
              showPassDialog(context: context, pType: pType);
            },
            child: Text(LocaleStrings.yes.tr())),
        FilledButton(
            onPressed: () {
              Navigator.pop(context);
            },
            child: Text(LocaleStrings.no.tr())),
      ],
    );

    showDialog(context: context, builder: (_) => warningDialog);
  }

  Future<void> ordersFromServer({required BuildContext context}) async {
    try {
      changeLoading();
      if (context.mounted) {
        CustomDialogs.showLoadingDialog(context: context);
      }
      await _service.ordersFromServerToLocale();
      changeLoading();
      if (context.mounted) {
        Navigator.pop(context);
        CustomSnackBar.showSuccess(
            context: context,
            content: LocaleStrings.successOrderFromServer.tr());
      }
    } on CustomException catch (e) {
      if (context.mounted) {
        CustomSnackBar.showError(context: context, content: e.message);
      }
    }
  }
}
