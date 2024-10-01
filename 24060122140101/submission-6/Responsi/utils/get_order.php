<?php
require_once(__DIR__ . '/../lib/db_login.php');
$phone_number = $_GET['phone_number'];

// Query untuk mengecek apakah nomor telepon sudah digunakan
$query = "SELECT * FROM orders WHERE phone_number = '$phone_number'";
$result = $db->query($query);

// Cek apakah ada pesanan dengan nomor telepon yang sama
if ($result->num_rows > 0) {
    echo "<span class='text-danger'>Nomor telepon sudah digunakan</span>";
} else {
    echo "<span class='text-success'>Nomor telepon tersedia</span>";
}

$db->close();
?>

