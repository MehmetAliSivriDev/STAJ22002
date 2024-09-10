<?php
    session_start();
    $_SESSION["PAGE"] = "ORDER_COMPLETE";
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
    <title>Siparişi Tamamla</title>
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

    <div class='container-fluid text-white my-2 '>.</div>
    <h4 class="text-secondary m-5 p-1">Firma Bilgileri</h4>
    <div class="card shadow m-5 p-1">
        <form id="order_complete_form" action="/kartelaweb/backend/insert_orders.php" method="post">
            <div class="card-body">
                <div class="row mt-2 mx-5 mb-5">
                    <h6 class="text-secondary">Firma Adı</h6>
                    <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Firma Adı" required> 
                </div>
                <div class="row mt-2 mx-5 mb-5">
                    <h6 class="text-secondary">Firma Mail</h6>
                    <input type="email" class="form-control" id="companyMail" name="companyMail" placeholder="Mail" required> 
                    <p class="text-danger" id="emailInvalid"></p>
                </div>
                <div class="row mt-2 mx-5 mb-5">
                    <h6 class="text-secondary">Firma Telefon Numarası</h6>
                    <input type="number" class="form-control" id="companyPhone" name="companyPhone" placeholder="Telefon Numarası" required> 
                    <p class="text-danger" id="phoneInvalid"></p>
                </div>
            </div>
            <div class="row mx-4 mb-3">
            <div class="col-12 col-md-6">
                <a type="button" href="/kartelaweb/view/orders_display.php" class="btn btn-warning m-1 mb-3 p-2 btn-custom text-white" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 18 18">
                <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                </svg> Geri dön</a>
            </div>
            <div class="col-12 col-md-6">  
                <button type="submit" class="btn btn-success btn-custom m-1 mb-1 p-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Siparişi Tamamla <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 18 18">
                    <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"/>
                    </svg>
                </button>  
            </div>
    </div>
        </form>
    </div>


  <script>
  
    document.getElementById('order_complete_form').addEventListener('submit', function(event) {
      var emailInput = document.getElementById('companyMail');
      var emailInvalid = document.getElementById('emailInvalid');
      var email = emailInput.value;

      var phoneInput = document.getElementById('companyPhone');
      var phoneInvalid = document.getElementById('phoneInvalid');
      var phone = phoneInput.value;

      // E-posta ".com" ile başlamamalı ve ".com" içermelidir
      if (email.startsWith('.com') || !email.includes('.com')) {
        event.preventDefault();  // Formun gönderilmesini engeller
        emailInput.classList.add('is-invalid');  // Bootstrap'in hata sınıfını ekler
        emailInvalid.innerHTML = "Email (.com) ve (@) içermelidir!";

      } else {
        emailInput.classList.remove('is-invalid');
        emailInput.classList.add('is-valid'); 
        emailInvalid.innerHTML = "";
      }

      // Telefon Numarası En Az "10" En Fazla "11" Haneli Olmalıdır
      if (phone.length > 11 || phone.length < 10) {
        event.preventDefault();  // Formun gönderilmesini engeller
        phoneInput.classList.add('is-invalid');  // Bootstrap'in hata sınıfını ekler
        phoneInvalid.innerHTML = "Geçerli Bir Telefon Numarası Giriniz";

      } else {
        phoneInput.classList.remove('is-invalid');
        phoneInput.classList.add('is-valid'); 
        phoneInvalid.innerHTML = "";
      }
    });
  </script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>