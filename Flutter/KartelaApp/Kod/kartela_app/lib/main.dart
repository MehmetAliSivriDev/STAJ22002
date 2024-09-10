import 'package:easy_localization/easy_localization.dart';
import 'package:flutter/material.dart';
import 'core/init/providers.dart';
import 'core/lang/locale_list.dart';
import 'core/routes/router.dart';
import 'core/routes/routes.dart';
import 'core/theme/custom_theme.dart';
import 'package:provider/provider.dart';

Future<void> main() async {
  WidgetsFlutterBinding.ensureInitialized();
  await EasyLocalization.ensureInitialized();

  runApp(
    MultiProvider(
      providers: Providers.getProviders,
      builder: (context, child) => EasyLocalization(
          supportedLocales: LocaleList.getSupportedLocales(),
          path: 'assets/lang',
          fallbackLocale: LocaleList.getLocale(localeName: LocaleNames.TURKISH),
          child: const MyApp()),
    ),
  );
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      theme: CustomTheme.instance.customTheme,
      localizationsDelegates: context.localizationDelegates,
      supportedLocales: context.supportedLocales,
      locale: context.locale,
      onGenerateRoute: CRouter.generateRoute,
      initialRoute: Routes.SPLASH,
      title: 'Kartela App',
    );
  }
}
