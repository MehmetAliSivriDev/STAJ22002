<?php 

    function sendEmail($to, $subject, $htmlContent, $from)
        {
            // E-posta başlıkları
            $headers  = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: " . $from . "\r\n";

            // E-postayı gönder
            if (mail($to, $subject, $htmlContent, $headers)) {
                echo "E-posta başarıyla gönderildi.";
            } else {
                echo "E-posta gönderilemedi.";
            }
        }

    // Config dosyasını dahil et
    include('backend/config.php');


    //Ürünü kullanan firmanın bilgilerini alma
    $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL sorgusu 
    $sql3 = "SELECT * FROM ci";
    $stmt3 = $conn->prepare($sql3);

    // Sorguyu çalıştır
    $stmt3->execute();
    $result = $stmt3->fetchAll(PDO::FETCH_ASSOC);
    $result = $result[0];
    // Kullanım
    $to = "mehmetalisivri.dev@gmail.com"; // Alıcının e-posta adresi
    $subject = "PEYKAN KARTELA SİPARİŞ BİLGİSİ"; // E-posta konusu
    $from = "info@peykan.com.tr"; // Gönderenin e-posta adresi

    // HTML içeriği
    $htmlContent = '
 <html>
    <head>
        <title>SİPARİŞ BİLGİSİ</title>
    </head>
    <body>
        <h3>Yeni Bir Sipariş Aldınız!</h3><br>
        <p><b>3</b> Sipariş Numaralı yeni bir sipariş almış bulunmaktasınız.</p>
        <p>Güncel siparişlerinizi görüntülemek için aşağıdaki linki ziyaret edin.</p>
        <a href="http://peykansoft.com/kartelaweb/kartelamail/company_orders.php?companyMail='.$result["cMail"].'">Siparişleri Görüntüle</a><br><br>     
        <a href="www.peykan.com.tr">PEYKAN Yazılım & Otomasyon ve Elektronik</a><br>
        <p><b>Tel:</b> +90 224 256 07 39 - 40</p>
        <p><b>Faks:</b> +90 224 256 07 38</p>
        <p><b>Email:</b> info@peykan.com.tr</p>
        <p><b>Adres:</b> Alaaddinbey Mah. İzmir yolu Cad.
                        Cengizhan İş Merkezi No:297 / 46 kat:2
                        NİLÜFER - BURSA / TÜRKIYE</p>
    </body>
</html>';

    sendEmail($to, $subject, $htmlContent, $from);

?>
