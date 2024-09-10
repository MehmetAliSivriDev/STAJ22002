<?php

    include('config.php');

    if(isset($_POST['username']) && isset($_POST['pass']) && isset($_POST['companyPass'])){

        try {

            $username = $_POST['username'];
            $pass = $_POST['pass'];
            $companyPass = $_POST['companyPass'];

            $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // SQL sorgusu 
            $sql = "SELECT * FROM ci";
            $stmt = $conn->prepare($sql);
            
            // Sorguyu çalıştır
            $stmt->execute();

            // Sonuçları al
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = $result[0];

            $companyPassHash = hash('sha512', $companyPass);
            $passHash = hash('sha512', $pass);
            session_start();

            if($companyPassHash ==  $result['cPass']){

                // SQL sorgusu 
                $sql = "INSERT sade (username,code) VALUES (:v1,:v2)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':v1', $username);
                $stmt->bindParam(':v2', $passHash);
                
                // Sorguyu çalıştır
                $stmt->execute(); 

                $_SESSION["result"] = "1";
                $_SESSION["message"] = "Kayıt Başarılı Yeni Kullanıcı Kayıt Edildi";
                header("Location: /kartelaweb/view/show_alert_view.php");

            }else{
                $_SESSION["result"] = "0";
                $_SESSION["message"] = "Kayıt İşlemi Başarısız Firma Şifresi Yanlış Girildi";
                header("Location: /kartelaweb/view/show_alert_view.php");
            }


        } catch (PDOException $e) {
            $_SESSION["result"] = "0";
            $_SESSION["message"] = "Bir Hata Meydana Geldi";
            header("Location: /kartelaweb/view/show_alert_view.php");
        }

        
    }

?>