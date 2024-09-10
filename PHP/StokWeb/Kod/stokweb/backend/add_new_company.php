<?php 
    include('config.php');
    session_start();

    function test_input($data){ 
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(isset($_POST['companyName'])){

        try {

            $companyName = test_input($_POST['companyName']);
            $adress =  !isset($_POST['adress']) ? "" :  test_input($_POST['adress']);
            $phone = !isset($_POST['phone']) ? "" : test_input($_POST['phone']);
            $country = !isset($_POST['country']) ? "" : test_input($_POST['country']);
            $date = date('Y-m-d');

            $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // SQL sorgusu 
            $sql = "INSERT INTO Firma (FirmaAdi,Adres,Tarih,Ulke,Tel)
            VALUES (:v1,:v2,:v3,:v4,:v5)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":v1",$companyName);
            $stmt->bindParam(":v2",$adress);
            $stmt->bindParam(":v3",$date);
            $stmt->bindParam(":v4",$country);
            $stmt->bindParam(":v5",$phone);


            // Sorguyu çalıştır
            $stmt->execute();
            
    
            $_SESSION["result"] = "1";
            $_SESSION["message"] = "Firma Başarı ile Eklendi";
            header("Location: /stokweb/view/show_alert_view.php");

            $_SESSION['cart'] = array();
    
        } catch (PDOException $e) {
            $_SESSION["result"] = "0";
            $_SESSION["message"] = "Bir Hata Meydana Geldi";
            header("Location: /stokweb/view/show_alert_view.php");
        }

    }
    else{
        $_SESSION["result"] = "0";
        $_SESSION["message"] = "Form Gönderilirken Bir Hata Meydana Geldi";
        header("Location: /stokweb/view/show_alert_view.php");
    }

?>