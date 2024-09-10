<?php 
    include('config.php');
    session_start();

    function test_input($data){ 
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    if(isset($_POST["barcode"])){

        try {
            $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $barcode = test_input($_POST["barcode"]);
            $salesId = $_SESSION['salesId'];
            $quality = "1";
            $companyId = $_SESSION['companyId'];

            // SQL sorgusu 
            $sql = "SELECT * FROM StokLale WHERE Bar = :v1";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":v1",$barcode);
            
            // Sorguyu çalıştır
            $stmt->execute();

            // Sonuçları al
            $product = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if($product != null){
                $product = $product[0];
            }

            if($product['C_Tarih'] != null || $product['C_Tarih'] != ""){
                $_SESSION["result"] = "0";
                $_SESSION["message"] = "Ürün Zaten Satılmış";
                header("Location: /stokweb/view/show_alert_view.php");
            }else if($product['Active'] == null || $product['Active'] == "0"){
                $_SESSION["result"] = "0";
                $_SESSION["message"] = "Ürün Stokta Yer Almıyor";
                header("Location: /stokweb/view/show_alert_view.php");
            }else{
                // SQL sorgusu 
                $sql3 = "SELECT * FROM Firma WHERE FirmaId = :v1";
                $stmt3 = $conn->prepare($sql3);
                $stmt3->bindParam(":v1",$companyId);
                
                // Sorguyu çalıştır
                $stmt3->execute();

                // Sonuçları al
                $company = $stmt3->fetchAll(PDO::FETCH_ASSOC);

                if($company != null){
                    $company = $company[0];
                }
                
                // SQL sorgusu 
                $sql2 = "INSERT INTO SatisData (SatisId,FirmaAd,TipAdi,Varyant,Personel,Metre,Barcod,Topno,Renk,En,Desen,Kalite,SatisMet)
                VALUES (:v1,:v2,:v3,:v4,:v5,:v6,:v7,:v8,:v9,:v10,:v11,:v12,:v13)";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->bindParam(":v1",$salesId);
                $stmt2->bindParam(":v2",$company['FirmaAdi']);
                $stmt2->bindParam(":v3",$product["Tip"]);
                $stmt2->bindParam(":v4",$product["Varyant"]);
                $stmt2->bindParam(":v5",$product["DesenTur"]);
                $stmt2->bindParam(":v6",$product["Metraj"]);
                $stmt2->bindParam(":v7",$barcode);
                $stmt2->bindParam(":v8",$product['Id']);
                $stmt2->bindParam(":v9",$product["Renk"]);
                $stmt2->bindParam(":v10",$product["En"]);
                $stmt2->bindParam(":v11",$product["Desen"]);
                $stmt2->bindParam(":v12",$quality);
                $stmt2->bindParam(":v13",$product["Metraj"]);

                // Sorguyu çalıştır
                $stmt2->execute();   
                
                // SQL sorgusu 
                $sql4 = "UPDATE StokLale SET GirisKod = :v1 WHERE Bar = :v2 AND Id = :v3";
                $stmt4 = $conn->prepare($sql4);
                $stmt4->bindParam(":v1",$salesId);
                $stmt4->bindParam(":v2",$product['Bar']);
                $stmt4->bindParam(":v3",$product['Id']);
                // Sorguyu çalıştır
                $stmt4->execute();

        
                $_SESSION["result"] = "1";
                $_SESSION["message"] = "Ürün Başarıyla Eklendi";
                header("Location: /stokweb/view/show_alert_view.php");
            }


            

        } catch (PDOException $e) {
            $_SESSION["result"] = "0";
            $_SESSION["message"] = "Bir Hata Meydana Geldi".$e->getMessage();
            header("Location: /stokweb/view/show_alert_view.php");
        }

    }else{
        $_SESSION["result"] = "0";
        $_SESSION["message"] = "Form İletilirken Bir Hata Meydana Geldi";
        header("Location: /stokweb/view/show_alert_view.php");
    }


?>