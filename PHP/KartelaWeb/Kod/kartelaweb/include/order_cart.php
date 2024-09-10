<?php 
    $Orders = $_SESSION["cart"];
?>
<?php 
    echo "<div class='container-fluid text-white m-2 '>.</div>";
    foreach ($Orders as $data) { ?>
    <div class="card shadow p-2 m-5">
        <div class="card-body">
            <img style="float:left;width: 128px; height: 128px; object-fit: cover;" 
            onerror="this.onerror=null; this.src='/kartelaweb/resim/resimyok.jpg';" 
            src="<?php echo $data["Image"]?>" class="card-img-top me-1">

            <h5 class="card-title p-5">Barkod : <?php echo $data["Bar"] ?></h5>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><span style="font-weight: bold;">Varyant :</span> <?php echo $data["Varyant"] ?></li>
            <li class="list-group-item"><span style="font-weight: bold;">Desen :</span> <?php echo $data["Desen"] ?></li>
            <li class="list-group-item"><span style="font-weight: bold;">Com :</span> <?php echo $data["Com"] ?></li>
            <li class="list-group-item"><span style="font-weight: bold;">Desen Kod :</span> <?php echo $data["DesenKod"] ?></li>
            <li class="list-group-item"><span style="font-weight: bold;">Kg :</span> <?php echo $data["Kg"] ?></li>
            <li class="list-group-item"><span style="font-weight: bold;">En :</span> <?php echo $data["En"] ?></li>
            <li class="list-group-item"><span style="font-weight: bold;">Renk :</span> <?php echo $data["Renk"] ?></li>
            <li class="list-group-item"><span style="font-weight: bold;">Tip :</span> <?php echo $data["Tip"] ?></li>
            <li class="list-group-item"><span style="font-weight: bold;">KEn :</span> <?php echo $data["KEn"] ?></li>
        </ul>
    </div>

<?php } ?>
         