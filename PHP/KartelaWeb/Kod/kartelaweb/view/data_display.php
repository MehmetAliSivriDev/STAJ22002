<?php
    session_start();
    include('../backend/config.php');

    $_SESSION["PAGE"] = "DATA_DISPLAY";

    $user = $_SESSION['username'];

    if($user == null || trim($user) == ""){
        header("Location: /kartelaweb/view/login_view.php");
    }

    $pageNumber = isset($_GET['pageNumber']) ? (int)$_GET['pageNumber'] : 1;
    $numberOfIteminPage = 10;

    $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if($_SESSION["isFiltered"] == true){
        $totalData = $_SESSION["filteredData"];

        $offset = ($pageNumber - 1) * $numberOfIteminPage;

        $slicedData = array_slice($totalData, $offset, $numberOfIteminPage);

        $totalPages = ceil(count($totalData) / $numberOfIteminPage);

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

        $_SESSION["KartelaData"] = $slicedData;
    }
    else{

        $sqlTotal = "SELECT COUNT(Id) AS Total FROM KartelaData";
        $stmtTotal = $conn->prepare($sqlTotal);
        
        $stmtTotal->execute();

        $totalData = $stmtTotal->fetchAll(PDO::FETCH_ASSOC);
        if($totalData != null && $totalData != []){
            $totalData = (int)$totalData[0]['Total'];
        }else{
            $totalData = 0;
        }

        $offset = ($pageNumber - 1) * $numberOfIteminPage;

        $sql = "SELECT * FROM KartelaData ORDER BY Id OFFSET :offset ROWS FETCH NEXT :perPage ROWS ONLY";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':perPage', $numberOfIteminPage, PDO::PARAM_INT);
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

        $_SESSION["KartelaData"] = $kartelaData;
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

    <?php include("../include/navbar.php") ?>
    <div class="container-fluid mb-5 text-white">.</div>
    <div class="container-fluid mb-2 text-white">.</div>
    <div class="row mx-4 mb-3 fixed-bottom">
        <div class="col-12 col-md-6">  
            <?php
                $isFiltered = $_SESSION["isFiltered"];

                if($isFiltered){?>
                    <form action="/kartelaweb/backend/filter.php" method="post">
                        <input type="hidden" name="filter" value="none">
                        <button type="submit" class="btn btn-primary m-1 mb-3 p-2 btn-custom" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
                        <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
                        </svg> Yenile</button>
                    </form> 
            <?php } ?>
        </div>
        <div class="col-12 col-md-6">
            <a href="/kartelaweb/view/filter_data_pattern_code.php" class="btn btn-secondary btn-custom m-1 mb-1 p-2" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
            <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"/></svg>
            Filtrele</a>
        </div>
    </div>
    <div class="alert alert-primary mx-5 fs-6" role="alert">
    <?php echo count($_SESSION["KartelaData"])." Adet Veri Görüntülenmektedir"; ?>
    </div>
               
    <div class="d-flex flex-column align-items-center">
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
    
    <?php include("../include/kartela_data_card.php") ?>    


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>