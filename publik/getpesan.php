<?php
session_start(); // Pastikan untuk memulai session

$host = "localhost";
$dbname = "kitcat";
$user = "postgres";
$password = "Medan2005";

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Mengambil pesan, nama_profil, dan avatar dari tabel yang sesuai
    $stmt = $pdo->query("SELECT cg.*, u.nama_profil, u.avatar FROM chatglobal cg JOIN userkitcat u ON cg.id = u.id ORDER BY cg.dikirim ASC");
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Menambahkan path ke avatar
    foreach ($messages as &$message) {
        $message['avatar'] = "img/" . htmlspecialchars($message['avatar']) . ".png"; // Menyusun path avatar
    }

    // Mengembalikan data sebagai JSON
    echo json_encode($messages);
} catch (PDOException $e) {
    // Mengembalikan pesan kesalahan dalam format JSON
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
} catch (Exception $e) {
    // Mengembalikan pesan kesalahan umum dalam format JSON
    echo json_encode(['error' => 'General error: ' . $e->getMessage()]);
}
?>