import 'package:flutter/material.dart';

class LocaleList {
  static Locale getLocale({required LocaleNames localeName}) {
    if (localeName == LocaleNames.ENGLISH) {
      return const Locale('en');
    } else if (localeName == LocaleNames.TURKISH) {
      return const Locale('tr');
    } else {
      return const Locale('tr');
    }
  }

  static List<Locale> getSupportedLocales() {
    return [
      LocaleList.getLocale(localeName: LocaleNames.ENGLISH),
      LocaleList.getLocale(localeName: LocaleNames.TURKISH)
    ];
  }
}

enum LocaleNames { ENGLISH, TURKISH }
