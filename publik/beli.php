<?php
session_start();
header('Content-Type: application/json');

$host = "localhost";
$dbname = "Kitcat";
$user = "postgres";
$password = "Miskagi8282"; 

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["status" => "terjadi kesalahan", "message" => "Koneksi gagal: " . $e->getMessage()]);
    exit;
}

// Fungsi untuk mengurangi koin
function beliItems($userId, $koin) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT koin FROM userkitcat WHERE id = :user_id");
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        $currentKoin = $result['koin'];
        if ($currentKoin >= $koin) {
            $stmt = $pdo->prepare("UPDATE Kitcat SET koin = koin - :koin WHERE id = :user_id");
            $stmt->bindParam(':koin', $koin, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return ["status" => "sukses", "message" => "Pembelian berhasil, koin Anda telah dikurangi."];
            } else {
                return ["status" => "terjadi kesalahan", "message" => "Gagal mengurangi koin."];
            }
        } else {
            return ["status" => "gagal", "message" => "Koin Anda tidak cukup untuk melakukan pembelian."];
        }
    } else {
        return ["status" => "terjadi kesalahan", "message" => "User  tidak ditemukan."];
    }
}

$data = json_decode(file_get_contents("php://input"));

if (isset($data->koin)) { 
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $koin = $data->koin;

        $responseBeli = beliItems($userId, $koin);
        echo json_encode($responseBeli); // balik ke js
    } else {
        echo json_encode(["status" => "terjadi kesalahan", "message" => "User  ID tidak ditemukan."]);
    }
} else if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    getCoins($userId);
 } else {
    echo json_encode(["status" => "terjadi kesalahan", "message" => "User   ID tidak ditemukan."]);
}
?>