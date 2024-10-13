<?php
//  Nama        : Zahra Nisaa' Fitria Nur'Afifah
//  NIM         : 24060122140162
//  File        : add_order.php

session_start();
require_once(__DIR__ . '/../lib/db_login.php');

$name = $db->real_escape_string($_POST['name']);
$phone = $db->real_escape_string($_POST['phone']);
$address = $db->real_escape_string($_POST['address']);
$brand = $db->real_escape_string($_POST['brand']);
$model = $db->real_escape_string($_POST['model']);
$color = $db->real_escape_string($_POST['color']);

// TODO: Tulis query untuk insert ke database
$query = "INSERT INTO orders (name, phone_number, address, brand_code, model_code, color) 
          VALUES ('$name', '$phone', '$address', '$brand', '$model', '$color')";

// Cek apakah semua field terisi
if (empty($name) || empty($phone) || empty($address) || empty($brand) || empty($model) || empty($color)) {
    echo "Isi semua kolom terlebih dahulu";
    exit;
}

// TODO: Eksekusi query. Tangani jika sukses dan gagal
if ($db->query($query) === TRUE) {
    echo "Sukses: Pesanan berhasil ditambahkan.";
} else {
    echo "Error: " . $db->error;
}

$db->close();
exit;
?>
