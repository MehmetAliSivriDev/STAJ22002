<?php
    session_start();
    $_SESSION["PAGE"] = "ORDER_INFO_VIEW";  
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
    
    if(isset($_GET["orderNumber"]) && isset($_GET['orderMail'])){

        $orderNumber = test_input($_GET["orderNumber"]);
        $orderMail = test_input($_GET["orderMail"]);

        include('../backend/config.php');

        $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // SQL sorgusu 
        $sql = "SELECT * FROM Orders WHERE OrderNumber = :v1 AND Email = :v2";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":v1", $orderNumber);
        $stmt->bindParam(":v2", $orderMail);

        // Sorguyu çalıştır
        $stmt->execute();
    
        // Sonuçları al
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Bağlantıyı kapat
        $conn = null;     

    }
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipariş Sorgulama</title>
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
    <h4 class="text-secondary m-5 p-1">Sipariş Sorgulama <?php echo("(<span style='font-weight: bold;'>$orderNumber</span>)") ?></h4>
    <?php 
        if($orders != null && count($orders) > 0){
        foreach ($orders as $data) {?>
            <div class="card shadow m-5 p-1">
                <div class="card-body">
                    <h5 class="card-title p-5">Barkod : <?php echo $data["KartelaBar"] ?>
                        <?php if($data["isActive"] == 1){ ?>
                            <span class="badge text-bg-primary">Sipariş Hala Aktif <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 18 18">
                            <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z"/>
                            <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z"/>
                            <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5"/>
                            </svg></span>
                        <?php } else { ?>
                            <span class="badge text-bg-success">Sipariş Teslim Edildi <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-bag-check-fill mx-1" viewBox="0 0 18 18">
                            <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0m-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z"/>
                            </svg></span>
                        <?php } ?>
                    </h5>
                </div>
                
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><span style="font-weight: bold;">Miktar :</span> <?php echo $data["orderCount"] ?></li>
                    <li class="list-group-item"><span style="font-weight: bold;">Sipariş Verilen Tarih :</span> <?php echo $data["ODate"] ?></li>
                    <?php 
                        $hour = new DateTime($data["OHour"]);
                        $formattedTime = $hour->format('H:i:s');
                    ?>
                    <li class="list-group-item"><span style="font-weight: bold;">Sipariş Verilen Saat :</span> <?php echo $formattedTime ?></li>
                    <li class="list-group-item"><span style="font-weight: bold;">Firma Adı :</span> <?php echo $data["CompanyName"]?></li>
                    <li class="list-group-item"><span style="font-weight: bold;">Firma Maili :</span> <?php echo $data["Email"]?></li>
                    <li class="list-group-item"><span style="font-weight: bold;">Firma Telefonu :</span> <?php echo $data["Phone"]?></li>
                </ul> 
            </div>
    <?php }} else { ?>
        <div class="alert alert-secondary m-5" role="alert">
        <?php echo "<span style='font-weight: bold;'>$orderMail</span> firma mailine ve <span style='font-weight: bold;'>$orderNumber</span> nolu sipariş numarasına sahip bir veri bulunamadı." ?>
        </div>
    <?php } ?>
    <div class='container-fluid text-white my-5'>.</div>
    <div class="row my-5 mx-2 fixed-bottom">
        <a type="button" href="/kartelaweb/view/order_inquiry.php" class="btn btn-warning m-1 mb-3 p-2 btn-custom text-white" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 18 18">
        <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
        </svg> Geri dön</a>
    </div> 
    
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>