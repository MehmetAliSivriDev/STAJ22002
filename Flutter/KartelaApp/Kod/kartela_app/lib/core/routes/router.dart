import 'package:flutter/material.dart';
import 'package:kartela_app/features/order_cart/view/order_cart_view.dart';
import 'package:kartela_app/features/order_past/view/order_past_preview.dart';
// import 'package:kartela_app/features/order_past/view/order_past_view.dart';
import '../../features/data_display/view/data_display_view.dart';
import '../../features/home/view/home_view.dart';
import '../../features/login/view/login_view.dart';
import '../../features/settings/view/settings_view.dart';
import '../../features/splash/view/splash_view.dart';
import 'routes.dart';

class CRouter {
  static Route<dynamic> generateRoute(RouteSettings settings) {
    switch (settings.name) {
      case Routes.SPLASH:
        return MaterialPageRoute(
          builder: (_) => const SplashView(),
        );

      case Routes.LOGIN:
        return MaterialPageRoute(
          builder: (_) => const LoginView(),
        );

      case Routes.HOME:
        return MaterialPageRoute(
          builder: (_) => const HomeView(),
        );

      case Routes.SETTINGS:
        return MaterialPageRoute(
          builder: (_) => const SettingsView(),
        );

      case Routes.DATADISPLAY:
        return MaterialPageRoute(
          builder: (_) => const DataDisplayView(),
        );

      case Routes.ORDERCART:
        return MaterialPageRoute(
          builder: (_) => const OrderCartView(),
        );

      // case Routes.ORDERPAST:
      //   return MaterialPageRoute(
      //     builder: (_) => const OrderPastView(),
      //   );

      case Routes.ORDERPASTPREVIEW:
        return MaterialPageRoute(
          builder: (_) => const OrderPastPreviw(),
        );

      default:
        return MaterialPageRoute(
            builder: (_) => const Center(
                  child: CircularProgressIndicator(),
                ));
    }
  }
}
