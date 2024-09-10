<?php
  $page = $_SESSION["PAGE"];
?>

<nav class="navbar bg-body-tertiary fixed-top">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/kartelaweb/index.php"><img src="/kartelaweb/assets/logo/peykartela.png"
    alt="logo" width="128" height="20"/>  </a>
    <div class="float-right-container" <?php echo (($page == "DATA_DISPLAY" || $page == "BARCODE_SEARCH") ? "" : "style='display: none;'")?>>
        <form action="/kartelaweb/view/barcode_search.php" method="GET" class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Barkoda Göre Ara" aria-label="Search" name="arananBarkod" required>
        <button class="btn btn-outline-success" type="submit">Ara</button>
        </form>
    </div>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header bg-secondary">
        <h5 class="offcanvas-title text-white" id="offcanvasNavbarLabel">PEYKARTELA</h5>
        <button type="button" class="btn-close bg-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-start flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/kartelaweb/index.php"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 18 18">
            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
            <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z"/>
            </svg> Anasayfa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/kartelaweb/view/data_display.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" fill="currentColor" class="bi bi-display-fill" viewBox="0 0 18 18">
            <path d="M6 12q0 1-.25 1.5H5a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1h-.75Q10 13 10 12h4c2 0 2-2 2-2V4c0-2-2-2-2-2H2C0 2 0 4 0 4v6c0 2 2 2 2 2z"/>
            </svg> Kartelaları Görüntüle</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/kartelaweb/view/orders_display.php"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-basket-fill" viewBox="0 0 18 18">
            <path d="M5.071 1.243a.5.5 0 0 1 .858.514L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 6h1.717zM3.5 10.5a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0z"/>
            </svg> Sipariş Sepeti</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/kartelaweb/view/all_orders.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z"/>
            </svg> Tüm Siparişleri Görüntüle</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/kartelaweb/view/order_inquiry.php"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-search" viewBox="0 0 18 18">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg> Sipariş Sorgulama</a>
          </li>
          <li class="nav-item mb-5">
            <a class="nav-link" href="/kartelaweb/backend/quit.php"><b><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 18 18">
            <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15zM11 2h.5a.5.5 0 0 1 .5.5V15h-1zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1"/>
            </svg> Çıkış Yap</b></a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>