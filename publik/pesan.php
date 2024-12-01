<?php
session_start();

$host = "localhost";
$dbname = "kitcat";
$user = "postgres";
$password = "medan2005";

$conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Koneksi gagal: " . pg_last_error());
}

$query = "SELECT users.nama_pengguna, users.avatar, global_chat.message, global_chat.created_at 
          FROM global_chat 
          JOIN users ON global_chat.user_id = users.id 
          ORDER BY global_chat.created_at ASC";

$result = pg_query($conn, $query);

while ($row = pg_fetch_assoc($result)) {
    echo "<div class='flex items-start mb-2'>
            <img src='" . htmlspecialchars($row['avatar']) . "' alt='Avatar' class='w-10 h-10 rounded-full mr-2'>
            <div class='bg-orange-200 rounded-lg p-2 text-merahTua'>
                <p><strong>" . htmlspecialchars($row['nama_pengguna']) . ":</strong> " . htmlspecialchars($row['message']) . "</p>
                <em>(" . $row['created_at'] . ")</em>
            </div>
          </div>";
}
?>