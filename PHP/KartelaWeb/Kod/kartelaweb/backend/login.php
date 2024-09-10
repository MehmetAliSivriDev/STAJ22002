<?php 
    include('config.php');

    function test_input($data){ 
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(isset($_POST['username']) && isset($_POST['pass'])){

        $username = test_input($_POST['username']);
        $pass = test_input($_POST['pass']);
        $passwHash = hash('sha512', $pass);

        $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL sorgusu 
        $sql = "SELECT * FROM sade";
        $stmt = $conn->prepare($sql);
        
        // Sorguyu çalıştır
        $stmt->execute();

        // Sonuçları al
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        session_start();

        $_SESSION["result"] = "0";
        $_SESSION["message"] = "Giriş Başarısız Lütfen Tekrar Deneyin";

        foreach ($users as $user) {
            if(($user['username'] == $username) && ($user['code'] == $passwHash) && $user["isActive"] == "1"){
                $_SESSION["result"] = "1";
                $_SESSION["message"] = "Giriş Başarılı Uygulamaya Yönlendiriliyorsunuz";
                $_SESSION['username'] = $username;
                break;
            }else if (($user['username'] == $username) && ($user['code'] == $passwHash) && $user["isActive"] == "0"){
                $_SESSION["result"] = "0";
                $_SESSION["message"] = "Giriş Başarısız Bu Hesap Askıya Alınmıştır";
                break;
            }
        }

        header("Location: /kartelaweb/view/show_alert_view.php");
    }  
?>