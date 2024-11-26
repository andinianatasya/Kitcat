<?php
session_start();
header('Content-Type: application/json');

$host = "localhost";
$dbname = "kitcat";
$user = "postgres";
$password = "Medan2005"; 

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["status" => "terjadi kesalahan", "message" => "Koneksi gagal: " . $e->getMessage()]);
    exit;
}

function consumeFood($foodId, $userId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT jumlah_konsumsi, limit_konsumsi FROM produk WHERE produk_id = :food_id");
    $stmt->bindParam(':food_id', $foodId, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result ) {
        $currentConsumption = $result['jumlah_konsumsi'];
        $limitConsumption = $result['limit_konsumsi'];

        if ($currentConsumption < $limitConsumption) {
            $stmt = $pdo->prepare("UPDATE produk SET jumlah_konsumsi = jumlah_konsumsi + 1 WHERE produk_id = :food_id");
            $stmt->bindParam(':food_id', $foodId, PDO::PARAM_STR);
            if ($stmt->execute()) {
                if ($currentConsumption + 1 >= $limitConsumption) {
                    // Kunci makanan jika sudah mencapai batas konsumsi
                    $stmt = $pdo->prepare("UPDATE produk SET status = FALSE WHERE produk_id = :food_id");
                    $stmt->bindParam(':food_id', $foodId, PDO::PARAM_STR);
                    $stmt->execute();
                }
                return ["status" => "sukses", "message" => "Makanan berhasil dikonsumsi."];
            }
        } else {
            return ["status" => "gagal", "message" => "Makanan sudah mencapai batas konsumsi."];
        }
    } else {
        return ["status" => "terjadi kesalahan", "message" => "Makanan tidak ditemukan."];
    }
}

$data = json_decode(file_get_contents("php://input"));

if (isset($data->foodId) && isset($_SESSION['user_id'])) {
    $foodId = $data->foodId;
    $userId = $_SESSION['user_id'];
    $responseConsume = consumeFood($foodId, $userId);
    echo json_encode($responseConsume);
} else {
    echo json_encode(["status" => "terjadi kesalahan", "message" => "ID makanan atau User tidak ditemukan."]);
}
?>