import 'package:easy_localization/easy_localization.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:kartal/kartal.dart';
import 'package:kartela_app/core/lang/locale_strings.dart';
import '../validator/login_validator.dart';
import '../../../product/constant/product_colors.dart';
import '../../../product/constant/product_input_decoration.dart';
import 'package:intl_phone_field/intl_phone_field.dart';
import '../../../product/extension/images_extension.dart';
import 'package:provider/provider.dart';
import '../../../product/constant/product_border_radius.dart';
import '../../../product/constant/product_padding.dart';
import '../view_model/login_view_model.dart';

class LoginView extends StatelessWidget {
  const LoginView({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(LocaleStrings.companyInfo.tr()),
      ),
      body: _buildBody(context),
    );
  }

  Widget _buildBody(BuildContext context) {
    return SingleChildScrollView(
      child: Padding(
        padding: const ProductPadding.allHigh(),
        child: Form(
          key: context.read<LoginViewModel>().key,
          child: Column(
            children: [
              SizedBox(
                height: context.sized.dynamicHeight(0.1),
              ),
              _buildFields(context),
              SizedBox(
                height: context.sized.dynamicHeight(0.22),
              ),
              Image.asset(ImagesPNG.peykan_logo_2.logoPath)
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildFields(BuildContext context) {
    return SizedBox(
      width: context.sized.dynamicWidth(1),
      height: context.sized.dynamicHeight(0.42),
      child: Card(
        color: context.general.colorScheme.inversePrimary,
        elevation: 1,
        child: Column(
          children: [
            SizedBox(
              height: context.sized.dynamicHeight(0.015),
            ),
            Padding(
              padding: const ProductPadding.horizontalMedium(),
              child: _buildCNField(context),
            ),
            SizedBox(
              height: context.sized.dynamicHeight(0.015),
            ),
            Padding(
              padding: const ProductPadding.horizontalMedium(),
              child: _buildMField(context),
            ),
            SizedBox(
              height: context.sized.dynamicHeight(0.015),
            ),
            Padding(
              padding: const ProductPadding.horizontalMedium(),
              child: _buildPField(context),
            ),
            SizedBox(
              height: context.sized.dynamicHeight(0.01),
            ),
            SizedBox(
                width: context.sized.dynamicWidth(0.6),
                height: context.sized.dynamicHeight(0.06),
                child: FilledButton(
                    onPressed: () => context
                        .read<LoginViewModel>()
                        .validate(context: context),
                    child: Text(LocaleStrings.scontinue.tr())))
          ],
        ),
      ),
    );
  }

  Widget _buildPField(BuildContext context) {
    return SizedBox(
      width: context.sized.dynamicWidth(1),
      height: context.sized.dynamicHeight(0.1),
      child: IntlPhoneField(
        inputFormatters: [
          FilteringTextInputFormatter.allow(RegExp(r'[0-9]')),
        ],
        controller: context.read<LoginViewModel>().phoneController,
        keyboardType: TextInputType.number,
        decoration: InputDecoration(
          filled: true,
          fillColor: ProductColors.instance.grey200,
          labelText: "",
          border: OutlineInputBorder(
              borderRadius: ProductBorderRadius.circularHigh(),
              borderSide: BorderSide(color: ProductColors.instance.grey400)),
        ),
        initialCountryCode: 'TR',
      ),
    );
  }

  Widget _buildMField(BuildContext context) {
    return SizedBox(
      width: context.sized.dynamicWidth(1),
      height: context.sized.dynamicHeight(0.07),
      child: TextFormField(
        validator: (value) => LoginValidator.instance.mailValidator(value),
        controller: context.read<LoginViewModel>().mailController,
        decoration:
            ProductInputDecoration.loginTF(context, LocaleStrings.mail.tr()),
      ),
    );
  }

  Widget _buildCNField(BuildContext context) {
    return SizedBox(
      width: context.sized.dynamicWidth(1),
      height: context.sized.dynamicHeight(0.07),
      child: TextFormField(
        validator: (value) =>
            LoginValidator.instance.companyNameValidator(value),
        controller: context.read<LoginViewModel>().companyNameController,
        decoration: ProductInputDecoration.loginTF(
            context, LocaleStrings.companyName.tr()),
      ),
    );
  }
}
