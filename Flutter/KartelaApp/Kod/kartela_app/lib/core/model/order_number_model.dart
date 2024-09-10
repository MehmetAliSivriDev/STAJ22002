class OrderNumberModel {
  String? orderNumber;
  String? count;

  OrderNumberModel({this.orderNumber, this.count});

  OrderNumberModel.fromJson(Map<String, dynamic> json) {
    orderNumber = json['OrderNumber'];
    count = json['Count'].toString();
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['OrderNumber'] = this.orderNumber;
    data['Count'] = this.count;
    return data;
  }
}
