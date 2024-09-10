<?php 
    session_start();
    include('config.php');

    function test_input($data){ 
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(isset($_GET['salesId'])){

        $salesId = test_input($_GET['salesId']);

        $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);    
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL sorgusu 
        $sql = "SELECT Fkod FROM Satis WHERE Id = :v1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":v1",$salesId);
        
        // Sorguyu çalıştır
        $stmt->execute();

        // Sonuçları al
        $companyId = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($companyId != null){
            $companyId = $companyId[0]['Fkod'];
        }

        $_SESSION['salesId'] =  $salesId;
        $_SESSION['companyId'] = $companyId;

        header("Location: /stokweb/view/make_new_sale.php?salesId=$salesId");

    }else{
        header("Location: /stokweb/view/continue_sale_salesId.php");
    }



?>