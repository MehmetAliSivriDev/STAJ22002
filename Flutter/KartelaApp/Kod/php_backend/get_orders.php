
<?php
// Config dosyasını dahil et
include('config.php');

// JSON çıktısı olduğunu belirtmek için header ayarla
header('Content-Type: application/json');

// Veritabanı bağlantısını kur
try {
    $conn = new PDO("sqlsrv:server=" . DB_SERVER . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM Orders";

    $stmt = $conn->prepare($sql);


    // Sorguyu çalıştır
    $stmt->execute();

    // Sonuçları al
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // JSON olarak döndür
    echo json_encode($results);
} catch (PDOException $e) {
    // Hata durumunda JSON formatında hata mesajı döndür
    echo json_encode(["error" => "Veritabanı bağlantısında hata: " . htmlspecialchars($e->getMessage())]);
}

// Bağlantıyı kapat
$conn = null;
?>
