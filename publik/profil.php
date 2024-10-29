<?php
session_start();

// Cek jika ada pesan kesalahan dan simpan dalam dsini
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
// Hapus pesan dari sesi setelah diambil
unset($_SESSION['message']);

if (isset($_GET['ruangan'])) {
    $_SESSION['ruangan'] = htmlspecialchars($_GET['ruangan']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nama'])) {
        $_SESSION['nama_profil'] = htmlspecialchars($_POST['nama']);
    }

    if (isset($_POST['avatar'])) {
        $_SESSION['avatar'] = htmlspecialchars($_POST['avatar']);
    }
}

$nama_profil = isset($_SESSION['nama_profil']) ? $_SESSION['nama_profil'] : "Poat";
$avatar = isset($_SESSION['avatar']) ? $_SESSION['avatar'] : "avatar1";
$avatar_path = "img/" . htmlspecialchars($avatar) . ".png"; 

echo "Path gambar avatar: " . htmlspecialchars($avatar_path);

$ruangan_sebelumnya = isset($_GET['ruangan']) ? htmlspecialchars($_GET['ruangan']) : 'beranda.html';
echo "Ruangan sebelumnya: " . htmlspecialchars($ruangan_sebelumnya);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Poat</title>
</head>
<body class="overflow-hidden">
    <div class="bg-bgProfil bg-cover bg-center h-screen">
        <div class="fixed inset-0 bg-black bg-opacity-30 backdrop-blur-sm">
            <div class="flex items-center justify-center h-full">
                <div class="bg-gradient-to-br from-red-900 to-cream rounded-lg max-w-xl w-1/2 md:w-1/3 text-center outline outline-red-950">
                    <?php if ($message): ?>
                        <div class="text-red-600 text-xs font-semibold">
                            <?php echo htmlspecialchars($message); ?>
                        </div>
                    <?php endif; ?>
                    <div class="flex items-center space-x-4 mb-4">
                        <img src="<?php echo $avatar_path; ?>" alt="Avatar" class="mb-4 rounded-md border-4 border-red-900 h-10 md:h-20 pt-0 shadow-xl shadow-red-950"> 
                        
                        <div class="flex items-center space-x-2">
                            <span class="font-semibold text-lg underline underline-offset-8 text-white"><?php echo htmlspecialchars($nama_profil); ?></span>  
                            <button id="iconEdit">
                                <img class="w-5 h-5 hover:opacity-50" src="img/pulpenPutih.svg" alt="Edit">
                            </button>
                        </div>
                    </div>
    
                    <div id="editNama" class="hidden p-2">
                        <form action="editProfil.php" method="post">
                            <label class="block mb-2 font-semibold text-start text-white">Nama Pengguna:</label>
                            <input type="text" name="nama" class="p-2 border border-gray-300 rounded w-full" placeholder="Masukkan nama baru" value="<?php echo htmlspecialchars($nama_profil); ?>" />  

                            <div id="avatar" class="justify-center pb-3 mt-3">
                                <button type="button" class="outline-merahTua bg-gradient-to-br from-orange-400 to-merahTua hover:opacity-50 text-xs font-semibold text-white py-2 px-3 rounded-sm mb-4">Pilih Avatar</button>
                                <div id="tampilkanAvatar" class="hidden">
                                    <div class="flex gap-5 justify-center">
                                        <label class="flex flex-col items-center">
                                            <input type="radio" name="avatar" value="avatar1" 
                                            <?php if ($_SESSION['avatar'] == 'avatar1') echo 'checked'; ?>>
                                            <img class="w-10 rounded-lg" src="img/avatar1.png" alt="Avatar 1">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <input type="radio" name="avatar" value="avatar2" 
                                            <?php if ($_SESSION['avatar'] == 'avatar2') echo 'checked'; ?>>
                                            <img class="w-10 rounded-lg" src="img/avatar2.png" alt="Avatar 2">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <input type="radio" name="avatar" value="avatar3" 
                                            <?php if ($_SESSION['avatar'] == 'avatar3') echo 'checked'; ?>>
                                            <img class="w-10 rounded-lg" src="img/avatar3.png" alt="Avatar 3">
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="px-3 py-1 mt-2 md:px-4 md:py-2 bg-merahTua text-white rounded hover:bg-red-950 text-xs font-semibold">Simpan</button>    
                        </form>
                    </div>

                    <button class="mt-3 mb-2 px-3 py-1 md:px-4 md:py-2 bg-merahTua text-white rounded hover:bg-red-950 text-xs font-semibold"><a href="<?php echo $ruangan_sebelumnya; ?>">Tutup</a></button>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    document.getElementById("iconEdit").addEventListener("click", function() {
        document.getElementById("editNama").classList.toggle("hidden");
    });

    document.getElementById("avatar").addEventListener("click", function(){
        document.getElementById("tampilkanAvatar").classList.toggle("hidden");
    })
</script>
</html>