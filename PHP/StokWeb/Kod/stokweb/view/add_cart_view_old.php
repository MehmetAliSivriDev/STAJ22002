<?php
    session_start();
    $_SESSION["PAGE"] = "ADD_CART_VIEW";

    if(isset($_GET['barcode'])){
        $barcode = $_GET['barcode'];
    }else{
        header("Location: /stokweb/view/create_cart.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepete Ekle</title>
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

    <div class="alert alert-primary mt-4 mb-3 mx-5 fs-6" role="alert">
    <?php echo "Sepete Eklenilecek Ürün Barkodu <b>".$barcode."</b>"; ?>
    </div>

    <h4 class="text-secondary m-5 p-1">Sipariş Bilgileri</h4>
    <div class="card shadow m-5 p-1">
        <form action="/stokweb/backend/add_item_to_cart.php" method="post">
            <div class="card-body">
                <input type="hidden" name="barcode" value="<?php echo $barcode ?>">
                <div class="row mt-2 mx-5 mb-5">
                    <h6 class="text-secondary">Firma Adı</h6>
                    <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Firma Adı" required> 
                </div>
                <div class="row mt-2 mx-5 mb-5">
                    <h6 class="text-secondary">Top No</h6>
                    <input type="number" class="form-control" id="topNo" name="topNo" placeholder="Firma Adı" required> 
                </div>
                <div class="row mt-2 mx-5 mb-5">
                    <h6 class="text-secondary">Satış Metresi</h6>
                    <input type="number" class="form-control" id="salesM" name="salesM" placeholder="Firma Adı" required> 
                </div>
                <div class="row mt-2 mx-5 mb-5">
                    <h6 class="text-secondary">Fiyat</h6>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Firma Adı" required> 
                </div>
                
            </div>
            <div class="row mx-4 mb-3">
            <div class="col-12 col-md-6">
                <a type="button" href="/stokweb/view/create_cart.php" class="btn btn-warning m-1 mb-3 p-2 btn-custom text-white" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 18 18">
                <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                </svg> Geri dön</a>
            </div>
            <div class="col-12 col-md-6">  
                <button type="submit" class="btn btn-success btn-custom m-1 mb-1 p-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Sepete Ekle <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-basket3-fill" viewBox="0 0 18 18">
                <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.468 15.426.943 9h14.114l-1.525 6.426a.75.75 0 0 1-.729.574H3.197a.75.75 0 0 1-.73-.574z"/>
                </svg>
                </button>  
            </div>
    </div>
        </form>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>