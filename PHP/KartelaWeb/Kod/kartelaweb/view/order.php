<?php
    session_start();
    if($_SESSION["PAGE"] != "BARCODE_SCANNER_RESULT"){
        $_SESSION["PAGE"] = "ORDER";
    }
    $user = $_SESSION['username'];

    if($user == null || trim($user) == ""){
        header("Location: /kartelaweb/view/login_view.php");
    }

    function test_input($data){ 
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(isset($_POST["Bar"]) && isset($_POST["Varyant"]) && isset($_POST["Desen"]) && isset($_POST["Com"]) && isset($_POST["DesenKod"])
    && isset($_POST["Kg"]) && isset($_POST["En"]) && isset($_POST["Renk"]) && isset($_POST["Tip"]) && isset($_POST["KEn"]) && isset($_POST["image"])
    ){
        $image = test_input($_POST["image"]);
        $bar =  test_input($_POST["Bar"]);
        $variant =  test_input($_POST["Varyant"]);
        $pattern =  test_input($_POST["Desen"]);
        $com =  test_input($_POST["Com"]);
        $patternCode =  test_input($_POST["DesenKod"]);
        $kg =  test_input($_POST["Kg"]);
        $width =  test_input($_POST["En"]);
        $color =  test_input($_POST["Renk"]);
        $type =  test_input($_POST["Tip"]);
        $kWidth =  test_input($_POST["KEn"]);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipariş Ver</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .btn-custom {
            width: 100%;
            float:left;
        }
    </style>

</head>
<body>

    <div class='container-fluid text-white my-2 '>.</div>

    <?php include("../include/navbar.php") ?>

    <div class="card shadow p-2 m-5">
        <div class="card-body">
            <img style="float:left;width: 128px; height: 128px; object-fit: cover;" 
            onerror="this.onerror=null; this.src='/kartelaweb/resim/resimyok.jpg';" 
            src="<?php echo $image?>" class="card-img-top me-1">

            <h5 class="card-title p-5">Barkod : <?php echo $bar ?></h5>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><span style="font-weight: bold;">Desen Kod :</span> <?php echo $patternCode ?></li>
            <li class="list-group-item"><span style="font-weight: bold;">Tip :</span> <?php echo $type ?></li>
            <li class="list-group-item"><span style="font-weight: bold;">Desen :</span> <?php echo $pattern ?></li>
            <li class="list-group-item"><span style="font-weight: bold;">Varyant :</span> <?php echo $variant ?></li>
            <li class="list-group-item"><span style="font-weight: bold;">Renk :</span> <?php echo $color ?></li>
            <li class="list-group-item"><span style="font-weight: bold;">Com :</span> <?php echo $com ?></li>  
            <li class="list-group-item"><span style="font-weight: bold;">Kg :</span> <?php echo $kg ?></li>
            <li class="list-group-item"><span style="font-weight: bold;">En :</span> <?php echo $width ?></li>
            <li class="list-group-item"><span style="font-weight: bold;">KEn :</span> <?php echo $kWidth ?></li>
        </ul>
    </div>

    <form action="/kartelaweb/backend/add_item_to_cart.php" method="post">
        <div class="row mt-2 mx-5 mb-5">
            <h4 class="text-secondary">Sipariş Miktarı</h4>
            <input type="number" class="form-control" id="count" name="count" placeholder="Metre" required> 
        </div>

        <div class="row mx-4 mb-3">
            <div class="col-12 col-md-6">
                <?php        
                    if($_SESSION['PAGE'] == "BARCODE_SCANNER_RESULT"){ ?>
                    <a type="button" onclick="window.history.back(); return false;" class="btn btn-warning m-1 mb-3 p-2 btn-custom text-white" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 18 18">
                    <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                    </svg> Geri dön</a>
                <?php } else {?>
                    <a type="button" href="/kartelaweb/view/data_display.php" class="btn btn-warning m-1 mb-3 p-2 btn-custom text-white" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 18 18">
                    <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                    </svg> Geri dön</a>
                <?php } ?>
            </div>
            <div class="col-12 col-md-6">  
                <input type="hidden" name="image" value="<?php echo $image; ?>">
                <input type="hidden" name="Bar" value="<?php echo $bar ?>">
                <input type="hidden" name="Varyant" value="<?php echo $variant ?>">
                <input type="hidden" name="Desen" value="<?php echo $pattern ?>">
                <input type="hidden" name="Com" value="<?php echo $com ?>">
                <input type="hidden" name="DesenKod" value="<?php echo $patternCode ?>">
                <input type="hidden" name="Kg" value="<?php echo $kg ?>">
                <input type="hidden" name="En" value="<?php echo $width ?>">
                <input type="hidden" name="Renk" value="<?php echo $color ?>">
                <input type="hidden" name="Tip" value="<?php echo $type ?>">
                <input type="hidden" name="KEn" value="<?php echo $kWidth ?>">
                <button type="submit" class="btn btn-success btn-custom m-1 mb-1 p-2" data-bs-toggle="modal" data-bs-target="#exampleModal"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 20 20">
                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z"/>
                    </svg> Sepete Ekle
                </button>  
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
</body>
</html>