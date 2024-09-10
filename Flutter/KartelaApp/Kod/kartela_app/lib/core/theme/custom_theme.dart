import 'package:flutter/material.dart';
import '../../product/constant/product_colors.dart';

class CustomTheme {
  static CustomTheme? _instance;
  static CustomTheme get instance {
    _instance ??= CustomTheme._init();
    return _instance!;
  }

  CustomTheme._init();

  ThemeData get customTheme => _theme;

  final ThemeData _theme = ThemeData(
    scaffoldBackgroundColor: ProductColors.instance.white,
    useMaterial3: true,
    colorScheme:
        ColorScheme.fromSeed(seedColor: ProductColors.instance.deepForest),
  );
}
