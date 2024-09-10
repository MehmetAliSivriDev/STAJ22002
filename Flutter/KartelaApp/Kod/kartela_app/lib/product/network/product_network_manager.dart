class ProductNetworkManager {
  static ProductNetworkManager? _instance;
  static ProductNetworkManager get instance {
    _instance ??= ProductNetworkManager._init();
    return _instance!;
  }

  ProductNetworkManager._init();

  //For Localhost

  // final getKartelaData = Uri.parse('http://10.0.2.2/mssqlvericekme');
  // // final getKartelaData = Uri.parse(
  // //     'https://www.peykansoft.com/mobilmssqlbackend/get_data_static.php');
  // final insertOrder =
  //     Uri.parse('http://10.0.2.2/mssqlvericekme/insert_order.php');
  // final getOrders = Uri.parse('http://10.0.2.2/mssqlvericekme/get_orders.php');
  // final getLastOrderNumber =
  //     Uri.parse('http://10.0.2.2/mssqlvericekme/get_last_order_number.php');

  //For Domain

  final getKartelaData =
      Uri.parse('https://www.peykansoft.com/mobilmssqlbackend/');
  // final getKartelaData = Uri.parse(
  //     'https://www.peykansoft.com/mobilmssqlbackend/get_data_static.php');
  final insertOrder = Uri.parse(
      'https://www.peykansoft.com/mobilmssqlbackend/insert_order.php');
  final getOrders =
      Uri.parse('https://www.peykansoft.com/mobilmssqlbackend/get_orders.php');
  final getLastOrderNumber = Uri.parse(
      'https://www.peykansoft.com/mobilmssqlbackend/get_last_order_number.php');
}
