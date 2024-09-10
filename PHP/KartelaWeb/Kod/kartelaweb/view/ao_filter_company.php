<?php
    session_start();
    $_SESSION["PAGE"] = "AO_FILTER_COMPANY";
    $user = $_SESSION['username'];

    if($user == null || trim($user) == ""){
        header("Location: /kartelaweb/view/login_view.php");
    }

?>
<?php
    include('../backend/config.php');

    $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL sorgusu 
    $sql = "SELECT DISTINCT CompanyName, Email FROM Orders";
    $stmt = $conn->prepare($sql);
    
    // Sorguyu çalıştır
    $stmt->execute();

    // Sonuçları al
    $orderCompanies = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Bağlantıyı kapat
    $conn = null;
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipariş Filtreleme(Şirket Adı)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <?php include("../include/navbar.php") ?>
    <div class="container-fluid my-5 text-white">.</div>
    <div class="container-fluid text-center"> 

        <form action="/kartelaweb/backend/filter_orders.php" method="post">
            <input type="hidden" name="aoFilter" value="none">
            <button type="submit" class="btn btn-primary m-1 mb-3 p-2 container-lg" >Filtrelemeyi Bitir <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 18 18">
            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"/>
            </svg></button>
            <a type="button" href="/kartelaweb/view/ao_filter.php" class="btn btn-warning m-1 mb-4 p-2 container-lg text-white" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 18 18">
            <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
            </svg> Geri dön</a>
        </form>

        <h6 class="text-secondary">Şirket Adı</h6>

        <form action="ao_filter_date.php" method="GET">
            <?php 
                foreach ($orderCompanies as $company) {?>
                    <button type="submit" class="btn btn-outline-secondary m-1 container-lg" name="company" value="<?php echo $company["CompanyName"]?>">
                    <?php echo "<p>$company[CompanyName]</p>"?><?php echo "<p class='text-secondary text'><b>$company[Email]</b></p>"?></button><br>
            <?php } ?>
        </form>
        
        
    </div>
            
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
