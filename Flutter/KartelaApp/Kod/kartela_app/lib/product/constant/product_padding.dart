import 'package:flutter/material.dart';

class ProductPadding extends EdgeInsets {
  //All
  const ProductPadding.allLow() : super.all(10);
  const ProductPadding.allMedium() : super.all(15);
  const ProductPadding.allHigh() : super.all(20);
  const ProductPadding.allHigh50() : super.all(50);

  //Symmetric
  const ProductPadding.horizontalLow() : super.symmetric(horizontal: 10);
  const ProductPadding.horizontalMedium() : super.symmetric(horizontal: 15);
  const ProductPadding.horizontalHigh() : super.symmetric(horizontal: 20);

  const ProductPadding.verticalLow() : super.symmetric(vertical: 10);
  const ProductPadding.verticalMedium() : super.symmetric(vertical: 15);
  const ProductPadding.verticalHigh() : super.symmetric(vertical: 20);

  //Only
  const ProductPadding.onlyl20t15() : super.only(left: 20, top: 15);
  const ProductPadding.onlyl15t15b10()
      : super.only(left: 15, top: 15, bottom: 10);
  const ProductPadding.onlyl15r15b20()
      : super.only(left: 15, right: 15, bottom: 20);
  const ProductPadding.onlyl15r15t20b15()
      : super.only(left: 15, right: 15, bottom: 15, top: 20);
  const ProductPadding.onlyl15r15b10()
      : super.only(left: 15, right: 15, bottom: 15);

  const ProductPadding.onlyleftLow() : super.only(left: 10);
  const ProductPadding.onlyleftMedium() : super.only(left: 15);
  const ProductPadding.onlyleftHigh() : super.only(left: 20);

  //Bottom
  const ProductPadding.bottomLow() : super.only(bottom: 10);
  const ProductPadding.bottomMedium() : super.only(bottom: 15);
  const ProductPadding.bottomHigh() : super.only(bottom: 20);
  const ProductPadding.bottomHighPlus25() : super.only(bottom: 25);
  const ProductPadding.bottomHighPlus30() : super.only(bottom: 30);

  //Top
  const ProductPadding.topLow() : super.only(top: 10);
  const ProductPadding.topMedium() : super.only(top: 15);
  const ProductPadding.topHigh() : super.only(top: 20);
}
