
<?php
    include('../backend/config.php');
    function test_input($data){ 
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    session_start();
    $_SESSION['PAGE'] = "STOCK_ENTER_BARCODE";

    if(isset($_GET["result"])){

        $barcode = test_input($_GET["result"]);
    
        $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // SQL sorgusu 
        $sql = "SELECT * FROM StokLale_24 WHERE Bar = :v1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":v1",$barcode);
        
        // Sorguyu çalıştır
        $stmt->execute();
    
        // Sonuçları al
        $stokData = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        if($stokData != null){
            $stokData = $stokData[0];
        }
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


<div class="mx-2">
    <?php 
    echo "<div class='container-fluid text-white m-2 '>.</div>";

    if($stokData == null || $stokData == ""){ ?>

        <div class="card shadow m-5">
            <div class="card-body">
                <?php echo "<span style='font-weight:bold;'>$barcode</span> barkod numarasına ait bir ürün bulunamadı" ?>    
            </div>
        </div>   
    <?php }   
    else {
        if($stokData['C_Tarih'] != null  || $stokData['C_Tarih'] != ""){ ?>


            <div class='alert alert-warning' role='alert'>
                <?php echo "<h3><span style='font-weight:bold;'>$barcode</span> barkod numarasına ait ürün satılmıştır</h3>" ?>
            </div>

        <?php } else if ($stokData['Active'] == "0"){ ?>
            
            <div class='alert alert-warning' role='alert'>
                <?php echo "<h3><span style='font-weight:bold;'>$barcode</span> barkod numarasına ait ürün zaten aktarılmış</h3>" ?> 
            </div>
        
        <?php }else if($stokData['C_Tarih'] == null && $stokData['Active'] == "1"){
        ?>
                <div class="card shadow p-1 mx-2 mb-4 mt-1">
                    <div class="card-body">  
                        <h5 class="card-title p-5">Barkod : <?php echo $stokData["Bar"] ?></h5>                            
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><span style="font-weight: bold;">Desen Kod :</span> <?php echo $stokData["DesenTur"] ?></li>
                        <li class="list-group-item"><span style="font-weight: bold;">Tip :</span> <?php echo $stokData["Tip"] ?></li>
                        <li class="list-group-item"><span style="font-weight: bold;">Desen :</span> <?php echo $stokData["Desen"] ?></li>
                        <li class="list-group-item"><span style="font-weight: bold;">Varyant :</span> <?php echo $stokData["Varyant"] ?></li>
                        <li class="list-group-item"><span style="font-weight: bold;">Renk :</span> <?php echo $stokData["Renk"] ?></li>
                        <li class="list-group-item"><span style="font-weight: bold;">En :</span> <?php echo $stokData["En"] ?></li>
                        <li class="list-group-item"><span style="font-weight: bold;">Metraj :</span> <?php echo $stokData["Metraj"] ?></li>
                    </ul>
                </div>
            <?php }?>

            <?php if($stokData['C_Tarih'] == null && $stokData['Active'] == "1") {?>
            <form action="/stokweb/backend/transfer_order.php" method="post">
                <input type="hidden" name="Bar" value="<?php echo $stokData["Bar"] ?>">
                <input type="hidden" name="Varyant" value="<?php echo $stokData["Varyant"] ?>">
                <input type="hidden" name="Desen" value="<?php echo $stokData["Desen"] ?>">
                <input type="hidden" name="DesenTur" value="<?php echo $stokData["DesenTur"] ?>">
                <input type="hidden" name="En" value="<?php echo $stokData["En"] ?>">
                <input type="hidden" name="Renk" value="<?php echo $stokData["Renk"] ?>">
                <input type="hidden" name="Tip" value="<?php echo $stokData["Tip"] ?>">
                <input type="hidden" name="Metraj" value="<?php echo $stokData["Metraj"] ?>">

                <div class="row my-3 mx-2">
                    <button type="submit" class="btn btn-success  mb-3 p-2 text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">Stok Ekle <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 18 18">
                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0"/>
                    </svg>
                    </button>
                </div>
            </form>
    <?php }} ?>
        <div class="row my-3 mx-2">
            <a type="button" href="/stokweb/view/barcode_scanner.php" class="btn btn-warning mb-3 p-2 text-white" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 18 18">
            <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
            </svg> Geri dön</a> 
        </div>
</div>         
                
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
