<?php
    session_start();
    $_SESSION["PAGE"] = "ORDERS_DISPLAY";
    $Orders = $_SESSION["cart"];
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
    <title>Siparişleri Görüntüleme</title>
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

    <?php 
    echo "<div class='container-fluid text-white my-2 '>.</div>";
    if($Orders != null){
    foreach ($Orders as $data) { ?>
        <div class="card shadow p-2 my-5 mx-3">
            <div class="card-body">
                <img style="float:left;width: 128px; height: 128px; object-fit: cover;" 
                onerror="this.onerror=null; this.src='/kartelaweb/resim/resimyok.jpg';" 
                src="<?php echo $data["Image"]?>" class="card-img-top me-1">

                <h5 class="card-title p-5">Barkod : <?php echo $data["Bar"] ?></h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><span style="font-weight: bold;">Desen Kod :</span> <?php echo $data["DesenKod"] ?></li>
                <li class="list-group-item"><span style="font-weight: bold;">Tip :</span> <?php echo $data["Tip"] ?></li>
                <li class="list-group-item"><span style="font-weight: bold;">Desen :</span> <?php echo $data["Desen"] ?></li>
                <li class="list-group-item"><span style="font-weight: bold;">Sipariş Edilen Miktar :</span> <?php echo $data["count"]." Metre" ?></li>
                <li class="list-group-item">
                    <form action="/kartelaweb/backend/remove_item_from_cart.php" method="post">
                        <input type="hidden" name="Bar" value="<?php echo $data["Bar"] ?>">
                        <button type="submit" class="btn btn-danger btn-custom m-1 mb-1 p-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Sepetten Kaldır <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 18 18">
                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                        </svg></button>           
                    </form> 
                </li>
            </ul>
        </div>
    <?php } } else {?>

    <div class="alert alert-warning my-5 mx-5 fs-6" role="alert">
        Sepette Herhangi Bir Ürün Bulunmamaktadır.
    </div>
    <?php } ?>
    <div class='container-fluid text-white my-5 '>.</div>
    <div class="row mx-2 mb-3 fixed-bottom">
            <div class="col-12 col-md-6">
                <a type="button" href="/kartelaweb/index.php" class="btn btn-warning m-1 mb-3 p-2 btn-custom text-white" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 18 18">
                <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                </svg> Geri dön</a>
            </div> 
            <?php 
            if($Orders != null){
            if(count($Orders) != 0){?>
                <div class="col-12 col-md-6">             
                        <a type="button" href="/kartelaweb/view/order_complete.php" class="btn btn-success btn-custom m-1 mb-1 p-2">Devam Et <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 18 18">
                        <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                        </svg>
                        </a>   
                </div>
            <?php }}?>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>