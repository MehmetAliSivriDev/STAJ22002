
<?php
    session_start();
    $_SESSION["PAGE"] = "BARCODE_SCANNER";

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
    <title>Kartela</title>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        #reader {
            width: 300px;
            height: 300px;
            border: 1px solid #000;
            margin-bottom: 10px;
        }
        video {
            width: 300px;
            height: 300px;
            display: block;
        }
    </style>
</head>
<body>

    <?php include('../include/navbar.php'); ?>
    <div class='container-fluid text-white my-5'>.</div>
    <div class="d-flex flex-column align-items-center card mx-2 shadow">
        <div class="card-body">
            <div class="row mb-2">
                <h4 class="text-secondary">Barkod Okuma</h4>
            </div>
            <div class="mb-5">
                <div id="reader"></div>
            </div>
            <form action="/kartelaweb/view/barcode_scanner_result.php" method="get">
                <div class="row mb-3">
                    <input type="text" class="form-control" id="result" name="result" placeholder="Okunan Barkod" required>
                    <p id="status"></p>
                </div>
                <div class="row mb-3">
                    <button type="submit" class="btn btn-success">Ara <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg></button>
                </div>
                <div class="row mb-3">
                    <a type="button" href="/kartelaweb/index.php" class="btn btn-warning mb-3 p-2 text-white" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 18 18">
                    <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                    </svg> Geri dön</a> 
                </div>
            </form>
        </div>
    </div>
    
    


    <script>
        // Barkod okuma işlemi başarıyla tamamlandığında çalışacak fonksiyon
        function onScanSuccess(decodedText, decodedResult) {
            // Okunan barkod verisini ekrana yazdır
            document.getElementById('result').value = decodedText;
        }

        function onScanFailure(error) {
            // Barkod okuma başarısız olduğunda yapılacak işlem (isteğe bağlı)
            console.warn(`Barkod okunamadı: ${error}`);
        }

        // Kamera ve barkod okuma işlemini başlat
        function startCameraAndBarcodeScanner() {
            const statusText = document.getElementById('status');

            // Barkod tarayıcısını başlat
            let html5QrCode = new Html5Qrcode("reader");
            html5QrCode.start(
                { facingMode: "environment" }, // Arka kamera kullanılır
                {
                    fps: 10,    // Tarama hızı (saniyede tarama sayısı)
                    qrbox: { width: 250, height: 250 }  // Tarama alanı boyutu
                },
                onScanSuccess,
                onScanFailure
            ).catch(err => {
                console.error(`Barkod tarayıcı başlatılamadı: ${err}`);
                statusText.textContent = "Kamera açılamadı: " + err.message;
            });
        }
        startCameraAndBarcodeScanner();
    </script>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
