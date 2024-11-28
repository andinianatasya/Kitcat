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
    echo "Koneksi gagal: " . $e->getMessage();
    exit;
}

//ini fungsi nya untk simpan koinny
function saveCoins($userId, $koin) {
    global $pdo;

    $stmt = $pdo->prepare("UPDATE userkitcat SET koin = koin + :koin WHERE id = :user_id");
    $stmt->bindParam(':koin', $koin, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(["status" => "sukses", "message" => "Koin berhasil disimpan."]);
    } else {
        echo json_encode(["status" => "terjadi kesalahan", "message" => "Gagal menyimpan koin."]);
    }
}

//klo ini untuk mengambil koin biar bisa ditampilkan di shopny
function getCoins($userId) {
    global $pdo;

    $stmt = $pdo->prepare("SELECT koin FROM userkitcat WHERE id = :user_id");
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':koin', $koin, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        echo json_encode(["status" => "sukses", "koin" => $result['koin']]);
    } else {
        echo json_encode(["status" => "terjadi kesalahan", "message" => "User  tidak ditemukan."]);
    }
}

$data = json_decode(file_get_contents("php://input"));

if (isset($data->koin)) { 
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $koin = $data->koin;

        saveCoins($userId, $koin);
    } else {
        echo json_encode(["status" => "terjadi kesalahan", "message" => "User  ID tidak ditemukan."]);
    }
} else if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    getCoins($userId);
} else {
    echo json_encode(["status" => "terjadi kesalahan", "message" => "User  ID tidak ditemukan."]);
}
?>