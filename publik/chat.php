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

$user_id = $_SESSION['user_id'];
$message = $_POST['message'];


$query = "INSERT INTO global_chat (user_id, message, created_at) VALUES ($1, $2, NOW())";
pg_query_params($conn, $query, array($user_id, $message));

header("Location: index.php");
?>