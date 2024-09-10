<?php
    session_start();
    include('../backend/config.php');
    
    $_SESSION['PAGE'] = "MAKE_NEW_SALE";

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

        $sumM = 0;

        foreach ($saleData as $data) {
            $sumM = $sumM + (int)$data['Metre'];
        }

        

    }else{
        header("Location: /stokweb/view/make_new_sale_company.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Satış Oluşturma</title>
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
        
        <a type="button" href="/stokweb/view/make_new_sale_barcode_scan.php" class="btn btn-primary mb-3 p-2 text-white" >Barkod Okut <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-upc-scan" viewBox="0 0 18 18">
        <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0z"/>
        </svg></a> 
        
        <a type="button" href="/stokweb/view/sales_home.php" class="btn btn-warning mb-3 p-2 text-white" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 18 18">
        <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
        </svg> Geri dön</a> 

    </div>

    <div class="alert alert-primary fs-6 fixed-top" role="alert">
        <?php if(isset($saleData) && $saleData != null && $saleData != []){echo "Firma: <b>".$saleData[0]['FirmaAd']."</b><br>"; }?>
        <?php echo "Satış Id :<b>$salesId</b><br> Ürün Sayısı: <b>".count($saleData)."</b> Top | Toplam Metre: <b>".$sumM."</b> "; ?>
    </div>

    <div class="container-fluid my-5 text-white">.</div>   

    <?php 
        if(!isset($saleData) || $saleData == null || $saleData == []){ ?>
            <div class="alert alert-warning mt-4 mb-3 mx-5 fs-6" role="alert">
                Henüz Herhangi Bir Veri Bulunmamaktadır
            </div>
    <?php } else{ ?>

        <table class="table table-hover table-striped">
            <tr class="table-success">
                <th>Barkod</th>
                <th>Desen Tür</th>
                <th>Tip</th>
                <th>Desen</th>
                <th>Varyant</th>
                <th>Metre</th>
            </tr>
            <?php 
                foreach ($saleData as $data) {
                    echo "<tr>";
                    echo "<td>$data[Barcod]</td>";
                    echo "<td>$data[Personel]</td>";
                    echo "<td>$data[TipAdi]</td>";
                    echo "<td>$data[Desen]</td>";
                    echo "<td>$data[Varyant]</td>";
                    echo "<td>$data[Metre]</td>";
                    echo "</tr>";
                }
            ?>
        </table>

    <?php } ?>

    <div class="container-fluid my-5 text-white">.</div>
    <div class="container-fluid my-5 text-white">.</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>