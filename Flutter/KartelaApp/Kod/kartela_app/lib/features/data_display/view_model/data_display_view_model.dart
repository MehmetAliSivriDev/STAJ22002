import 'package:easy_localization/easy_localization.dart';
import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import 'package:kartela_app/core/lang/locale_strings.dart';

import '../../../core/model/kartela_data_model.dart';
import '../../../core/service/local_service/dbHelper.dart';

class DataDisplayViewModel extends ChangeNotifier {
  List<KartelaDataModel>? data;
  List<String>? kartelaDataTypes;
  List<String>? kartelaDataColors;
  final DbHelper _dbHelper = DbHelper();

  TextEditingController searchController = TextEditingController();

  // String? selectedType;
  bool isLoading = false;
  bool isSearched = false;

  String filteredType = "";

  void changeLoading() {
    isLoading = !isLoading;
    notifyListeners();
  }

  Future<void> getDataFromLocale() async {
    changeLoading();
    _dbHelper.createDb().then((value) => null);
    data = await _dbHelper.getKartelaData();
    //Just Types For Filtering
    kartelaDataTypes = await _dbHelper.getKartelaDataTypes();
    kartelaDataColors = await _dbHelper.getKartelaDataColors();
    await Future.delayed(const Duration(milliseconds: 1000));
    changeLoading();
  }

  void searchKartelaDataWBarcode() async {
    changeLoading();
    _dbHelper.createDb().then((value) => null);
    data =
        await _dbHelper.getKartelaDataWBarcode(barcode: searchController.text);
    await Future.delayed(const Duration(milliseconds: 1000));
    changeLoading();
  }

  void searchKartelaDataWType({required String selectedType}) async {
    changeLoading();
    _dbHelper.createDb().then((value) => null);
    data = await _dbHelper.getKartelaDataWTypes(type: selectedType);
    await Future.delayed(const Duration(milliseconds: 1000));
    filteredType = LocaleStrings.filterType.tr();
    changeLoading();
  }

  void searchKartelaDataWColors({required String selectedColor}) async {
    changeLoading();
    _dbHelper.createDb().then((value) => null);
    data = await _dbHelper.getKartelaDataWColors(color: selectedColor);
    await Future.delayed(const Duration(milliseconds: 1000));
    filteredType = LocaleStrings.filterColor.tr();
    changeLoading();
  }

  // void setSelectedType({required String value}) {
  //   selectedType = value;
  //   notifyListeners();
  // }
}
