<?php
session_start();

$host = "localhost";
$user = "postgres";
$pass = "Medan2005"; 
$dbname = "userPoat"; 

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Periksa apakah pengguna sudah login
if (isset($_SESSION['user_id'])) {
    // Ambil data pengguna dari database
    $sql = "SELECT nama_profil, avatar FROM userPoat WHERE id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        $_SESSION['nama_profil'] = $user['nama_profil'];
        $_SESSION['avatar'] = $user['avatar'];
    }
}

// Periksa apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_baru = htmlspecialchars(trim($_POST['nama']));
    $avatar = isset($_POST['avatar']) ? htmlspecialchars(trim($_POST['avatar'])) : null;

    $max_length = 10;
    $error = false;
    
    // Validasi nama
    if (strlen($nama_baru) > $max_length) {
        $_SESSION['message'] = "Error: Nama pengguna tidak boleh lebih dari $max_length karakter.";
        $error = true; // Set flag kesalahan
    } else if (!empty($nama_baru) && isset($_SESSION['user_id'])) {
        $sql = "UPDATE userPoat SET nama_profil = :nama_profil WHERE id = :user_id"; 
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':nama_profil', $nama_baru);
        $stmt->bindParam(':user_id', $_SESSION['user_id']); 

        if ($stmt->execute()) {
            $_SESSION['nama_profil'] = $nama_baru;
            $_SESSION['message'] = "Profil berhasil diperbarui.";
        } else {
            $_SESSION['message'] = "Error: Gagal memperbarui profil.";
        }
    }

    // Hanya proses pembaruan avatar jika tidak ada kesalahan
    if (!$error && $avatar && isset($_SESSION['user_id'])) {
        $sql = "UPDATE userPoat SET avatar = :avatar WHERE id = :user_id";
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':avatar', $avatar);
        $stmt->bindParam(':user_id', $_SESSION['user_id']);

        if ($stmt->execute()) {
            $_SESSION['avatar'] = $avatar; 
            $_SESSION['message'] = "Profil berhasil diperbarui.";
        } else {
            $_SESSION[' message'] = "Error: Gagal memperbarui profil.";
        }
    }

    header("Location: profil.php");
    exit();
}

$conn = null;
?>