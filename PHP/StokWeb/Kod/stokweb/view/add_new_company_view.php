<?php
    session_start();
    $_SESSION["PAGE"] = "ADD_NEW_COMPANY";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni Firma</title>
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

    <h4 class="text-secondary m-5 p-1">Yeni Firma Ekle</h4>
    <div class="card shadow m-5 p-1">
        <form action="/stokweb/backend/add_new_company.php" method="post">
            <div class="card-body">
                <div class="row mt-2 mx-5 mb-5">
                    <h6 class="text-secondary">Firma Adı</h6>
                    <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Firma Adı" required> 
                </div>
                <div class="row mt-2 mx-5 mb-5">
                    <h6 class="text-secondary">Adres</h6>
                    <input type="text" class="form-control" id="adress" name="adress" placeholder="Firma Adresi"> 
                </div>
                <div class="row mt-2 mx-5 mb-5">
                    <h6 class="text-secondary">Telefon</h6>
                    <input type="number" class="form-control" id="phone" name="phone" placeholder="Firma Telefonu"> 
                </div>
                <div class="row mt-2 mx-5 mb-5">
                    <h6 class="text-secondary">Ülke</h6>
                    <input type="text" class="form-control" id="country" name="country" placeholder="Firmanın Yer Aldığı Ülke"> 
                </div>
            </div>
            <div class="row mx-4 mb-3">
            <div class="col-12 col-md-6">
                <a type="button" href="/stokweb/view/make_new_sale_company.php" class="btn btn-warning m-1 mb-3 p-2 btn-custom text-white" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 18 18">
                <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                </svg> Geri dön</a>
            </div>
            <div class="col-12 col-md-6">  
                <button type="submit" class="btn btn-success btn-custom m-1 mb-1 p-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Firmayı Ekle <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-building" viewBox="0 0 18 18">
                <path d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z"/>
                <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1zm11 0H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3z"/>
                </svg>
                </button>  
            </div>
    </div>
        </form>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>