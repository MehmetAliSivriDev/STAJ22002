<?php
    session_start();
    $_SESSION["PAGE"] = "ORDER_INQUIRY";      
    $user = $_SESSION['username'];

    if($user == null || trim($user) == ""){
        header("Location: /kartelaweb/view/login_view.php");
    }      
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipariş Sorgulama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .btn-custom {
            width: 100%;
            float:left;
        }
    </style>

</head>
<body>

    <?php include('../include/navbar.php'); ?>

    <div class='container-fluid text-white my-2 '>.</div>
    <h4 class="text-secondary m-5 p-1">Sipariş Sorgulama</h4>
    <div class="card shadow m-5 p-1">
        <form action="/kartelaweb/view/order_info_view.php" method="get">
            <div class="card-body">
                <div class="row mt-2 mx-5 mb-5">
                    <h6 class="text-secondary">Sipariş Numarası</h6>
                    <input type="number" class="form-control" id="orderNumber" name="orderNumber" placeholder="Sipariş Numarası" required> 
                </div>
                <div class="row mt-2 mx-5 mb-5">
                    <h6 class="text-secondary">Siparişi Veren Firmanın Maili</h6>
                    <input type="email" class="form-control" id="orderMail" name="orderMail" placeholder="Mail" required> 
                </div>
            </div>
            <div class="row mx-4 mb-3">
            <div class="col-12 col-md-6">
                <a type="button" href="/kartelaweb/index.php" class="btn btn-warning m-1 mb-3 p-2 btn-custom text-white" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 18 18">
                <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                </svg> Geri dön</a>
            </div>
            <div class="col-12 col-md-6">  
                <button type="submit" class="btn btn-success btn-custom m-1 mb-1 p-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Siparişi Sorgula <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
                </button>  
            </div>
            </div>
        </form>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>