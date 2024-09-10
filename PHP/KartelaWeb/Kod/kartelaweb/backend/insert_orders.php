<?php
session_start();

function test_input($data){ 
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

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
include('config.php');


if(isset($_POST["companyName"]) && isset($_POST["companyMail"]) && isset($_POST["companyPhone"])){

    // Veritabanı bağlantısını kur
    try {
        $companyName = test_input($_POST["companyName"]);
        $email = test_input($_POST["companyMail"]);
        $phone = test_input($_POST["companyPhone"]);
        $orders = $_SESSION["cart"];
        $date = date('Y-m-d');
        $hour = date('H:i:s');

        $username = $_SESSION["username"];

        //Order Number verisini alma
        $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         // SQL sorgusu 
        $sql2 = "SELECT TOP(1) OrderNumber FROM Orders ORDER BY Id DESC";
        $stmt2 = $conn->prepare($sql2);

        // Sorguyu çalıştır
        $stmt2->execute();
        $results = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        if(count($results) > 0){
            $results = $results[0];
            $orderNumber = $results["OrderNumber"];
            $orderNumber = strval(((int)$orderNumber) + 1);
        }else {
            $orderNumber = "1";
        }

        foreach ($orders as $data) {
           // SQL INSERT sorgusu
            $sql = "INSERT INTO Orders (CompanyName, Email, Phone, KartelaBar,orderCount, ODate, OHour,OrderNumber,pUsername) VALUES (:v1, :v2, :v3, :v4, :v5, :v6, :v7, :v8, :v9)";
            $stmt = $conn->prepare($sql);

            // Bind parametreleri
            $stmt->bindParam(':v1', $companyName);
            $stmt->bindParam(':v2', $email);
            $stmt->bindParam(':v3', $phone);
            $stmt->bindParam(':v4', $data["Bar"]);
            $stmt->bindParam(':v5', $data["count"]);
            $stmt->bindParam(':v6', $date);
            $stmt->bindParam(':v7', $hour);
            $stmt->bindParam(':v8', $orderNumber);
            $stmt->bindParam(':v9', $username);

            // Sorguyu çalıştır
            $stmt->execute(); 
        }

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
        $to = "proje@peykan.com.tr"; // Alıcının e-posta adresi
        // $to = $email; // Alıcının e-posta adresi
        $subject = "PEYKAN KARTELA SİPARİŞ BİLGİSİ"; // E-posta konusu
        $from = "info@peykan.com.tr"; // Gönderenin e-posta adresi

        // HTML içeriği
        $htmlContent = '
        <html>
        <head>
            <title>SİPARİŞ BİLGİSİ</title>
        </head>
        <body>
            <h3>Yeni Bir Sipariş Verdiniz!</h3><br>
            <p><b>'.$orderNumber.'</b> Sipariş Numaralı yeni bir sipariş vermiş bulunmaktasınız.</p>
            <p>Güncel siparişlerinizi görüntülemek için aşağıdaki linki ziyaret edin.</p>
            <a href="http://peykansoft.com/kartelaweb/kartelamail/company_orders.php?companyMail='.$email.'">Siparişleri Görüntüle</a><br><br>     
            <a href="www.peykan.com.tr">PEYKAN Yazılım & Otomasyon ve Elektronik</a><br>
            <p><b>Tel:</b> +90 224 256 07 39 - 40</p>
            <p><b>Faks:</b> +90 224 256 07 38</p>
            <p><b>Email:</b> info@peykan.com.tr</p>
            <p><b>Adres:</b> Alaaddinbey Mah. İzmir yolu Cad.
                            Cengizhan İş Merkezi No:297 / 46 kat:2
                            NİLÜFER - BURSA / TÜRKIYE</p>
        </body>
        </html>';

        // Kullanım
        $to2 = "satis@peykan.com.tr"; // Alıcının e-posta adresi
        // $to = $result["cMail"]; // Alıcının e-posta adresi
        $subject2 = "Yeni Bir Sipariş Aldınız!"; // E-posta konusu
        $from2 = "info@peykan.com.tr"; // Gönderenin e-posta adresi

        // HTML içeriği
        $htmlContent2 = '
        <html>
        <head>
            <title>SİPARİŞ BİLGİSİ</title>
        </head>
        <body>
            <p>#<b>'.$orderNumber.'</b> numaralı yeni bir sipariş '.$username.' personeli tarafından alınmıştır.</p>
            <h4>Firma İletişim Bilgileri</h4>
            <p><b>Firma Adı: </b>'.$companyName.'</p>
            <p><b>Firma Mail: </b>'.$email.'</p>
            <p><b>Firma Telefon Numarası: </b>'.$phone.'</p>
            <hr>
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
        sendEmail($to2, $subject2, $htmlContent2, $from2);

        $_SESSION["result"] = "1";
        $_SESSION["message"] = "Siparişiniz Başarıyla Alındı";
        $_SESSION["cart"] = array();

        header("Location: /kartelaweb/view/show_alert_view.php");

    } catch (PDOException $e) {
        $_SESSION["result"] = "0";
        $_SESSION["message"] = "Bir Hata Meydana Geldi";
        header("Location: /kartelaweb/view/show_alert_view.php");
    }

}else{
    $_SESSION["result"] = "-1";
    $_SESSION["message"] = "Form Gönderiminde Bir Hata Meydana Geldi";
    header("Location: /kartelaweb/view/show_alert_view.php");
}

// Bağlantıyı kapat
$conn = null;

?>
