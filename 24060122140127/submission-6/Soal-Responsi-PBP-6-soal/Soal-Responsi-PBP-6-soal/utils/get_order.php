<?php
require_once(__DIR__ . '/../lib/db_login.php');
$phone_number = $_GET['phone_number'];

// TODO: Buat query untuk mengambil pesanan sesuai nomor telepon
$query = "SELECT * FROM `orders` WHERE `phone_number` = '$phone_number'";
$result = $db->query($query);

// TODO: Eksekusi query
if ($result->num_rows > 0) {
    echo "<span style='color: red;'>Nomor telepon sudah digunakan</span>";
} else {
    echo "<span style='color: green;'>Nomor telepon tersedia</span>";
}


$db->close();


// TODO: Buat respon gagal dan sukses
// Jika ada pesanan dengan nomor telepon yang diberikan, tampilkan pesan "Nomor telepon sudah digunakan" atau sejenisnya
// Jika tidak ada pesanan dengan nomor telepon yang diberikan, tampilkan pesan "Nomor telepon tersedia" atau sejenisnya
