import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import '../../../core/routes/routes.dart';

class SplashViewModel extends ChangeNotifier {
  Future<void> navigateToHome({required BuildContext context}) async {
    await Future.delayed(const Duration(milliseconds: 2500));

    if (context.mounted) {
      Navigator.pushNamedAndRemoveUntil(context, Routes.HOME, (route) => false);
    }
  }
}
