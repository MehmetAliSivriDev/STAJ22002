import 'package:flutter/cupertino.dart';
import '../../../core/cache/cache_manager.dart';
import '../../../product/util/custom_dialogs.dart';

import '../../../core/routes/routes.dart';

class LoginViewModel extends ChangeNotifier {
  TextEditingController companyNameController = TextEditingController();
  TextEditingController mailController = TextEditingController();
  TextEditingController phoneController = TextEditingController();
  GlobalKey<FormState> key = GlobalKey();

  Future<void> validate({required BuildContext context}) async {
    if (key.currentState!.validate()) {
      CustomDialogs.showLoadingDialog(context: context);

      await Future.delayed(const Duration(milliseconds: 500));

      CacheManager.instance.saveCompanyName(value: companyNameController.text);
      CacheManager.instance.saveMail(value: mailController.text);
      CacheManager.instance.savePhoneNumber(value: phoneController.text);

      if (context.mounted) {
        cleanControllers();
        Navigator.pop(context);
        Navigator.pushNamed(context, Routes.ORDERCART);
      }
    }
  }

  void cleanControllers() {
    companyNameController.clear();
    mailController.clear();
    phoneController.clear();
  }
}
