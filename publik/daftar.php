<?php
session_start();
$host = "localhost";
$dbname = "Kitcat";
$user = "postgres";
$pass = "Miskagi8282";

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
            // Insert data pengguna ke tabel userkitcat dan ambil id yang baru saja dibuat
            $stmt = $pdo->prepare("INSERT INTO userkitcat (username, password) VALUES (:username, :password) RETURNING id");
            $stmt->execute([
                'username' => $username,
                'password' => $password
            ]);
            $userId = $stmt->fetchColumn(); // Mengambil ID yang baru saja dimasukkan

            // Insert data kucing yang terhubung dengan pengguna baru
            $stmt = $pdo->prepare("INSERT INTO kucing (id, umur, kondisi, path_gambar) 
                                    VALUES (:id, :umur, :kondisi, :path_gambar)");
            $stmt->execute([
                'id' => $userId,             // Menggunakan id pengguna yang baru saja dibuat
                'umur' => 'bayi',            // Default umur
                'kondisi' => 'default',      // Default kondisi
                'path_gambar' => 'img/default_bayi.png' // Default gambar
            ]);

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
