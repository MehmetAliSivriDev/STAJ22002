import 'package:flutter/material.dart';
import 'package:kartal/kartal.dart';
import '../constant/product_colors.dart';
import '../constant/product_padding.dart';

class InfoCard extends StatelessWidget {
  const InfoCard({
    super.key,
    required this.text,
  });

  final String text;

  @override
  Widget build(BuildContext context) {
    return SizedBox(
      width: MediaQuery.of(context).size.width,
      height: MediaQuery.of(context).size.height * 0.08,
      child: Card(
        color: ProductColors.instance.grey300,
        child: Row(
          mainAxisAlignment: MainAxisAlignment.spaceEvenly,
          children: [
            Padding(
              padding: const ProductPadding.onlyleftLow(),
              child: Icon(Icons.info,
                  color: ProductColors.instance.grey850,
                  size: context.sized.dynamicWidth(0.08)),
            ),
            Expanded(
              child: SingleChildScrollView(
                child: Column(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Text(
                      text,
                      style: context.general.textTheme.titleMedium!.copyWith(
                        color: ProductColors.instance.grey850,
                      ),
                    ),
                  ],
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}
