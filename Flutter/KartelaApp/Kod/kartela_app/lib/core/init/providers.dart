import 'package:kartela_app/features/order/view_model/order_view_model.dart';
import 'package:kartela_app/features/order_cart/view_model/order_cart_view_model.dart';
import 'package:kartela_app/features/order_past/view_model/order_past_view_model.dart';

import '../../features/data_display/view_model/data_display_view_model.dart';
import '../../features/home/view_model/home_view_model.dart';
import '../../features/login/view_model/login_view_model.dart';
import '../../features/settings/view_model/settings_view_model.dart';
import '../../features/splash/view_model/splash_view_model.dart';
import 'package:provider/provider.dart';
import 'package:provider/single_child_widget.dart';

class Providers {
  static List<SingleChildWidget> getProviders = [
    ChangeNotifierProvider(
      create: (context) => SplashViewModel(),
    ),
    ChangeNotifierProvider(
      create: (context) => LoginViewModel(),
    ),
    ChangeNotifierProvider(
      create: (context) => HomeViewModel(),
    ),
    ChangeNotifierProvider(
      create: (context) => SettingsViewModel(),
    ),
    ChangeNotifierProvider(
      create: (context) => DataDisplayViewModel(),
    ),
    ChangeNotifierProvider(
      create: (context) => OrderViewModel(),
    ),
    ChangeNotifierProvider(
      create: (context) => OrderCartViewModel(),
    ),
    ChangeNotifierProvider(
      create: (context) => OrderPastViewModel(),
    ),
  ];
}
