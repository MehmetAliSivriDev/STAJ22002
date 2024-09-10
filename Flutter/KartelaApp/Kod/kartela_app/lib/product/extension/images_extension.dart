// ignore_for_file: constant_identifier_names

enum ImagesJPG { peykan_logo_1 }

enum ImagesPNG { peykan_logo_2 }

extension ImagesJPGExtension on ImagesJPG {
  String get logoPath => 'assets/images/logo/$name.jpg';
  String get path => 'assets/images/$name.jpg';
}

extension ImagesPNGExtension on ImagesPNG {
  String get logoPath => 'assets/images/logo/$name.png';
  String get path => 'assets/images/$name.png';
}
