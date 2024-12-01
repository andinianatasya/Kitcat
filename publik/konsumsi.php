<?php
$host = "localhost";
$dbname = "Kitcat";
$user = "postgres";
$password = "Miskagi8282";

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

// Mendapatkan data dari request
$data = json_decode(file_get_contents("php://input"), true);
$id_produk = $data['id_produk'] ?? null; // Menggunakan null coalescing operator

if ($id_produk === null) {
    echo json_encode(['status' => 'gagal', 'message' => 'ID produk tidak diberikan.']);
    exit;
}

try {
    // Mulai transaksi
    $pdo->beginTransaction();

    // Update jumlah_konsumsi
    $stmt = $pdo->prepare("UPDATE penyimpanan SET jumlah_konsumsi = jumlah_konsumsi + 1 WHERE id_produk = :id_produk");
    $stmt->execute([':id_produk' => $id_produk]);

    // Cek jumlah_konsumsi
    $stmt = $pdo->prepare("SELECT jumlah_konsumsi FROM penyimpanan WHERE id_produk = :id_produk");
    $stmt->execute([':id_produk' => $id_produk]);
    
    // Ambil hasil
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Jika tidak ada hasil, berarti produk tidak ditemukan
    if ($result === false) {
        throw new Exception("Produk tidak ditemukan dalam penyimpanan.");
    }

    // Jika jumlah_konsumsi mencapai 10, hapus produk dari tabel penyimpanan
    if ($result['jumlah_konsumsi'] >= 10) {
        $stmt = $pdo->prepare("DELETE FROM penyimpanan WHERE id_produk = :id_produk");
        $stmt->execute([':id_produk' => $id_produk]);
        $message = "Produk telah dihapus dari penyimpanan.";
    } else {
        $message = "Jumlah konsumsi produk bertambah.";
    }

    // Commit transaksi
    $pdo->commit();

    // Mengirimkan response
    echo json_encode(['status' => 'sukses', 'message' => $message]);
} catch (Exception $e) {
    // Rollback transaksi jika terjadi kesalahan
    $pdo->rollBack();
    echo json_encode(['status' => 'gagal', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
}
?>