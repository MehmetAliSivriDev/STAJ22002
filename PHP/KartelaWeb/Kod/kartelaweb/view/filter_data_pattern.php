<?php
    session_start();
    $_SESSION["PAGE"] = "FILTER_DATA_PATTERN";
    $user = $_SESSION['username'];

    if($user == null || trim($user) == ""){
        header("Location: /kartelaweb/view/login_view.php");
    }

    function test_input($data){ 
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<?php

    include('../backend/config.php');

    $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_GET["patternCode"]) && isset($_GET["type"])){
        
        $patternCode = test_input($_GET["patternCode"]);
        $type = test_input($_GET["type"]);

        // SQL sorgusu 
        $sql = "SELECT DISTINCT Desen FROM KartelaData WHERE DesenKod = :v1 AND Tip = :v2";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":v1",$patternCode);
        $stmt->bindParam(":v2",$type);
        // Sorguyu çalıştır
        $stmt->execute();

        // Sonuçları al
        $patterns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    $conn = null;
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veri Filtreleme(Desen)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .btn-custom {
            width: 100%;
            float:left;
        }
    </style>

</head>
<body>

    <?php include("../include/navbar.php") ?>
    <div class="container-fluid my-5 text-white">.</div>
    <div class="container-fluid text-center">

        <div class="row">
            <div class="col-12 col-md-6">
                <a type="button" href="/kartelaweb/view/filter_data_pattern_code.php" class="btn btn-warning m-1 mb-1 p-2 btn-custom text-white" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 18 18">
                <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                </svg> Geri dön</a>
            </div>
            <div class="col-12 col-md-6">  
                <form action="/kartelaweb/backend/filter.php" method="POST">
                    <input type="hidden" name="filter" value="type">
                    <input type="hidden" name="patternCode" value="<?php echo $patternCode?>">
                    <input type="hidden" name="type" value="<?php echo $type?>">
                    <button type="submit" class="btn btn-primary m-1 mb-3 p-2 container-lg" >Filtrelemeyi Bitir <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 18 18">
                    <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"/>
                    </svg></button>
                </form> 
            </div>
        </div>

        <h6 class="text-secondary">Desen</h6>

        <form action="filter_data_variant.php" method="GET">
            <input type="hidden" name="patternCode" value="<?php echo $patternCode?>">
            <input type="hidden" name="type" value="<?php echo $type?>">
            <?php 
                foreach ($patterns as $pattern) {?>
                    <button type="submit" class="btn btn-outline-secondary m-1 p-2 container-lg" name="pattern" value="<?php echo $pattern["Desen"]?>">
                    <?php echo $pattern["Desen"]?></button><br>
            <?php } ?>
        </form>

    </div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
