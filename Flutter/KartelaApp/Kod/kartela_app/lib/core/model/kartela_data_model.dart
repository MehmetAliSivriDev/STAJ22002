class KartelaDataModel {
  String? id;
  String? bar;
  String? varyant;
  String? desen;
  String? com;
  String? desenKod;
  String? kg;
  String? en;
  String? renk;
  String? tip;
  String? kEn;
  String? tarih;
  String? active;

  KartelaDataModel(
      {this.id,
      this.bar,
      this.varyant,
      this.desen,
      this.com,
      this.desenKod,
      this.kg,
      this.en,
      this.renk,
      this.tip,
      this.kEn,
      this.tarih,
      this.active});

  KartelaDataModel.fromJson(Map<String, dynamic> json) {
    id = json['Id'].toString();
    bar = json['Bar'];
    varyant = json['Varyant'];
    desen = json['Desen'];
    com = json['Com'];
    desenKod = json['DesenKod'];
    kg = json['Kg'];
    en = json['En'];
    renk = json['Renk'];
    tip = json['Tip'];
    kEn = json['KEn'];
    tarih = json['Tarih'];
    active = json['Active'];
  }

  KartelaDataModel.fromJsonJustType(Map<String, dynamic> json) {
    tip = json['Tip'];
  }

  KartelaDataModel.fromJsonJustColor(Map<String, dynamic> json) {
    renk = json['Renk'];
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['Id'] = this.id;
    data['Bar'] = this.bar;
    data['Varyant'] = this.varyant;
    data['Desen'] = this.desen;
    data['Com'] = this.com;
    data['DesenKod'] = this.desenKod;
    data['Kg'] = this.kg;
    data['En'] = this.en;
    data['Renk'] = this.renk;
    data['Tip'] = this.tip;
    data['KEn'] = this.kEn;
    data['Tarih'] = this.tarih;
    data['Active'] = this.active;
    return data;
  }
}
