<?php
require_once(__DIR__ . '/../lib/db_login.php');
$phone_number = $_GET['phone_number'];

// TODO: Buat query untuk mengambil pesanan sesuai nomor telepon
$query = "SELECT * FROM `orders` WHERE `phone_number` = '$phone_number'";
// TODO: Eksekusi query
$result = $db->query($query);
// TODO: Buat respon gagal dan sukses
if ($result->num_rows > 0) {
    echo "<span style='color: red;'>Nomor telepon sudah digunakan</span>";
} else {
    echo "<span style='color: green;'>Nomor telepon tersedia</span>";
}

$db->close();
// Jika ada pesanan dengan nomor telepon yang diberikan, tampilkan pesan "Nomor telepon sudah digunakan" atau sejenisnya
// Jika tidak ada pesanan dengan nomor telepon yang diberikan, tampilkan pesan "Nomor telepon tersedia" atau sejenisnya
