<?php
    // Oturumu başlat
    session_start();

    // Oturum verilerini temizle
    session_unset();

    // Oturumu yok et
    session_destroy();

    header("Location: /kartelaweb/view/login_view.php");
?>