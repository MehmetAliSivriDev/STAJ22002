<?php
    session_start();
    $_SESSION["PAGE"] = "DATA_DISPLAY_TYPE";

?>
<?php
    include('../backend/config.php');

    $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL sorgusu 
    $sql = "SELECT DISTINCT DesenTur, COUNT(DesenTur) AS Miktar FROM StokLale GROUP BY DesenTur";
    $stmt = $conn->prepare($sql);
    
    // Sorguyu çalıştır
    $stmt->execute();

    // Sonuçları al
    $patternTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Bağlantıyı kapat
    $conn = null;
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartela Türü</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <div class="container-fluid text-center"> 
        <h4 class="text-secondary my-5">Tür</h4>
        <div class="card shadow p-5 m-5">
            <div class="card-body">
                <form action="data_display.php" method="GET">
                    <?php 
                        foreach ($patternTypes as $type) {?>
                            <button type="submit" class="btn btn-outline-secondary m-2 p-2 container-lg" name="patternType" value="<?php echo $type["DesenTur"]?>">
                            <h4><?php echo $type["DesenTur"]?></h4> <h6><?php echo $type["Miktar"]?> Adet</h6></button><br>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>

    <div class="row mb-3 mx-5 fixed-bottom">
        <a type="button" href="/stokweb/index.php" class="btn btn-warning mb-3 p-2 text-white" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 18 18">
        <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
        </svg> Geri dön</a> 
    </div>
            
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
