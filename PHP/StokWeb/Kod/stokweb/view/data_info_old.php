
<?php
    include('../backend/config.php');
    function test_input($data){ 
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    session_start();
    $_SESSION['PAGE'] = "DATA_INFO";

    if(isset($_GET["barcode"])){

        $barcode = test_input($_GET["barcode"]);
    
        $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // SQL sorgusu 
        $sql = "SELECT * FROM StokLale_24 WHERE Bar = :v1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":v1",$barcode);
        
        // Sorguyu çalıştır
        $stmt->execute();
    
        // Sonuçları al
        $dataInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        if($dataInfo != null){
            $dataInfo = $dataInfo[0];
        }
    }else{
        
    }

    // Bağlantıyı kapat
    $conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Bilgisi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>


<div class="mx-2">
    <?php 
    echo "<div class='container-fluid text-white my-5 '>.</div>";

    if($dataInfo == null || $dataInfo == ""){ ?>

        <div class="card shadow m-5">
            <div class="card-body">
                <?php echo "<span style='font-weight:bold;'>$barcode</span> barkod numarasına ait bir ürün bulunamadı" ?>    
            </div>
        </div>   
    <?php } else {?>
   
        <div class="card shadow p-1 mx-2 mb-4 mt-1">
            <div class="card-body">  
                <h5 class="card-title p-5">Barkod : <?php echo $dataInfo["Bar"] ?></h5>                            
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><span style="font-weight: bold;">Desen Kod :</span> <?php echo $dataInfo["DesenTur"] ?></li>
                <li class="list-group-item"><span style="font-weight: bold;">Tip :</span> <?php echo $dataInfo["Tip"] ?></li>
                <li class="list-group-item"><span style="font-weight: bold;">Desen :</span> <?php echo $dataInfo["Desen"] ?></li>
                <li class="list-group-item"><span style="font-weight: bold;">Varyant :</span> <?php echo $dataInfo["Varyant"] ?></li>
                <li class="list-group-item"><span style="font-weight: bold;">Renk :</span> <?php echo $dataInfo["Renk"] ?></li>
                <li class="list-group-item"><span style="font-weight: bold;">En :</span> <?php echo $dataInfo["En"] ?></li>
                <li class="list-group-item"><span style="font-weight: bold;">Metraj :</span> <?php echo $dataInfo["Metraj"] ?></li>
            </ul>
        </div>

    <?php }?>

    <div class="row my-3 mx-2">
        <a type="button" href="/stokweb/view/create_cart.php" class="btn btn-warning mb-3 p-2 text-white" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 18 18">
        <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
        </svg> Geri dön</a> 
    </div>
</div>         
                
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
