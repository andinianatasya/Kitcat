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

// Fungsi untuk mengurangi koin dan menambah produk ke penyimpanan
function beliItems($userId, $id_produk, $harga) {
    global $pdo;

    // Periksa apakah user memiliki cukup koin
    $stmt = $pdo->prepare("SELECT koin FROM userkitcat WHERE id = :user_id");
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $currentKoin = $result['koin'];
        if ($currentKoin >= $harga) {
            // Kurangi koin
            $stmt = $pdo->prepare("UPDATE userkitcat SET koin = koin - :harga WHERE id = :user_id");
            $stmt->bindParam(':harga', $harga, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();

            // Tambahkan ke penyimpanan jika belum ada
            $stmt = $pdo->prepare("SELECT * FROM penyimpanan WHERE id_produk = :id_produk AND id = :user_id");
            $stmt->execute(['id_produk' => $id_produk, 'user_id' => $userId]);
            
            if ($stmt->rowCount() == 0) {
                $stmt = $pdo->prepare("INSERT INTO penyimpanan (id_produk, id) VALUES (:id_produk, :user_id)");
                $stmt->bindParam(':id_produk', $id_produk, PDO::PARAM_INT);
                $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
                $stmt->execute();

                return ["status" => "sukses", "message" => "Produk berhasil dibeli dan ditambahkan ke penyimpanan."];
            } else {
                return ["status" => "sukses", "message" => "Produk berhasil dibeli, tetapi sudah ada di penyimpanan."];
            }
        } else {
            return ["status" => "gagal", "message" => "Koin Anda tidak cukup untuk melakukan pembelian."];
        }
    } else {
        return ["status" => "terjadi kesalahan", "message" => "User tidak ditemukan."];
    }
}

$data = json_decode(file_get_contents("php://input"));

if (!$data) {
    echo json_encode(["status" => "gagal", "message" => "Data JSON tidak valid."]);
    exit;
}

if (isset($data->id_produk)) { 
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $id_produk = $data->id_produk;

        // Ambil harga produk dari tabel toko
        $stmt = $pdo->prepare("SELECT harga FROM toko WHERE id_produk = :id_produk");
        $stmt->bindParam(':id_produk', $id_produk, PDO::PARAM_INT);
        $stmt->execute();
        $produk = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($produk) {
            $harga = $produk['harga'];
            $responseBeli = beliItems($userId, $id_produk, $harga);
            echo json_encode($responseBeli);
        } else {
            echo json_encode(["status" => "gagal", "message" => "Produk tidak ditemukan."]);
        }
    } else {
        echo json_encode(["status" => "terjadi kesalahan", "message" => "User ID tidak ditemukan."]);
    }
} else {
    echo json_encode(["status" => "terjadi kesalahan", "message" => "ID produk tidak diberikan."]);
}
?>
