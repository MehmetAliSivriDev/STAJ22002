<?php 
    include('../backend/config.php');

    function test_input($data){ 
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(isset($_GET["companyMail"])){

        $companyMail = test_input($_GET["companyMail"]);

        $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // SQL sorgusu 
        $sql = "SELECT DISTINCT OrderNumber FROM Orders WHERE Email = :v1 GROUP BY OrderNumber";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":v1",$companyMail);
        
        // Sorguyu çalıştır
        $stmt->execute();
    
        // Sonuçları al
        $OrderNumbers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    if(!isset($OrderNumbers) || $OrderNumbers == ""){
        header("Location: /kartelaweb/kartelamail/company_login.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şirket Siparişleri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>

    <div class="d-flex justify-content-evenly align-items-center my-5">
        <img src="/kartelaweb/assets/logo/peykan_logo_1.jpg"
        alt="logo" width="256" height="128"/>   
        <h5 class="text-secondary">PEYKAN KARTELA</h5>
    </div>
    <div class="container-fluid my-5">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="text-secondary"><?php echo $companyMail." Vermiş Olduğu Siparişler"?></h6>
            </div>
        <ul class="list-group list-group-flush">
             
         <?php if($OrderNumbers != null && $OrderNumbers != []){
                foreach ($OrderNumbers as $number) { ?>
                    <form action="/kartelaweb/kartelamail/show_orders.php" method="GET">
                        <input type="hidden" name="companyMail" value="<?php echo $companyMail?>">
                        <input type="hidden" name="orderNumber" value="<?php echo $number["OrderNumber"]?>">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <h5 class="text-info-emphasis"><?php echo $number["OrderNumber"]." Nolu Sipariş"?></h5>
                            <button type="submit" class="btn btn-primary btn-sm">Görüntüle <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 18 18">
                                <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                                </svg>
                            </button>
                        </li>
                    </form>
            <?php }}else{?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <h5 class="text-info-emphasis">Herhangi Bir Sipariş Bulunamadı</h5>
                </li>
            <?php } ?>    
            
            
        </ul>
        </div>
    </div>
    <div class="container-fluid my-5 text-white">.</div>
    <div class="row my-5 mx-2 fixed-bottom">
        <a type="button" href="/kartelaweb/kartelamail/company_login.php" class="btn btn-warning m-1 mb-3 p-2 btn-custom text-white" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 18 18">
        <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
        </svg> Geri dön</a>
    </div>             
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>