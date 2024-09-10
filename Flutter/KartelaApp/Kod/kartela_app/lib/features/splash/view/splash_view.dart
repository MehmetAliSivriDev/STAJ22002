import 'package:flutter/material.dart';
import '../view_model/splash_view_model.dart';

import '../../../product/constant/product_padding.dart';
import '../../../product/extension/images_extension.dart';
import 'package:provider/provider.dart';

class SplashView extends StatelessWidget {
  const SplashView({super.key});

  @override
  Widget build(BuildContext context) {
    Provider.of<SplashViewModel>(context).navigateToHome(context: context);
    return Scaffold(
      appBar: AppBar(),
      body: Center(
        child: Padding(
          padding: const ProductPadding.allHigh50(),
          child: Image.asset(ImagesJPG.peykan_logo_1.logoPath),
        ),
      ),
    );
  }
}
