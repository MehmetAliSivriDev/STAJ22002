<?php
// Config dosyasını dahil et
include('config.php');


if(isset($_POST["CompanyName"]) && isset($_POST["Email"]) && isset($_POST["Phone"]) && isset($_POST["OrderNumber"])
    && isset($_POST["KartelaBar"])  && isset($_POST["orderCount"]) && isset($_POST["ODate"])  && isset($_POST["OHour"])){

    // Veritabanı bağlantısını kur
    try {

        $companyName = $_POST["CompanyName"];
        $email = $_POST["Email"];
        $phone = $_POST["Phone"];
        $kartelaBar = $_POST["KartelaBar"];
        $orderCount = $_POST["orderCount"];
        $oDate = $_POST["ODate"];
        $oHour = $_POST["OHour"];
        $orderNumber = $_POST["OrderNumber"];
        
        $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         // SQL sorgusu 
        $sql2 = "SELECT TOP(1) ODate, OHour FROM Orders ORDER BY Id DESC";
        $stmt2 = $conn->prepare($sql2);

        // Sorguyu çalıştır
        $stmt2->execute();
        $results = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        if(count($results) > 0){
            // Sonuçları al
            $results = $results[0];
            $lastDBDateHourS = "$results[ODate] $results[OHour]";
            $sentDateHourS = " $oDate $oHour";

            $lastDBDateHour = new DateTime($lastDBDateHourS);
            $sentDateHour = new DateTime($sentDateHourS);

            if($sentDateHour > $lastDBDateHour){           

                // SQL INSERT sorgusu
                $sql = "INSERT INTO Orders (CompanyName, Email, Phone, KartelaBar,orderCount, ODate, OHour,OrderNumber) VALUES (:v1, :v2, :v3, :v4, :v5, :v6, :v7, :v8)";
                $stmt = $conn->prepare($sql);

                // Bind parametreleri
                $stmt->bindParam(':v1', $companyName);
                $stmt->bindParam(':v2', $email);
                $stmt->bindParam(':v3', $phone);
                $stmt->bindParam(':v4', $kartelaBar);
                $stmt->bindParam(':v5', $orderCount);
                $stmt->bindParam(':v6', $oDate);
                $stmt->bindParam(':v7', $oHour);
                $stmt->bindParam(':v8', $orderNumber);

                // Sorguyu çalıştır
                $stmt->execute();

                $response = "1";
                // Başarı mesajı
                echo json_encode($response);
            }
            else{
                $response = "2";
                // Zaten Kayıtlı
                echo json_encode($response);
            }
        }else{
             // SQL INSERT sorgusu
             $sql = "INSERT INTO Orders (CompanyName, Email, Phone, KartelaBar,orderCount, ODate, OHour,OrderNumber) VALUES (:v1, :v2, :v3, :v4, :v5, :v6, :v7, :v8)";
             $stmt = $conn->prepare($sql);

             // Bind parametreleri
             $stmt->bindParam(':v1', $companyName);
             $stmt->bindParam(':v2', $email);
             $stmt->bindParam(':v3', $phone);
             $stmt->bindParam(':v4', $kartelaBar);
             $stmt->bindParam(':v5', $orderCount);
             $stmt->bindParam(':v6', $oDate);
             $stmt->bindParam(':v7', $oHour);
             $stmt->bindParam(':v8', $orderNumber);

             // Sorguyu çalıştır
             $stmt->execute();

             $response = "1";
             // Başarı mesajı
             echo json_encode($response);
        }

    } catch (PDOException $e) {
        $response = "0";
        echo json_encode($response);
    }

}else{
    $response = "-1";
    echo json_encode($response);
}

// Bağlantıyı kapat
$conn = null;

?>
