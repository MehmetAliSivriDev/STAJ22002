import 'package:shared_preferences/shared_preferences.dart';

class CacheManager {
  static CacheManager? _instance;
  static CacheManager get instance {
    _instance ??= CacheManager._init();
    return _instance!;
  }

  CacheManager._init();

  Future<SharedPreferences> getInstance() async {
    final SharedPreferences prefs = await SharedPreferences.getInstance();
    return prefs;
  }

  Future<String?> getCompanyName() async {
    var prefs = await getInstance();
    return prefs.getString(CacheKeys.companyName.name);
  }

  Future<String?> getMail() async {
    var prefs = await getInstance();
    return prefs.getString(CacheKeys.mail.name);
  }

  Future<String?> getPhoneNumber() async {
    var prefs = await getInstance();
    return prefs.getString(CacheKeys.phoneNumber.name);
  }

  Future<String?> getLastOrderNumber() async {
    var prefs = await getInstance();
    return prefs.getString(CacheKeys.lastOrderNumber.name);
  }

  Future<void> saveCompanyName({required String value}) async {
    var prefs = await getInstance();
    prefs.setString(CacheKeys.companyName.name, value);
  }

  Future<void> saveMail({required String value}) async {
    var prefs = await getInstance();
    prefs.setString(CacheKeys.mail.name, value);
  }

  Future<void> savePhoneNumber({required String value}) async {
    var prefs = await getInstance();
    prefs.setString(CacheKeys.phoneNumber.name, value);
  }

  Future<void> saveLastOrderNumber({required String value}) async {
    var prefs = await getInstance();
    prefs.setString(CacheKeys.lastOrderNumber.name, value);
  }

  Future<void> removeCompanyName() async {
    var prefs = await getInstance();
    prefs.remove(CacheKeys.companyName.name);
  }

  Future<void> removeMail() async {
    var prefs = await getInstance();
    prefs.remove(CacheKeys.mail.name);
  }

  Future<void> removePhoneNumber() async {
    var prefs = await getInstance();
    prefs.remove(CacheKeys.phoneNumber.name);
  }

  Future<void> removeLastOrderNumber() async {
    var prefs = await getInstance();
    prefs.remove(CacheKeys.lastOrderNumber.name);
  }
}

enum CacheKeys { companyName, mail, phoneNumber, lastOrderNumber }
