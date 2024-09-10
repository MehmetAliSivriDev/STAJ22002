<?php
    session_start();
    include('../backend/config.php');
    
    $_SESSION['PAGE'] = "CREATE_CART";

    $pageNumber = isset($_GET['pageNumber']) ? (int)$_GET['pageNumber'] : 1;
    $numberOfIteminPage = 10;

    $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sqlTotal = "SELECT * FROM StokLale";
    $stmtTotal = $conn->prepare($sqlTotal);
    
    $stmtTotal->execute();

    $totalData = $stmtTotal->fetchAll(PDO::FETCH_ASSOC);

    $offset = ($pageNumber - 1) * $numberOfIteminPage;

    $sql = "SELECT * FROM StokLale ORDER BY Id OFFSET :offset ROWS FETCH NEXT :perPage ROWS ONLY";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':perPage', $numberOfIteminPage, PDO::PARAM_INT);
    $stmt->execute();

    $kartelaData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $totalPages = ceil(count($totalData) / $numberOfIteminPage);
    
    $conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepet Oluşturma</title>
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

    <div class="row mb-3 mx-4 fixed-bottom">
        <a type="button" href="/stokweb/view/sales_home.php" class="btn btn-warning mb-3 p-2 text-white" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 18 18">
        <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
        </svg> Geri dön</a> 
        <a type="button" href="/stokweb/backend/cart_to_server.php" class="btn btn-success mb-3 p-2 text-white" >Sepeti Oluştur <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-bag-check-fill" viewBox="0 0 18 18">
        <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0m-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z"/>
        </svg></a> 
    </div>
               
    <div class="d-flex flex-column align-items-center my-4">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item <?php if($pageNumber <= 1){ echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if($pageNumber > 1){ echo "?pageNumber=".($pageNumber - 1); } ?>">Önceki</a>
                </li>
                <?php for($i = 1; $i <= $totalPages; $i++): ?>
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
    <table class="table table-hover table-striped mt-5 ">
        <tr class="table-success">
            <th>Bar</th>
            <th>Tür</th>
            <th>Tip</th>
            <th>İşlem</th>
        </tr>
        <?php 
            foreach ($kartelaData as $data) {
                echo "<tr>";
                echo "<td>$data[Bar]</td>";
                echo "<td>$data[DesenTur]</td>";
                echo "<td>$data[Tip]</td>";
                echo '<td><form action="/stokweb/view/add_cart_view.php" method="GET"><input type="hidden" name="barcode" value="'.$data["Bar"].'"><button type="submit" class="btn btn-success my-1 mx-1 text-white float-end" data-bs-toggle="modal" data-bs-target="#exampleModal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z"/>
                    </svg></button></form>
                    <form action="/stokweb/view/data_info.php" method="GET"><input type="hidden" name="barcode" value="'.$data["Bar"].'">
                    <button type="submit" class="btn btn-info my-1 mx-1 text-white float-end" data-bs-toggle="modal" data-bs-target="#exampleModal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                    </svg></button></td></form>';
                echo "</tr>";
            }
        ?>
    </table>

    <div class="container-fluid my-5 text-white">.</div>
    


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>