<?php
    session_start();
    $_SESSION["PAGE"] = "AO_FILTER";
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
    <title>Sipariş Filtreleme</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>

    <?php include("../include/navbar.php") ?>
    <div class="container-fluid my-5 text-white">.</div>
    <div class="container-fluid text-center"> 

        <h6 class="text-secondary">Filtreleme Türü</h6>

                    <a href="/kartelaweb/view/ao_filter_company.php" class="btn btn-outline-secondary m-1 container-lg">Şirket Adı <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 18 18">
                    <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                    </svg> Tarih</a>

                    <a href="/kartelaweb/view/ao_filter_just_date.php" class="btn btn-outline-secondary m-1 mb-4 container-lg">Tarih</a>

                    <a type="button" href="/kartelaweb/view/all_orders.php" class="btn btn-warning m-1 mb-1 p-2 container-lg text-white" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 18 18">
                    <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                    </svg> Geri dön</a>
        
        
    </div>
            
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
