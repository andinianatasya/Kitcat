<?php
session_start();
$host = "localhost";
$dbname = "kitcat";
$user = "postgres";
$pass = "Medan2005";

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // ini buat cek usernme sama pass ya
        $stmt = $pdo->prepare("SELECT * FROM userkitcat WHERE username = :username");
        $stmt->execute(['username' => $username]);
        
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                // jika login berhasil, mk diarahkan ke halaman beranda ygy ><
                $_SESSION['nama_profil'] = $user['nama_profil'];
                $_SESSION['avatar'] = $user['avatar'];
                header("Location: beranda.html");
                exit;
            } else {
                echo "Password salah.";
            }
        } else {
            echo "Username tidak ditemukan.";
        }
    }
}
catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>