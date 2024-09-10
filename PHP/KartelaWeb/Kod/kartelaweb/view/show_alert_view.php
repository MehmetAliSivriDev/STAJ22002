<?php
    session_start();
    $page = $_SESSION["PAGE"];
    $result = $_SESSION["result"];
    $message = $_SESSION["message"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İşlem Sonucu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .btn-custom {
            width: 100%;
            float:left;
        }
    </style>

</head>
<body>

    <?php 
        if($result == "1"){
            echo"<div class='alert alert-success' role='alert'>
                $message
                </div>"; 
        }else{
           echo"<div class='alert alert-danger' role='alert'>
                $message
                </div>";     
        }

        if($page == "ORDER"){
            header("Refresh: 2; /kartelaweb/view/data_display_order_navigator.php");
        }else if($page == "ORDERS_DISPLAY"){
            header("Refresh: 2; /kartelaweb/view/orders_display.php");
        }else if ($page == "LOGIN" && $result == "1"){
            header("Refresh: 2; /kartelaweb/index.php");
        }else if ($page == "LOGIN" && $result == "0"){
            header("Refresh: 2; /kartelaweb/view/login_view.php");
        }else if ($page == "BARCODE_SCANNER_RESULT"){
            header("Refresh: 2; /kartelaweb/view/barcode_scanner_order_navigator.php");
        }else if ($page == "REGISTER_VIEW"){
            header("Refresh: 2; /kartelaweb/view/login_view.php");
        }
        else{
            header("Refresh: 2; /kartelaweb/index.php");
        }
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>