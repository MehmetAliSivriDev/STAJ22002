<?php 
    include('config.php');
    session_start();
    function test_input($data){ 
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(isset($_POST['Bar']) && isset($_POST['Varyant']) && isset($_POST['Desen']) && isset($_POST['DesenTur']) 
    &&  isset($_POST['En']) && isset($_POST['Renk']) && isset($_POST['Tip']) && isset($_POST['Metraj'])
    ){

        try {
            
            $barcode = test_input($_POST['Bar']);
            $variant = test_input($_POST['Varyant']);
            $pattern = test_input($_POST['Desen']);
            $patternType = test_input($_POST['DesenTur']);
            $width = test_input($_POST['En']);
            $color = test_input($_POST['Renk']);
            $type = test_input($_POST['Tip']);
            $quantity = test_input($_POST['Metraj']);
            $opra = "SAYIM_BARKOD_GIRIS";
            $currentHour = date('H:i:s');

            $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sqlEC = "SELECT TOP(1) GirisKod FROM StokLale ORDER BY Id DESC";
            $stmt = $conn->prepare($sqlEC);
            $stmt->execute();
            $EntryCodeSQL = $stmt->fetchAll(PDO::FETCH_ASSOC);    
            $EntryCodeSQL = $EntryCodeSQL[0];

            if($EntryCodeSQL["GirisKod"] == null || $EntryCodeSQL["GirisKod"] == ""){
                $EntryCode = 1;
            }else{
                $EntryCode = strval((int)$EntryCodeSQL["GirisKod"] + 1);
            }

            // SQL sorgusu 
            $sql = "INSERT INTO StokLale (Bar, Renk, Desen, DesenTur, En, Varyant, Tip, Metraj,GirisKod,Opra, Saat) VALUES 
            (:v1,:v2,:v3,:v4,:v5,:v6,:v7,:v8,:v9,:v10, :v11)
            
            ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":v1",$barcode);
            $stmt->bindParam(":v2",$color);
            $stmt->bindParam(":v3",$pattern);
            $stmt->bindParam(":v4",$patternType);
            $stmt->bindParam(":v5",$width);
            $stmt->bindParam(":v6",$variant);
            $stmt->bindParam(":v7",$type);
            $stmt->bindParam(":v8",$quantity);
            $stmt->bindParam(":v9",$EntryCode);
            $stmt->bindParam(":v10",$opra);
            $stmt->bindParam(":v11",$currentHour);
            // Sorguyu çalıştır
            $stmt->execute();

            // SQL sorgusu 
            $sql2 = "UPDATE StokLale_24 SET Active = 0 WHERE Bar = :v1";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bindParam(":v1",$barcode);

            // Sorguyu çalıştır
            $stmt2->execute();

            $_SESSION["result"] = "1";
            $_SESSION["message"] = "Stok Başarıyla Aktarıldı";
            header("Location: /stokweb/view/show_alert_view.php");

        } catch (PDOException $e) {
            $_SESSION["result"] = "0";
            $_SESSION["message"] = "Bir Hata Meydana Geldi";
            header("Location: /stokweb/view/show_alert_view.php");
        }

    }else{
        $_SESSION["result"] = "0";
        $_SESSION["message"] = "Form Doğru İletilemedi";
        header("Location: /stokweb/view/show_alert_view.php");
    }



?>
