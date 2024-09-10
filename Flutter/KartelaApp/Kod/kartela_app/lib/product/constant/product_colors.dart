import 'package:flutter/material.dart';

class ProductColors {
  static ProductColors? _instance;
  static ProductColors get instance {
    _instance ??= ProductColors._init();
    return _instance!;
  }

  ProductColors._init();

  Color white = Colors.white;
  Color black = Colors.black;

  Color lightHouse = const Color(0xffF4F4F4);
  Color deepForest = const Color(0xff22372B);

  Color delRed = const Color(0xffb20a2c);
  Color blue700 = Colors.blue[700]!;

  Color grey200 = Colors.grey[200]!;
  Color grey300 = Colors.grey[300]!;
  Color grey400 = Colors.grey[400]!;
  Color grey = Colors.grey;
  Color grey600 = Colors.grey[600]!;
  Color grey800 = Colors.grey[800]!;
  Color grey850 = Colors.grey[850]!;

  Color green = Colors.green;
  Color blue = Colors.blue;
}
