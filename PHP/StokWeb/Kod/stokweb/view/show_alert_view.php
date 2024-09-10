<?php
    session_start();
    $result = $_SESSION["result"];
    $message = $_SESSION["message"];
    $page = $_SESSION['PAGE'];
    if(isset($_SESSION["salesId"])){
        $salesId = $_SESSION["salesId"];
    }else{
        $salesId = -1;
    }
    
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

        if($page == "STOCK_ENTER_BARCODE"){
            header("Refresh: 2; /stokweb/view/barcode_scanner.php");
        }else if ($page == "STOCK_ENTER_HAND"){
            header("Refresh: 2; /stokweb/view/stock_enter_hand.php");
        }else if ($page == "ADD_CART_VIEW"){
            header("Refresh: 2; /stokweb/view/create_cart.php");
        }else if ($page == "CREATE_CART"){
            header("Refresh: 2; /stokweb/view/create_cart.php");
        }else if ($page == "ADD_NEW_COMPANY"){
            header("Refresh: 2; /stokweb/view/make_new_sale_company.php");
        }else if ($page == "MAKE_NEW_SALE_BARCODE_SCAN"){
            header("Refresh: 2; /stokweb/view/make_new_sale.php?salesId=$salesId");
        }else if ($page = "MAKE_NEW_SALE_COMPANY"){
            header("Refresh: 2; /stokweb/view/make_new_sale.php?salesId=$salesId");
        }
                
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>