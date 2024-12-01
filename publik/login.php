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
                $_SESSION['nama_profil'] = $user['nama_profil'];
                $_SESSION['avatar'] = $user['avatar'];
                header("Location: beranda.html");
                exit;
            } else {
                echo "<script>
                alert('Kata sandi salah.');
                window.location.href = 'login.html';
            </script>";
            }
        } else {
            echo "<script>
                alert('Nama pengguna tidak ditemukan.');
                window.location.href = 'login.html';
            </script>";
        }
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['get_user_id'])) {
        header('Content-Type: application/json');
        if (isset($_SESSION['user_id'])) {
            echo json_encode(['status' => 'success', 'user_id' => $_SESSION['user_id']]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
        }
        exit;
    }
}
catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>