import 'package:easy_localization/easy_localization.dart';
import 'package:kartela_app/core/lang/locale_strings.dart';

class LoginValidator {
  static LoginValidator? _instance;
  static LoginValidator get instance {
    _instance ??= LoginValidator._init();
    return _instance!;
  }

  LoginValidator._init();

  String? companyNameValidator(String? value) {
    if (value == null || value.isEmpty || value == "") {
      return LocaleStrings.companyNameValidator.tr();
    }
    return null;
  }

  String? mailValidator(String? value) {
    if (value == null || value.isEmpty || value == "" || !value.contains("@")) {
      return LocaleStrings.companyMailValidator.tr();
    }
    return null;
  }
}
