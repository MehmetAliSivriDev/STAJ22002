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


    if(isset($_POST["filter"])){
        $filter = test_input($_POST["filter"]);

        if($filter == "none"){
            // // SQL sorgusu 
            // $sql = "SELECT * FROM KartelaData";
            // $stmt = $conn->prepare($sql);
            
            // // Sorguyu çalıştır
            // $stmt->execute();

            // // Sonuçları al
            // $kartelaData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // $_SESSION["KartelaData"] = $kartelaData;
            $_SESSION["isFiltered"] = false;
            // $_SESSION["filteredData"] = $_SESSION["KartelaData"];
            header("Location: /kartelaweb/view/data_display.php");
        }else if ($filter == "patternCode"){

            if(isset($_POST["patternCode"])){
                $patternCode = $_POST["patternCode"];
            }
            else{
                $patternCode = "";
            }

            // SQL sorgusu
            $sql = "SELECT * FROM KartelaData WHERE DesenKod = :v1";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":v1", $patternCode);

            // Sorguyu çalıştır
            $stmt->execute();

            // Sonuçları al
            $kartelaData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $_SESSION["KartelaData"] = $kartelaData;
            $_SESSION["isFiltered"] = true;
            $_SESSION["filteredData"] = $_SESSION["KartelaData"];
            header("Location: /kartelaweb/view/data_display.php");
        }else if ($filter == "type"){
            if(isset($_POST["patternCode"]) && isset($_POST["type"])){
                $patternCode = $_POST["patternCode"];
                $type = $_POST["type"];
            }
            else{
                $patternCode = "";
                $type = "";
            }

            // SQL sorgusu
            $sql = "SELECT * FROM KartelaData WHERE DesenKod = :v1 AND Tip = :v2";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":v1", $patternCode);
            $stmt->bindParam(":v2", $type);

            // Sorguyu çalıştır
            $stmt->execute();

            // Sonuçları al
            $kartelaData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $_SESSION["KartelaData"] = $kartelaData;
            $_SESSION["isFiltered"] = true;
            $_SESSION["filteredData"] = $_SESSION["KartelaData"];
            header("Location: /kartelaweb/view/data_display.php");
        }else if ($filter == "pattern"){
            if(isset($_POST["patternCode"]) && isset($_POST["type"]) && isset($_POST["pattern"])){
                $patternCode = $_POST["patternCode"];
                $type = $_POST["type"];
                $pattern = $_POST["pattern"];
            }
            else{
                $patternCode = "";
                $type = "";
                $pattern = "";
            }

            // SQL sorgusu
            $sql = "SELECT * FROM KartelaData WHERE DesenKod = :v1 AND Tip = :v2 AND Desen = :v3";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":v1", $patternCode);
            $stmt->bindParam(":v2", $type);
            $stmt->bindParam(":v3", $pattern);

            // Sorguyu çalıştır
            $stmt->execute();

            // Sonuçları al
            $kartelaData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $_SESSION["KartelaData"] = $kartelaData;
            $_SESSION["isFiltered"] = true;
            $_SESSION["filteredData"] = $_SESSION["KartelaData"];
            header("Location: /kartelaweb/view/data_display.php"); 
        }else if ($filter == "variant"){
            if(isset($_POST["patternCode"]) && isset($_POST["type"] ) && isset($_POST["pattern"])
            && isset($_POST["variant"])
            ){
                $patternCode = $_POST["patternCode"];
                $type = $_POST["type"];
                $pattern = $_POST["pattern"];
                $variant = $_POST["variant"];
            }
            else{
                $patternCode = "";
                $type = "";
                $pattern = "";
                $variant = "";
            }

            // SQL sorgusu
            $sql = "SELECT * FROM KartelaData WHERE DesenKod = :v1 AND Tip = :v2 AND Desen = :v3 AND Varyant = :v4";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":v1", $patternCode);
            $stmt->bindParam(":v2", $type);
            $stmt->bindParam(":v3", $pattern);
            $stmt->bindParam(":v4", $variant);

            // Sorguyu çalıştır
            $stmt->execute();

            // Sonuçları al
            $kartelaData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $_SESSION["KartelaData"] = $kartelaData;
            $_SESSION["isFiltered"] = true;
            $_SESSION["filteredData"] = $_SESSION["KartelaData"];
            header("Location: /kartelaweb/view/data_display.php"); 
        }else if ($filter == "color"){
            if(isset($_POST["patternCode"]) && isset($_POST["type"] ) && isset($_POST["pattern"])
            && isset($_POST["variant"]) && isset($_POST["color"])
            ){
                $patternCode = $_POST["patternCode"];
                $type = $_POST["type"];
                $pattern = $_POST["pattern"];
                $variant = $_POST["variant"];
                $color = $_POST["color"];
            }
            else{
                $patternCode = "";
                $type = "";
                $pattern = "";
                $variant = "";
                $color = "";
            }

            // SQL sorgusu
            $sql = "SELECT * FROM KartelaData WHERE DesenKod = :v1 AND Tip = :v2 AND Desen = :v3 AND Varyant = :v4 AND Renk = :v5";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":v1", $patternCode);
            $stmt->bindParam(":v2", $type);
            $stmt->bindParam(":v3", $pattern);
            $stmt->bindParam(":v4", $variant);
            $stmt->bindParam(":v5", $color);

            // Sorguyu çalıştır
            $stmt->execute();

            // Sonuçları al
            $kartelaData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $_SESSION["KartelaData"] = $kartelaData;
            $_SESSION["isFiltered"] = true;
            $_SESSION["filteredData"] = $_SESSION["KartelaData"];
            header("Location: /kartelaweb/view/data_display.php"); 
        }
    }

    $conn = null;

?>