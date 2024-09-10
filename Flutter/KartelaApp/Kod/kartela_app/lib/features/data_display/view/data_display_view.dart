import 'dart:async';

import 'package:easy_localization/easy_localization.dart';
import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import 'package:kartal/kartal.dart';
import 'package:kartela_app/product/constant/product_box_decorations.dart';
import 'package:kartela_app/product/constant/product_colors.dart';
import 'package:kartela_app/product/widget/divider_close_button.dart';
import 'package:kartela_app/product/widget/kartela_data_container.dart';
import '../../../core/lang/locale_strings.dart';
import '../view_model/data_display_view_model.dart';
import '../../../product/constant/product_padding.dart';
import '../../../product/mixin/show_bottom_sheet.dart';
import '../../../product/widget/info_card.dart';
import 'package:provider/provider.dart';
import '../../../product/constant/product_input_decoration.dart';

class DataDisplayView extends StatelessWidget with ShowBottomSheet {
  const DataDisplayView({super.key});

  @override
  Widget build(BuildContext context) {
    Future.microtask(() =>
        Provider.of<DataDisplayViewModel>(context, listen: false)
            .getDataFromLocale());

    return Scaffold(
      floatingActionButton: Consumer<DataDisplayViewModel>(
        builder: (context, viewModel, _) {
          return _buildSearchFAButton(viewModel, context);
        },
      ),
      appBar: _buildAppBar(),
      body: _buildBody(),
    );
  }

  Widget _buildBody() {
    return Padding(
      padding: const ProductPadding.allMedium(),
      child: Consumer<DataDisplayViewModel>(
        builder: (context, viewModel, _) {
          return viewModel.isLoading == true
              ? const Center(
                  child: CircularProgressIndicator(),
                )
              : _buildKartelaData(viewModel);
        },
      ),
    );
  }

  Widget _buildKartelaData(DataDisplayViewModel viewModel) {
    return Column(
      children: [
        Padding(
          padding: const ProductPadding.bottomLow(),
          child: InfoCard(
              text:
                  "${LocaleStrings.numberofDataDisplayed.tr()} : ${viewModel.data?.length}${viewModel.filteredType != "" ? "\n${viewModel.filteredType}" : ""}"),
        ),
        Expanded(
          child: ListView.separated(
            itemCount: viewModel.data?.length ?? 0,
            separatorBuilder: (context, index) {
              return SizedBox(
                height: context.sized.dynamicHeight(0.05),
              );
            },
            itemBuilder: (context, index) {
              return KartelaDataContainer(
                  model: viewModel.data![index], isShoppingActive: true);
            },
          ),
        ),
      ],
    );
  }

