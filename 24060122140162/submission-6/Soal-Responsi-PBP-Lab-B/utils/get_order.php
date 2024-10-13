<?php

//  Nama        : Zahra Nisaa' Fitria Nur'Afifah
//  NIM         : 24060122140162
//  File        : get_order.php


require_once(__DIR__ . '/../lib/db_login.php');
$phone_number = $_GET['phone_number'];

// TODO: Buat query untuk mengambil pesanan sesuai nomor telepon
$query = "SELECT * FROM orders WHERE phone_number = ?";


// TODO: Eksekusi query
$stmt = $db->prepare($query);
$stmt->bind_param("s", $phone_number);
$stmt->execute();
$result = $stmt->get_result();
// TODO: Buat respon gagal dan sukses
if ($result->num_rows > 0) {
    $response = array(
        "status" => "used",
        "message" => "Nomor telepon sudah dipakai"
    );
} else {
    $response = array(
        "status" => "available",
        "message" => "Nomor telepon tersedia"
    );
}
// Jika ada pesanan dengan nomor telepon yang diberikan, tampilkan pesan "Nomor telepon sudah digunakan" atau sejenisnya
// Jika tidak ada pesanan dengan nomor telepon yang diberikan, tampilkan pesan "Nomor telepon tersedia" atau sejenisnya
if ($result->num_rows > 0) {
    echo "Nomor telepon sudah digunakan";
} else {
    echo "Nomor telepon tersedia";
}


$stmt->close();
$db->close();
?>