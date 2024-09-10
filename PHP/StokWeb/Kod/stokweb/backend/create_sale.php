<?php
    include('config.php');
    session_start();

    function test_input($data){ 
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    if(isset($_GET['companyId'])){

        $companyId = $_GET['companyId'];
        $explanation = "";
        $dateAndHour = date('Y-m-d H:i:s');

        $_SESSION['companyId'] = $_GET['companyId'];

        $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL sorgusu 
        $sql2 = "SELECT * FROM Firma WHERE FirmaId = :v1";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bindParam(":v1",$companyId);
        
        // Sorguyu çalıştır
        $stmt2->execute();

        // Sonuçları al
        $company = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        if($company != null){
            $company = $company[0];
        }

        // SQL sorgusu 
        $sql = "INSERT INTO Satis (FirmaAdi,Aciklama,SatisTarihi,Fkod) VALUES (:v2,:v3,:v4,:v5)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":v2",$company['FirmaAdi']);
        $stmt->bindParam(":v3",$explanation);
        $stmt->bindParam(":v4",$dateAndHour);
        $stmt->bindParam(":v5",$companyId);

        // Sorguyu çalıştır
        $stmt->execute();

        // SQL sorgusu 
        $sql3 = "SELECT Id FROM Satis ORDER BY Id DESC";
        $stmt3 = $conn->prepare($sql3);
        
        // Sorguyu çalıştır
        $stmt3->execute();

        // Sonuçları al
        $salesId = $stmt3->fetchAll(PDO::FETCH_ASSOC);

        if($salesId != null){
            $salesId = $salesId[0]['Id'];
        }

        $_SESSION["salesId"] = $salesId;
        
        $_SESSION["result"] = "1";
        $_SESSION["message"] = "Satış Başarıyla Oluşturuldu";
        header("Location: /stokweb/view/show_alert_view.php");

    }else{
        $_SESSION["result"] = "0";
        $_SESSION["message"] = "Bir Hata Meydana Geldi";
        header("Location: /stokweb/view/show_alert_view.php");
    }

?>