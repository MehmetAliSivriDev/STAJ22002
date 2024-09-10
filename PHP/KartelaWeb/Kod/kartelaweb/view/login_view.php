<?php 
  session_start();
  $_SESSION["PAGE"] = "LOGIN";
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
                <form action="/kartelaweb/backend/login.php" method="post">
                  <div class="form-outline mb-4">
                    <label class="form-label">Kullanıcı Adı</label>
                    <input type="text" id="username" name="username" class="form-control form-control-lg" required />
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label">Şifre</label>
                    <input type="password" id="pass" name="pass" class="form-control form-control-lg" required />  
                  </div>
                  <div class="form-outline mb-4 d-flex justify-content-center">
                      <a href="/kartelaweb/view/register_view.php" class="link-offset-2 link-underline link-underline-opacity-0"><h6 class="text-secondary">Kaydol</h6></a>
                  </div>
                  <div class="row pt-1 mb-4">
                    <button  class="btn btn-dark btn-lg btn-block" type="submit">Giriş Yap</button>
                  </div>
                </form>
              </div>
        </div>  
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>