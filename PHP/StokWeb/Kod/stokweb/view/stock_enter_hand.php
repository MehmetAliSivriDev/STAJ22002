<?php
    session_start();
    $_SESSION['PAGE'] = "STOCK_ENTER_HAND";
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Giriş El İle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <div class="container-fluid my-5">
        <div class="card shadow p-2" style="border-radius: 1rem;">
              <div class="card-body text-black">
                  <div class="d-flex justify-content-center mb-5 pb-1">
                    <img src="/stokweb/assets/logo/peystok.png"
                    alt="logo" width="256" height="50"/>   
                  </div>
                
                <form action="/stokweb/backend/transfer_order.php" method="POST">
                    <div class="row mt-3 mx-3 mb-5">
                        <h6 class="text-secondary">Barkod</h6>
                        <input type="text" class="form-control" id="Bar" name="Bar" placeholder="Barkod Numarası" required> 
                    </div>
                    <div class="row mt-1 mx-3 mb-5">
                        <h6 class="text-secondary">Varyant</h6>
                        <input type="text" class="form-control" id="Varyant" name="Varyant" placeholder="Varyant" required> 
                    </div>
                    <div class="row mt-1 mx-3 mb-5">
                        <h6 class="text-secondary">Desen</h6>
                        <input type="text" class="form-control" id="Desen" name="Desen" placeholder="Desen" required> 
                    </div>
                    <div class="row mt-1 mx-3 mb-5">
                        <h6 class="text-secondary">Desen Türü</h6>
                        <input type="text" class="form-control" id="DesenTur" name="DesenTur" placeholder="Desen Türü" required> 
                    </div>
                    <div class="row mt-1 mx-3 mb-5">
                        <h6 class="text-secondary">En</h6>
                        <input type="text" class="form-control" id="En" name="En" placeholder="En" required> 
                    </div>
                    <div class="row mt-1 mx-3 mb-5">
                        <h6 class="text-secondary">Renk</h6>
                        <input type="text" class="form-control" id="Renk" name="Renk" placeholder="Renk" required> 
                    </div>
                    <div class="row mt-1 mx-3 mb-5">
                        <h6 class="text-secondary">Tip</h6>
                        <input type="text" class="form-control" id="Tip" name="Tip" placeholder="Tip" required> 
                    </div>
                    <div class="row mt-1 mx-3 mb-5">
                        <h6 class="text-secondary">Metraj</h6>
                        <input type="text" class="form-control" id="Metraj" name="Metraj" placeholder="Metraj" required> 
                    </div>
                    <div class="row my-3 mx-2">
                            <button type="submit" class="btn btn-success my-3 text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">Stok Ekle <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 18 18">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0"/>
                        </svg>
                        </button>
                    </div>
                </form>
                <div class="row mx-2">
                    <a href="/stokweb/view/stock_enter_type.php"  class="btn btn-warning btn-lg btn-block text-white"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 18 18">
                    <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                    </svg> Geri Dön</a>
                  </div>
                </div>
              </div>
        </div>  
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
