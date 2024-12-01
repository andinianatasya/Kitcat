<?php
$host = "localhost";
$dbname = "kitcat";
$user = "postgres";
$pass = "Medan2005";

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        // Cek apakah username sudah ada ><
        $stmt = $pdo->prepare("SELECT * FROM userkitcat WHERE username = :username");
        $stmt->execute(['username' => $username]);
        
        if ($stmt->rowCount() > 0) {
            echo "<script>
                alert('Nama pengguna sudah terdaftar. Silahkan pilih nama pengguna lain.');
                window.location.href = 'login.html';
            </script>";
        } else {
            $stmt = $pdo->prepare("INSERT INTO userkitcat (username, password) VALUES (:username, :password)");
            $stmt->execute(['username' => $username, 'password' => $password]);
        
            echo "<script>
                alert('Pendaftaran berhasil! Silakan Masuk.');
                window.location.href = 'login.html';
            </script>";
            exit;
        }
    }
}
catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>