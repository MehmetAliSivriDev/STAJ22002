<?php
    session_start();
    include('../backend/config.php');
    
    $_SESSION['PAGE'] = "DATA_DISPLAY";

    if(isset($_GET["patternType"])){
        $_SESSION['type'] = $_GET["patternType"];
    }

    if(isset($_SESSION['type'])){
        $patternType =  $_SESSION['type'];

        $pageNumber = isset($_GET['pageNumber']) ? (int)$_GET['pageNumber'] : 1;
        $numberOfIteminPage = 10;
    
        $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $sqlTotal = "SELECT COUNT(Id) AS Total FROM StokLale WHERE DesenTur = :v1";
        $stmtTotal = $conn->prepare($sqlTotal);
        $stmtTotal->bindParam(":v1",$patternType);
        
        $stmtTotal->execute();
    
        $totalData = $stmtTotal->fetchAll(PDO::FETCH_ASSOC);
        if($totalData != null && $totalData != []){
            $totalData = (int)$totalData[0]['Total'];
        }else{
            $totalData = 0;
        }
    
        $offset = ($pageNumber - 1) * $numberOfIteminPage;
    
        $sql = "SELECT * FROM StokLale WHERE DesenTur = :v1 ORDER BY Id OFFSET :offset ROWS FETCH NEXT :perPage ROWS ONLY";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':perPage', $numberOfIteminPage, PDO::PARAM_INT);
        $stmt->bindParam(":v1",$patternType);
        $stmt->execute();
    
        $kartelaData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $totalPages = ceil($totalData / $numberOfIteminPage);
        $first = 1;
        $last = 7;

        if($totalPages > 7){

            if($pageNumber > 3 && $pageNumber < ($totalPages - 3)){
                $first = $pageNumber - 3;
                $last = $pageNumber + 3;
            }else if ($pageNumber <= 3){
                $first = 1;
                $last = 7;
            }
            else{
                $first = $totalPages - 6;
                $last = $totalPages;
            }
            
        }else{
            $last = $totalPages;
        }

    }else{
        header("Location: /stokweb/view/data_display_type.php");
    }
    
    $conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veri Görüntüleme</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .btn-custom {
            width: 98%;
            float:left;
        }


        .pagination {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }

        .page-item {
            margin: 2px;
        }


        @media (min-width: 300px) {
            .pagination {
                flex-direction: row;
            }
        }

        @media (max-width: 299px) {
            .pagination {
                flex-direction: column; 
                align-items: center; 
            }
        }
    </style>

</head>
<body>  

    <div class="container-fluid my-5 text-white">.</div>

    <div class="row mb-3 mx-4 fixed-bottom">
        <a type="button" href="/stokweb/view/data_display_type.php" class="btn btn-warning mb-3 p-2 text-white" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 18 18">
        <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
        </svg> Geri dön</a> 
    </div>
    
    <div class="alert alert-danger fs-6 fixed-top" role="alert">
    <?php echo "Stokta <b>".$totalData."</b> Adet <b>".$patternType."</b> Türünden Ürün Bulunmaktadır."; ?>
    </div>

    <div class="alert alert-primary mt-4 mb-3 mx-5 fs-6" role="alert">
    <?php echo count($kartelaData)." Adet Veri Görüntülenmektedir"; ?>
    </div>
               
    <div class="d-flex flex-column align-items-center mb-5">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item <?php if($pageNumber <= 1){ echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if($pageNumber > 1){ echo "?pageNumber=".($pageNumber - 1); } ?>">Önceki</a>
                </li>
                <?php for($i = $first; $i <= $last; $i++): ?>
                    <li class="page-item <?php if($pageNumber == $i) { echo "active";}?>">
                        <a class="page-link" href="?pageNumber=<?= $i;?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>  
                <li class="page-item <?php if($pageNumber >= $totalPages){ echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if($pageNumber < $totalPages) {echo "?pageNumber=".($pageNumber + 1); } ?>">Sonraki</a>
                </li>   
            </ul>
        </nav>
    </div>

    <?php foreach ($kartelaData as $data) { ?>
        
        <div class="card shadow p-1 mx-5 mb-4 mt-1">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><span style="font-weight: bold;">Barkod :</span>  <?php echo $data["Bar"] ?></li>
                <li class="list-group-item"><span style="font-weight: bold;">Tip :</span> <?php echo $data["Tip"] ?></li>
                <li class="list-group-item"><span style="font-weight: bold;">Desen :</span> <?php echo $data["Desen"] ?></li>
                <li class="list-group-item"><span style="font-weight: bold;">Varyant :</span> <?php echo $data["Varyant"] ?></li>
                <li class="list-group-item"><span style="font-weight: bold;">Renk :</span> <?php echo $data["Renk"] ?></li>
                <li class="list-group-item"><span style="font-weight: bold;">En :</span> <?php echo $data["En"] ?></li>
                <li class="list-group-item"><span style="font-weight: bold;">Metraj :</span> <?php echo $data["Metraj"] ?></li>
            </ul>
        </div>
    <?php } ?>

    <div class="container-fluid my-5 text-white">.</div>
    


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>