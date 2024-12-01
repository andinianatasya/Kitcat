<?php
session_start();

$servername = "localhost";
$username = "postgres";
$password = "Miskagi8282";
$dbname = "Kitcat";

$conn = pg_connect("host=$servername dbname=$dbname user=$username password=$password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT lapar, sehat, energi, senang FROM kucing WHERE user_id = $1";
$result = pg_query_params($conn, $sql, array($user_id));

if (pg_num_rows($result) > 0) {
    $row = pg_fetch_assoc($result);
    echo json_encode($row);
} else {
    echo json_encode(["lapar" => 100, "sehat" => 100, "energi" => 100, "senang" => 100]);
}

pg_close($conn);
?>