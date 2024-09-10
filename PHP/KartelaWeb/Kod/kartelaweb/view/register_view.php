<?php 
  session_start();
  $_SESSION["PAGE"] = "REGISTER_VIEW";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

  <div class="container-fluid my-5">
        <div class="card shadow p-2" style="border-radius: 1rem;">
              <div class="card-body text-black">
                  <div class="d-flex justify-content-center mb-5 pb-1">
                    <img src="/kartelaweb/assets/logo/peykan_logo_1.jpg"
                    alt="logo" width="256" height="128"/>   
                  </div>
                <form action="/kartelaweb/backend/register.php" method="post">
                  <div class="form-outline mb-4">
                    <label class="form-label">Kullanıcı Adı</label>
                    <input type="text" id="username" name="username" class="form-control form-control-lg" required />
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label">Şifre</label>
                    <input type="password" id="pass" name="pass" class="form-control form-control-lg" required />  
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label">Firma Şifresi</label>
                    <input type="password" id="companyPass" name="companyPass" class="form-control form-control-lg" required />  
                  </div>

                  <div class="row pt-1 mb-4">
                    <button  class="btn btn-dark btn-lg btn-block" type="submit">Kaydol</button>
                  </div>
                  <div class="row pt-1 mb-4">
                    <a type="button" href="/kartelaweb/view/login_view.php" class="btn btn-warning m-1 mb-3 p-2 btn-custom text-white" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 18 18">
                    <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                    </svg> Geri dön</a>
                  </div>
                </form>
              </div>
        </div>  
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>