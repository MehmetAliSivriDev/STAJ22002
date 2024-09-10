<?php
    session_start();
    include('../backend/config.php');
    
    $_SESSION['PAGE'] = "MAKE_NEW_SALE_COMPANY";

    $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT FirmaId,FirmaAdi FROM Firma ORDER BY FirmaId DESC";
    $stmt = $conn->prepare($sql);
    
    $stmt->execute();

    $companies = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firma Seçimi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>  

    <div class="row mb-3 mx-4 fixed-bottom">
        <a type="button" href="/stokweb/view/add_new_company_view.php" class="btn btn-success mb-3 p-2 text-white" >Yeni Firma Ekle <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
        </svg></a> 

        <a type="button" href="/stokweb/view/sales_home.php" class="btn btn-warning mb-3 p-2 text-white" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 18 18">
        <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
        </svg> Geri dön</a> 
    </div>

    <div class="container-fluid text-center"> 
        <h4 class="text-secondary my-5">Firmalar</h4>
        <div class="card shadow p-3 m-3">
            <div class="card-body">
                <form action="/stokweb/backend/create_sale.php" method="GET">
                    <?php 
                        foreach ($companies as $company) {?>
                            <button type="submit" class="btn btn-outline-secondary m-2 p-2 container-lg" name="companyId" value="<?php echo $company['FirmaId']?>">
                            <h4><?php echo $company['FirmaAdi']?></h4></button><br>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid text-white my-5">.</div>
               
    
    


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>