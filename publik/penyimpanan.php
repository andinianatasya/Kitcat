<?php
session_start();
session_start();
$host = "localhost";
$dbname = "Kitcat";
$user = "postgres";
$pass = "Miskagi8282";

$id_user = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT id_produk, jumlah_konsumsi FROM penyimpanan WHERE id = :id_user");
$stmt->execute(['id_user' => $id_user]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_produk'])) {
    $id_produk = $_POST['id_produk'];
    $id_user = $_SESSION['user_id'];

    try {
        // Cek apakah produk sudah dibeli user
        $stmt = $pdo->prepare("SELECT * FROM penyimpanan WHERE id_produk = :id_produk AND id = :id_user");
        $stmt->execute(['id_produk' => $id_produk, 'id_user' => $id_user]);

        if ($stmt->rowCount() == 0) {
            // Produk belum dibeli, tambahkan ke penyimpanan
            $stmt = $pdo->prepare("INSERT INTO penyimpanan (id_produk, id, jumlah_konsumsi) VALUES (:id_produk, :id_user, 0)");
            $stmt->execute(['id_produk' => $id_produk, 'id_user' => $id_user]);
            echo "Produk berhasil dibeli!";
        } else {
            echo "Produk ini sudah ada di penyimpanan Anda.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['consume'])) {
    $id_produk = $_POST['id_produk'];
    $id_user = $_SESSION['user_id'];

    $stmt = $pdo->prepare("UPDATE penyimpanan SET jumlah_konsumsi = jumlah_konsumsi + 1 WHERE id_produk = :id_produk AND id = :id_user");
    $stmt->execute(['id_produk' => $id_produk, 'id_user' => $id_user]);

    $stmt = $pdo->prepare("SELECT jumlah_konsumsi FROM penyimpanan WHERE id_produk = :id_produk AND id = :id_user");
    $stmt->execute(['id_produk' => $id_produk, 'id_user' => $id_user]);
    $jumlah_konsumsi = $stmt->fetchColumn();

    if ($jumlah_konsumsi >= 10) {
        $stmt = $pdo->prepare("DELETE FROM penyimpanan WHERE id_produk = :id_produk AND id = :id_user");
        $stmt->execute(['id_produk' => $id_produk, 'id_user' => $id_user]);
    }

    echo "Konsumsi berhasil!";
}

?>
