<?php
    session_start();
    $_SESSION["PAGE"] = "AO_FILTER_DATE";
    $user = $_SESSION['username'];

    if($user == null || trim($user) == ""){
        header("Location: /kartelaweb/view/login_view.php");
    }

    function test_input($data){ 
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<?php



    include('../backend/config.php');

    $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_GET["company"])){
        
        $company = test_input($_GET["company"]);

        // SQL sorgusu 
        $sql = "SELECT DISTINCT ODate FROM Orders WHERE CompanyName = :v1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":v1",$company);
        
        // Sorguyu çalıştır
        $stmt->execute();

        // Sonuçları al
        $dates = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    $conn = null;
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipariş Filtreleme(Tarih)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .btn-custom {
            width: 100%;
            float:left;
        }
    </style>

</head>
<body>

    <?php include("../include/navbar.php") ?>
    <div class="container-fluid my-5 text-white">.</div>
    <div class="container-fluid text-center">  
          
        <div class="row">
            <div class="col-12 col-md-6">
                <a type="button" href="/kartelaweb/view/ao_filter_company.php" class="btn btn-warning m-1 mb-1 p-2 btn-custom text-white" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 18 18">
                <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                </svg> Geri dön</a>
            </div>
            <div class="col-12 col-md-6">  
                <form action="/kartelaweb/backend/filter_orders.php" method="POST">
                    <input type="hidden" name="aoFilter" value="company">
                    <input type="hidden" name="company" value="<?php echo $company?>">
                    <button type="submit" class="btn btn-primary m-1 mb-3 p-2 btn-custom" >Filtrelemeyi Bitir <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 18 18">
                    <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"/>
                    </svg></button>
                </form> 
            </div>
        </div>
            
        <h6 class="text-secondary">Tarih</h6>

        <form action="/kartelaweb/backend/filter_orders.php" method="POST">
            <input type="hidden" name="aoFilter" value="date">
            <input type="hidden" name="company" value="<?php echo $company?>">
            <?php 
                foreach ($dates as $date) {?>
                    <button type="submit" class="btn btn-outline-secondary m-1 p-2 container-lg" name="date" value="<?php echo $date["ODate"]?>">
                    <?php echo $date["ODate"]?></button><br>
            <?php } ?>
        </form>

    </div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
