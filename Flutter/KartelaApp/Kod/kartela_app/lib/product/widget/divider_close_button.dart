import 'package:flutter/material.dart';
import 'package:kartal/kartal.dart';

class DividerCloseButton extends StatelessWidget {
  const DividerCloseButton({
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    return SizedBox(
      height: context.sized.height * 0.05,
      child: Stack(
        children: [
          Divider(
            color: Colors.black,
            thickness: 3,
            indent: context.sized.width * 0.4,
            endIndent: context.sized.width * 0.4,
          ),
          Positioned(
              top: 5,
              right: 10,
              child: InkWell(
                onTap: () {
                  Navigator.pop(context);
                },
                child: const Icon(Icons.close),
              )),
        ],
      ),
    );
  }
}
