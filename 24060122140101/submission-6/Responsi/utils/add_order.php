<?php
session_start();
require_once(__DIR__ . '/../lib/db_login.php');

$name = $db->real_escape_string($_POST['name']);
$phone = $db->real_escape_string($_POST['phone_number']); 
$address = $db->real_escape_string($_POST['address']);
$brand = $db->real_escape_string($_POST['brand']);
$model = $db->real_escape_string($_POST['model']);
$color = $db->real_escape_string($_POST['color']);

// Cek apakah nomor telepon sudah digunakan
$check_query = "SELECT * FROM orders WHERE phone_number = '$phone'";
$check_result = $db->query($check_query);

if ($check_result->num_rows > 0) {
    // Jika sudah ada, simpan pesan error dan redirect
    $_SESSION['error_message'] = "Nomor telepon sudah digunakan!";
    header("Location: ../index.php");
    exit();
}

// Query untuk memasukkan pesanan
$query = "INSERT INTO orders (name, phone_number, address, color, brand_code, model_code)
VALUES ('$name', '$phone', '$address', '$color', '$brand', '$model')";

if ($db->query($query) === TRUE) {
    $_SESSION['success_message'] = "Pesanan berhasil ditambahkan!";
} else {
    $_SESSION['error_message'] = "Gagal menambahkan pesanan: " . $db->error;
}

// Redirect kembali ke halaman form
header("Location: ../index.php");
exit();
?>
