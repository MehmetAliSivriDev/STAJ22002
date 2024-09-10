<?php
session_start();
?>

<?php

    function test_input($data){ 
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    include('../backend/config.php');

    $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    if(isset($_POST["aoFilter"])){
        $filter = test_input($_POST["aoFilter"]);

        if($filter == "none"){
            // SQL sorgusu 
            $sql = "SELECT * FROM Orders";
            $stmt = $conn->prepare($sql);
            
            // Sorguyu çalıştır
            $stmt->execute();

            // Sonuçları al
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $_SESSION["orders"] = $orders;
            $_SESSION["isFilteredOrders"] = false;
            header("Location: /kartelaweb/view/all_orders.php");
        }else if ($filter == "company"){

            if(isset($_POST["company"])){
                $company = test_input($_POST["company"]);
            }
            else{
                $company = "";
            }

            // SQL sorgusu
            $sql = "SELECT * FROM Orders WHERE CompanyName = :v1";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":v1", $company);

            // Sorguyu çalıştır
            $stmt->execute();

            // Sonuçları al
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $_SESSION["orders"] = $orders;
            $_SESSION["isFilteredOrders"] = true;
            header("Location: /kartelaweb/view/all_orders.php");
        }else if ($filter == "date"){
            if(isset($_POST["company"]) && isset($_POST["date"])){
                $company = test_input($_POST["company"]);
                $date = test_input($_POST["date"]);
            }
            else{
                $company = "";
                $date = "";
            }

            // SQL sorgusu
            $sql = "SELECT * FROM Orders WHERE CompanyName = :v1 AND ODate = :v2";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":v1", $company);
            $stmt->bindParam(":v2", $date);

            // Sorguyu çalıştır
            $stmt->execute();

            // Sonuçları al
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $_SESSION["orders"] = $orders;
            $_SESSION["isFilteredOrders"] = true;
            header("Location: /kartelaweb/view/all_orders.php");
        }else if ($filter == "justDate"){
            if(isset($_POST["date"])){
                $date = test_input($_POST["date"]);
            }
            else{
                $date = "";
            }

            // SQL sorgusu
            $sql = "SELECT * FROM Orders WHERE ODate = :v1";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":v1", $date);

            // Sorguyu çalıştır
            $stmt->execute();

            // Sonuçları al
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $_SESSION["orders"] = $orders;
            $_SESSION["isFilteredOrders"] = true;
            header("Location: /kartelaweb/view/all_orders.php");
        }
    }

    $conn = null;

?>