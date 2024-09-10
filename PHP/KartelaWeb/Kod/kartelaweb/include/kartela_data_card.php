<?php 
    $kartelaData = $_SESSION["KartelaData"];
?>
    <div class='container-fluid text-white my-3 '>.</div>
    
    <?php foreach ($kartelaData as $data) { ?>
    
    <div class="card shadow p-1 mx-5 mb-4 mt-1">
        <div class="card-body">
            <img style="float:left;width: 128px; height: 128px; object-fit: cover;" 
            onerror="this.onerror=null; this.src='/kartelaweb/resim/resimyok.jpg';" 
            src="/kartelaweb/resim/<?php echo $data["Bar"].".jpg"?>" class="card-img-top me-1">
            
            <h5 class="card-title p-5"><?php echo $data["Bar"] ?></h5>
            <form action="/kartelaweb/view/order.php" method="post">
                <input type="hidden" name="image" value="<?php echo "/kartelaweb/resim/$data[Bar].jpg"?>"; ?>
                <input type="hidden" name="Bar" value="<?php echo $data["Bar"] ?>">
                <input type="hidden" name="Varyant" value="<?php echo $data["Varyant"] ?>">
                <input type="hidden" name="Desen" value="<?php echo $data["Desen"] ?>">
                <input type="hidden" name="Com" value="<?php echo $data["Com"] ?>">
                <input type="hidden" name="DesenKod" value="<?php echo $data["DesenKod"] ?>">
                <input type="hidden" name="Kg" value="<?php echo $data["Kg"] ?>">
                <input type="hidden" name="En" value="<?php echo $data["En"] ?>">
                <input type="hidden" name="Renk" value="<?php echo $data["Renk"] ?>">
                <input type="hidden" name="Tip" value="<?php echo $data["Tip"] ?>">
                <input type="hidden" name="KEn" value="<?php echo $data["KEn"] ?>">
                <button type="submit" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#exampleModal"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 20 20">
                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z"/>
                    </svg> Sipariş Et
                </button>
             </form>
            
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><span style="font-weight: bold;">Desen Kod :</span> <?php echo $data["DesenKod"] ?></li>
            <li class="list-group-item"><span style="font-weight: bold;">Tip :</span> <?php echo $data["Tip"] ?></li>
            <li class="list-group-item"><span style="font-weight: bold;">Desen :</span> <?php echo $data["Desen"] ?></li>
            <li class="list-group-item"><span style="font-weight: bold;">Varyant :</span> <?php echo $data["Varyant"] ?></li>
            <li class="list-group-item"><span style="font-weight: bold;">Renk :</span> <?php echo $data["Renk"] ?></li>
            <li class="list-group-item"><span style="font-weight: bold;">Com :</span> <?php echo $data["Com"] ?></li>  
            <li class="list-group-item"><span style="font-weight: bold;">Kg :</span> <?php echo $data["Kg"] ?></li>
            <li class="list-group-item"><span style="font-weight: bold;">En :</span> <?php echo $data["En"] ?></li>
            <li class="list-group-item"><span style="font-weight: bold;">KEn :</span> <?php echo $data["KEn"] ?></li>
        </ul>
    </div>
    

<?php }?>
    <div class='container-fluid text-white mt-5'>.</div>
    <div class='container-fluid text-white mt-5'>.</div>

         