<?php
    session_start();
    include('../backend/config.php');
    
    $_SESSION['PAGE'] = "SHOW_SALE_SALESID";

    $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT Id,FirmaAdi FROM Satis ORDER BY Id DESC";
    $stmt = $conn->prepare($sql);
    
    $stmt->execute();

    $sales = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Satış Seçimi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>  

    <div class="row mb-3 mx-4 fixed-bottom">
        <a type="button" href="/stokweb/view/sales_home.php" class="btn btn-warning mb-3 p-2 text-white" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 18 18">
        <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
        </svg> Geri dön</a> 
    </div>

    <div class="container-fluid text-center"> 
        <h4 class="text-secondary my-5">Satışlar</h4>
        <div class="card shadow p-3 m-3">
            <div class="card-body">
                <form action="/stokweb/view/show_sale.php" method="GET">
                    <?php 
                        foreach ($sales as $sale) {?>
                            <button type="submit" class="btn btn-outline-secondary m-2 p-2 container-lg" name="salesId" value="<?php echo $sale['Id']?>">
                            <h3>Satış No: <?php echo $sale['Id']?></h3> <h5><?php echo $sale['FirmaAdi']?></h5></button><br>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid text-white my-5">.</div>
               
    
    


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>