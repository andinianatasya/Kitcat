<?php
session_start(); // Pastikan untuk memulai session

$host = "localhost";
$dbname = "kitcat";
$user = "postgres";
$password = "Medan2005";

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $data = json_decode(file_get_contents("php://input"), true);

if ($data === null) {
    echo json_encode(['success' => false, 'error' => 'Invalid JSON input']);
    exit; 
}

$userId = $data['id'] ?? null;
$pesan = $data['pesan'] ?? null; 

if ($userId === null || $pesan === null) {
    echo json_encode(['success' => false, 'error' => 'Missing id or pesan']);
    exit; 
}
    
    $data = json_decode(file_get_contents("php://input"), true);
    $userId = $data['id'];
    $pesan = $data['pesan'];

    // Memasukkan pesan ke dalam database
    $stmt = $pdo->prepare("INSERT INTO chatglobal (id, pesan, dikirim) VALUES (?, ?, NOW())");
    $stmt->execute([$userId, $pesan]);

    // Mengembalikan respons sukses
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    // Mengembalikan kesalahan dalam format JSON
    echo json_encode(['success' => false, 'error' => 'Database error: ' . $e->getMessage()]);
} catch (Exception $e) {
    // Mengembalikan kesalahan umum dalam format JSON
    echo json_encode(['success' => false, 'error' => 'General error: ' . $e->getMessage()]);
}
?>