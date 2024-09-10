<?php
    session_start();
    include('../backend/config.php');
    
    $_SESSION['PAGE'] = "SHOW_SALE";

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
        $sql = "SELECT * FROM SatisData WHERE SatisId = :v1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":v1",$salesId);
        
        // Sorguyu çalıştır
        $stmt->execute();

        // Sonuçları al
        $saleData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        

    }else{
        header("Location: /stokweb/view/make_new_sale_company.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Satışları Görüntüle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .btn-custom {
            width: 98%;
            float:left;
        }
    </style>

</head>
<body>  

    <div class="row mb-3 mx-4 fixed-bottom">   
        <a type="button" href="/stokweb/view/sales_home.php" class="btn btn-warning mb-3 p-2 text-white" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 18 18">
        <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
        </svg> Geri dön</a> 
    </div>
    
    <div class="container-fluid my-5 text-white">.</div>
    <div class="alert alert-primary fs-6 fixed-top" role="alert">
        <?php if(isset($saleData) && $saleData != null && $saleData != []){echo "Firma: <b>".$saleData[0]['FirmaAd']."</b><br>"; }?>
        <?php echo "Satış Id :<b>$salesId</b><br> Ürün Sayısı: <b>".count($saleData)."</b> Adet"; ?>
    </div>


    <?php 
        if(!isset($saleData) || $saleData == null || $saleData == []){ ?>
            <div class="alert alert-warning mt-4 mb-3 mx-5 fs-6" role="alert">
                Henüz Herhangi Bir Veri Bulunmamaktadır
            </div>
    <?php } else{ ?>
        <?php 
            foreach ($saleData as $data) { ?>

                <div class="card shadow p-1 mx-5 my-4">
                    <div class="card-body">  
                        <h5 class="card-title ">Firma : <?php echo $data["FirmaAd"] ?></h5> 
                        <h5 class="card-title ">Barkod : <?php echo $data["Barcod"] ?></h5>                            
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><span style="font-weight: bold;">Desen Kod :</span> <?php echo $data["Personel"] ?></li>
                        <li class="list-group-item"><span style="font-weight: bold;">Tip :</span> <?php echo $data["TipAdi"] ?></li>
                        <li class="list-group-item"><span style="font-weight: bold;">Desen :</span> <?php echo $data["Desen"] ?></li>
                        <li class="list-group-item"><span style="font-weight: bold;">Varyant :</span> <?php echo $data["Varyant"] ?></li>
                        <li class="list-group-item"><span style="font-weight: bold;">Renk :</span> <?php echo $data["Renk"] ?></li>
                        <li class="list-group-item"><span style="font-weight: bold;">En :</span> <?php echo $data["En"] ?></li>
                        <li class="list-group-item"><span style="font-weight: bold;">Metraj :</span> <?php echo $data["Metre"] ?></li>
                    </ul>
                </div>
        <?php } ?>

    <?php } ?>

    <div class="container-fluid my-5 text-white">.</div>
    <div class="container-fluid my-5 text-white">.</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>