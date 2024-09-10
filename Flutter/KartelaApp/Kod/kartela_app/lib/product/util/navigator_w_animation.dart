import 'package:flutter/material.dart';

class NavigatorWAnimation {
  static void bottomToUp(
      {required BuildContext context, required Widget widget}) {
    Navigator.push(
        context,
        PageRouteBuilder(
          pageBuilder: (context, animation, secondaryAnimation) {
            return widget;
          },
          transitionDuration: const Duration(milliseconds: 200),
          transitionsBuilder: (context, animation, secondaryAnimation, child) {
            return SlideTransition(
              position:
                  Tween<Offset>(begin: const Offset(0, 1), end: Offset.zero)
                      .animate(animation),
              child: child,
            );
          },
        ));
  }

  static void rightToLeft(
      {required BuildContext context, required Widget widget}) {
    Navigator.push(
        context,
        PageRouteBuilder(
          pageBuilder: (context, animation, secondaryAnimation) {
            return widget;
          },
          transitionDuration: const Duration(milliseconds: 200),
          transitionsBuilder: (context, animation, secondaryAnimation, child) {
            return SlideTransition(
              position:
                  Tween<Offset>(begin: const Offset(1, 0), end: Offset.zero)
                      .animate(animation),
              child: child,
            );
          },
        ));
  }
}
