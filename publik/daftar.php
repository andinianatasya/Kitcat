<?php
$host = "localhost";
$dbname = "userPoat";
$user = "postgres";
$pass = "Medan2005";

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        // Cek apakah username sudah ada ><
        $stmt = $pdo->prepare("SELECT * FROM userPoat WHERE username = :username");
        $stmt->execute(['username' => $username]);
        
        if ($stmt->rowCount() > 0) {
            echo "Username sudah terdaftar. Silakan pilih username lain.";
        } else {
            $stmt = $pdo->prepare("INSERT INTO userPoat (username, password) VALUES (:username, :password)");
            $stmt->execute(['username' => $username, 'password' => $password]);
            header("Location: login.php");
            exit;
        }
    }
}
catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>