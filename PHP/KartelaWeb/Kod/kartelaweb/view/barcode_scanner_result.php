
<?php
    include('../backend/config.php');
    session_start();

    function test_input($data){ 
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $_SESSION["PAGE"] = "BARCODE_SCANNER_RESULT";

    $user = $_SESSION['username'];

    if($user == null || trim($user) == ""){
        header("Location: /kartelaweb/view/login_view.php");
    }


    if(isset($_GET["result"])){

        $barcode = test_input($_GET["result"]);
        $barcode = str_pad($barcode, 8, "0", 0);
    
        $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // SQL sorgusu 
        $sql = "SELECT * FROM KartelaData WHERE Bar = :v1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":v1",$barcode);
        
        // Sorguyu çalıştır
        $stmt->execute();
    
        // Sonuçları al
        $kartelaData = $stmt->fetchAll(PDO::FETCH_ASSOC);    
    
    }

    // Bağlantıyı kapat
    $conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taratma Sonuç</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <?php include('../include/navbar.php'); ?>
    <div class='container-fluid text-white my-5'>.</div>
<div class="mx-2">
    <?php 
    echo "<div class='container-fluid text-white m-2 '>.</div>";
    
    if($kartelaData == null || count($kartelaData) == 0 ){ ?>

        <div class="card shadow m-5">
            <div class="card-body">
                <?php echo "<span style='font-weight:bold;'>$barcode</span> barkod numarasına sahip bir ürün bulunmamaktadır." ?>    
            </div>
        </div>
    <?php }else{
        foreach ($kartelaData as $data) { ?>
            <div class="card shadow p-1 mx-2 mb-4 mt-1">
                <div class="card-body">
                    <img style="float:left;width: 128px; height: 128px; object-fit: cover;" 
                    onerror="this.onerror=null; this.src='/kartelaweb/resim/resimyok.jpg';" 
                    src="/kartelaweb/resim/<?php echo $data["Bar"].".jpg"?>" class="card-img-top me-1">
                    
                    <h5 class="card-title p-5"><?php echo $data["Bar"] ?></h5>
                    <form action="/kartelaweb/view/order.php" method="post">
                        <input type="hidden" name="image" value="<?php echo "/kartelaweb/resim/$data[Bar].jpg"?>"; ?>
                        <input type="hidden" name="Bar" value="<?php echo $data["Bar"] ?>">
                        <input type="hidden" name="Varyant" value="<?php echo $data["Varyant"] ?>">
                        <input type="hidden" name="Desen" value="<?php echo $data["Desen"] ?>">
                        <input type="hidden" name="Com" value="<?php echo $data["Com"] ?>">
                        <input type="hidden" name="DesenKod" value="<?php echo $data["DesenKod"] ?>">
                        <input type="hidden" name="Kg" value="<?php echo $data["Kg"] ?>">
                        <input type="hidden" name="En" value="<?php echo $data["En"] ?>">
                        <input type="hidden" name="Renk" value="<?php echo $data["Renk"] ?>">
                        <input type="hidden" name="Tip" value="<?php echo $data["Tip"] ?>">
                        <input type="hidden" name="KEn" value="<?php echo $data["KEn"] ?>">
                        <button type="submit" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#exampleModal"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 20 20">
                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z"/>
                            </svg> Sipariş Et
                        </button>
                    </form>
                    
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><span style="font-weight: bold;">Desen Kod :</span> <?php echo $data["DesenKod"] ?></li>
                    <li class="list-group-item"><span style="font-weight: bold;">Tip :</span> <?php echo $data["Tip"] ?></li>
                    <li class="list-group-item"><span style="font-weight: bold;">Desen :</span> <?php echo $data["Desen"] ?></li>
                    <li class="list-group-item"><span style="font-weight: bold;">Varyant :</span> <?php echo $data["Varyant"] ?></li>
                    <li class="list-group-item"><span style="font-weight: bold;">Renk :</span> <?php echo $data["Renk"] ?></li>
                    <li class="list-group-item"><span style="font-weight: bold;">Com :</span> <?php echo $data["Com"] ?></li>  
                    <li class="list-group-item"><span style="font-weight: bold;">Kg :</span> <?php echo $data["Kg"] ?></li>
                    <li class="list-group-item"><span style="font-weight: bold;">En :</span> <?php echo $data["En"] ?></li>
                    <li class="list-group-item"><span style="font-weight: bold;">KEn :</span> <?php echo $data["KEn"] ?></li>
                </ul>
            </div>
        <?php }}?>

        <div class="row my-5 mx-2">
            <a type="button" href="/kartelaweb/view/barcode_scanner.php" class="btn btn-warning mb-3 p-2 text-white" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 18 18">
            <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
            </svg> Geri dön</a> 
        </div>
</div>         
                
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
