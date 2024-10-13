<?php
session_start();
require_once(__DIR__ . '/../lib/db_login.php');

$name = $db->real_escape_string($_POST['name']);
$phone = $db->real_escape_string($_POST['phone']);
$address = $db->real_escape_string($_POST['address']);
$brand = $db->real_escape_string($_POST['brand']);
$model = $db->real_escape_string($_POST['model']);
$color = $db->real_escape_string($_POST['color']);

// TODO: Tulis query untuk insert ke database
$query = "INSERT INTO orders (name, phone_number, address, color, brand_code, model_code) 
          VALUES ('$name', '$phone', '$address', '$color', '$brand', '$model')";

// TODO: Eksekusi query. Tangani jika sukses dan gagal
if ($db->query($query)) {
    echo "Sukses";
} else {
    echo "Gagal: " . $db->error;
}


$db->close();
exit;
?>