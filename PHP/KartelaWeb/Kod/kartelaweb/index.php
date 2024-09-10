
<?php

    include('backend/config.php');
    
    session_start();
    $user = $_SESSION['username'];
    
    if($user == null || trim($user) == ""){
        header("Location: /kartelaweb/view/login_view.php");
    }

    $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL sorgusu 
    $sql = "SELECT TOP(300) * FROM KartelaData";
    $stmt = $conn->prepare($sql);
    
    // Sorguyu çalıştır
    $stmt->execute();

    // Sonuçları al
    $kartelaData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // SQL sorgusu 
    $sql2 = "SELECT * FROM Orders";
    $stmt2 = $conn->prepare($sql2);

    // Sorguyu çalıştır
    $stmt2->execute();

    // Sonuçları al
    $orders = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    $_SESSION["KartelaData"] = $kartelaData;
    $_SESSION["orders"] = $orders;
    $_SESSION["isFiltered"] = false;
    $_SESSION["isFilteredOrders"] = false;
    $_SESSION["PAGE"] = "INDEX";

    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Bağlantıyı kapat
    $conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartela</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        /* style.css */
        body {
            margin: 0;
            padding: 0;
            background-image: url('assets/images/kartela3.jpg'); /* Arka plan resmi dosya yolu */
            background-size: cover; /* Resmi tüm ekranı kaplayacak şekilde ayarla */
            background-repeat: no-repeat; /* Resmi tekrar etme */
            background-position: center center; /* Resmi ortala */
            height: 100vh; /* Yüksekliği ekran boyutuna göre ayarla */
        }

    </style>


</head>
<body>

    <?php include('include/navbar.php'); ?>
    <div class='container-fluid text-white my-5 '>.</div>
<div class="container-md">
    <div class="card border-secondary-subtle border-2 shadow mx-2 my-5">
        <img src="/kartelaweb/assets/images/gorsel2.jpg"
        alt="logo" class="img-fluid rounded"/>  
        <div class="card-body">
        <h5 class="text-secondary mx-3 my-2 p-1"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-upc-scan" viewBox="0 0 18 18">
            <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0z"/>
            </svg>Barkod Taratma ile Ürün Bulma</h5>  
            <p class="card-text text-secondary mx-3 my-2 p-1">Ürün bilgilerine ulaşmak istediğiniz kartelanın barkodunu okutun ve anında ürün bilgilerine ulaşın!</p>
            <p class="text-danger mx-3 my-2 p-1">Kamera İzni Gerekmektedir!</p>
            <a type="button" href="/kartelaweb/view/barcode_scanner.php" class="btn btn-primary mx-3 btn-custom mt-3" >Barcode Taratma Sayfasına Git<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 18 18">
                        <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                        </svg></a>
        </div>
    </div>
    </div>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
