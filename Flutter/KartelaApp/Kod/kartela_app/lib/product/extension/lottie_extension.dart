import 'package:lottie/lottie.dart';

enum Lotties { search_not_found }

extension LottiesExtension on Lotties {
  String get getPath => "assets/lottie/$name.json";

  LottieBuilder get getLottie => Lottie.asset(getPath);
}