  AppBar _buildAppBar() {
    return AppBar(
      actions: [
        Padding(
          padding: const ProductPadding.horizontalMedium(),
          child:
              Consumer<DataDisplayViewModel>(builder: (context, viewModel, _) {
            return IconButton(
              onPressed: () {
                showCustomSheet(
                    context,
                    SizedBox(
                      width: context.sized.dynamicWidth(1),
                      height: context.sized.dynamicHeight(0.45),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          const DividerCloseButton(),
                          Padding(
                            padding: const ProductPadding.allMedium(),
                            child: Text(
                              LocaleStrings.filter.tr(),
                              style: context.general.textTheme.headlineSmall!
                                  .copyWith(
                                      color: ProductColors.instance.grey600),
                            ),
                          ),
                          Padding(
                            padding: const ProductPadding.allMedium(),
                            child: _buildFilterWType(context, viewModel),
                          ),
                          Padding(
                            padding: const ProductPadding.allMedium(),
                            child: _buildFilterWColor(context, viewModel),
                          ),
                        ],
                      ),
                    ));
              },
              icon: const Icon(Icons.filter_list_rounded),
            );

            // viewModel.kartelaDataTypes == null
            //     ? const SizedBox.shrink()
            //     : _buildDDFilter(viewModel);
          }),
        )
      ],
      title: Text(LocaleStrings.viewDataTitle.tr()),
    );
  }

  Widget _buildFilterWColor(
      BuildContext context, DataDisplayViewModel viewModel) {
    return Container(
      decoration: ProductBoxDecorations.settingsDecoration(),
      child: ListTile(
        onTap: () {
          Navigator.pop(context);
          showCustomSheet(
              context,
              SizedBox(
                width: context.sized.dynamicWidth(1),
                height: context.sized.dynamicHeight(0.6),
                child: Column(
                  children: [
                    const DividerCloseButton(),
                    Expanded(
                        child: ListView.builder(
                      itemCount: viewModel.kartelaDataColors?.length ?? 0,
                      itemBuilder: (context, index) {
                        return Padding(
                          padding: const ProductPadding.allMedium(),
                          child: Container(
                            decoration:
                                ProductBoxDecorations.settingsDecoration(),
                            child: ListTile(
                              onTap: () {
                                Navigator.pop(context);
                                viewModel.searchKartelaDataWColors(
                                    selectedColor:
                                        viewModel.kartelaDataColors?[index] ??
                                            "");
                                viewModel.isSearched = true;
                              },
                              title: Text(
                                  viewModel.kartelaDataColors?[index] ?? "",
                                  style: context.general.textTheme.titleLarge),
                              trailing:
                                  const Icon(Icons.arrow_forward_ios_rounded),
                            ),
                          ),
                        );
                      },
                    ))
                  ],
                ),
              ));
        },
        title: Text(LocaleStrings.filterColor.tr(),
            style: context.general.textTheme.titleLarge),
        trailing: const Icon(Icons.arrow_forward_ios_rounded),
      ),
    );
  }

  Widget _buildFilterWType(
      BuildContext context, DataDisplayViewModel viewModel) {
    return Container(
      decoration: ProductBoxDecorations.settingsDecoration(),
      child: ListTile(
        onTap: () {
          Navigator.pop(context);
          showCustomSheet(
              context,
              SizedBox(
                width: context.sized.dynamicWidth(1),
                height: context.sized.dynamicHeight(0.6),
                child: Column(
                  children: [
                    const DividerCloseButton(),
                    Expanded(
                      child: ListView.builder(
                        itemCount: viewModel.kartelaDataTypes?.length ?? 0,
                        itemBuilder: (context, index) {
                          return Padding(
                            padding: const ProductPadding.allMedium(),
                            child: Container(
                              decoration:
                                  ProductBoxDecorations.settingsDecoration(),
                              child: ListTile(
                                onTap: () {
                                  Navigator.pop(context);
                                  viewModel.searchKartelaDataWType(
                                      selectedType:
                                          viewModel.kartelaDataTypes?[index] ??
                                              "");
                                  viewModel.isSearched = true;
                                },
                                title: Text(
                                    viewModel.kartelaDataTypes?[index] ?? "",
                                    style:
                                        context.general.textTheme.titleLarge),
                                trailing:
                                    const Icon(Icons.arrow_forward_ios_rounded),
                              ),
                            ),
                          );
                        },
                      ),
                    ),
                  ],
                ),
              ));
        },
        title: Text(LocaleStrings.filterType.tr(),
            style: context.general.textTheme.titleLarge),
        trailing: const Icon(Icons.arrow_forward_ios_rounded),
      ),
    );
  }

  // Widget _buildDDFilter(DataDisplayViewModel viewModel) {
  //   return DropdownButton(
  //       hint: Text(LocaleStrings.type.tr()),
  //       value: viewModel.selectedType,
  //       borderRadius: ProductBorderRadius.circularMedium(),
  //       icon: const Icon(Icons.filter_list_rounded),
  //       items: viewModel.kartelaDataTypes!
  //           .map((data) => DropdownMenuItem(value: data, child: Text(data)))
  //           .toList(),
  //       onChanged: (value) {
  //         viewModel.setSelectedType(value: value ?? "");
  //         // viewModel.searchKartelaDataWType();
  //         viewModel.isSearched = true;
  //       });
  // }

  Widget _buildSearchFAButton(
      DataDisplayViewModel viewModel, BuildContext context) {
    return FloatingActionButton.extended(
      label: Text(
          viewModel.isSearched == true
              ? LocaleStrings.refresh.tr()
              : LocaleStrings.search.tr(),
          style: context.general.textTheme.titleMedium),
      icon: Icon(
        viewModel.isSearched == true ? Icons.sync : Icons.search,
        size: context.sized.dynamicWidth(0.05),
      ),
      onPressed: viewModel.isSearched == true
          ? () {
              viewModel.isSearched = false;
              viewModel.getDataFromLocale();
              viewModel.filteredType = "";
              // viewModel.selectedType = null;
            }
          : () {
              AlertDialog searchDialog = AlertDialog(
                title: Text(
                  LocaleStrings.search.tr(),
                  style: context.general.textTheme.headlineSmall,
                ),
                content: SizedBox(
                  width: context.sized.dynamicWidth(1),
                  height: context.sized.dynamicHeight(0.24),
                  child: Column(
                    children: [
                      TextField(
                        decoration: ProductInputDecoration.searchTFDecoration(
                            hint: LocaleStrings.barcode.tr()),
                        maxLength: 8,
                        controller: viewModel.searchController,
                      ),
                      SizedBox(
                        height: context.sized.dynamicHeight(0.015),
                      ),
                      SizedBox(
                        width: context.sized.dynamicWidth(0.6),
                        child: FilledButton(
                            onPressed: () {
                              viewModel.searchKartelaDataWBarcode();
                              viewModel.isSearched = true;
                              Navigator.pop(context);
                            },
                            child: Text(LocaleStrings.search.tr())),
                      ),
                    ],
                  ),
                ),
              );

              showDialog(context: context, builder: (_) => searchDialog);
            },
    );
  }
}
