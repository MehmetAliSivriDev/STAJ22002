<?php 
    include('config.php');
    session_start();
    $cart = $_SESSION['cart'];

    function test_input($data){ 
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if($_SESSION['cart'] == null || !isset($_SESSION['cart']) || $_SESSION['cart'] == []){
        $_SESSION["result"] = "0";
        $_SESSION["message"] = "Sepet Boş Durumda";
        header("Location: /stokweb/view/show_alert_view.php");
    }else{
        try {
            $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // SQL sorgusu 
            $sql2 = "SELECT TOP(1) SatisId FROM SatisData ORDER BY SatisId DESC";
            $stmt2 = $conn->prepare($sql2);
            
            // Sorguyu çalıştır
            $stmt2->execute();
    
            // Sonuçları al
            $salesId = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    
            if($salesId != null){
                $salesId = $salesId[0]["SatisId"];
            }
    
            if($salesId == null || $salesId == ""){
                $salesId = "1";
            }else{
                $salesId = strval((int)$salesId + 1);
            }
    
            foreach ($cart as $data) {
                // SQL sorgusu 
                $sql = "SELECT * FROM StokLale WHERE Bar = :v1";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":v1",$data['barcode']);
                
                // Sorguyu çalıştır
                $stmt->execute();
    
                // Sonuçları al
                $product = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                if($product != null){
                    $product = $product[0];
                }
    
    
                // SQL sorgusu 
                $sql3 = "INSERT INTO SatisData (SatisId,FirmaAd,TipAdi,Varyant,Personel,Metre,Barcod,Topno,Renk,En,Desen,Fiyat,SatisMet)
                VALUES (:v1,:v2,:v3,:v4,:v5,:v6,:v7,:v8,:v9,:v10,:v11,:v12,:v13)";
                $stmt3 = $conn->prepare($sql3);
                $stmt3->bindParam(":v1",$salesId);
                $stmt3->bindParam(":v2",$data['companyName']);
                $stmt3->bindParam(":v3",$product["Tip"]);
                $stmt3->bindParam(":v4",$product["Varyant"]);
                $stmt3->bindParam(":v5",$product["DesenTur"]);
                $stmt3->bindParam(":v6",$product["Metraj"]);
                $stmt3->bindParam(":v7",$data['barcode']);
                $stmt3->bindParam(":v8",$data['topNo']);
                $stmt3->bindParam(":v9",$product["Renk"]);
                $stmt3->bindParam(":v10",$product["En"]);
                $stmt3->bindParam(":v11",$product["Desen"]);
                $stmt3->bindParam(":v12",$data['price']);
                $stmt3->bindParam(":v13",$data['salesM']);
    
                // Sorguyu çalıştır
                $stmt3->execute();
            }
    
            $_SESSION["result"] = "1";
            $_SESSION["message"] = "Sepet Başarıyla Oluşturuldu";
            header("Location: /stokweb/view/show_alert_view.php");

            $_SESSION['cart'] = array();
    
        } catch (PDOException $e) {
            $_SESSION["result"] = "0";
            $_SESSION["message"] = "Bir Hata Meydana Geldi";
            header("Location: /stokweb/view/show_alert_view.php");
        }
    }


?>