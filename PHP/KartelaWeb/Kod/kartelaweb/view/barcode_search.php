<?php 
    
    include("../backend/config.php");
    session_start();

    function test_input($data){ 
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $user = $_SESSION['username'];

    if($user == null || trim($user) == ""){
        header("Location: /kartelaweb/view/login_view.php");
    }

    if(isset($_GET["arananBarkod"])){

        $barkod = test_input($_GET["arananBarkod"]);
        $barkod = str_pad($barkod, 8, "0", 0);


        $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL sorgusu 
        $sql = "SELECT * FROM KartelaData WHERE Bar = :v1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':v1', $barkod);
        
        // Sorguyu çalıştır
        $stmt->execute();

        // Sonuçları al
        $arananBarkod = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $_SESSION["KartelaData"] = $arananBarkod;
        $_SESSION["PAGE"] = "BARCODE_SEARCH";

        // Bağlantıyı kapat
        $conn = null;

    }  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Aranan Barkod</title>
</head>
<body>
    <?php include("../include/navbar.php") ?>
    <?php
        if(count($arananBarkod) == 0){?> 
        <div class="container-fluid my-5 text-white">.</div>
            <div class="card shadow m-5">
                <div class="card-body">
                 <?php echo "<span style='font-weight:bold;'>$barkod</span> barkod numarasına sahip bir ürün bulunmamaktadır." ?> 
                    
                </div>
            
            </div>

    <?php }?> 
    <div class="container-fluid my-3 text-white">.</div>
    <?php include("../include/kartela_data_card.php") ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>