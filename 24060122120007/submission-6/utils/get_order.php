<?php
require_once(__DIR__ . '/../lib/db_login.php');
$phone_number = $_GET['phone_number'];

$query = "SELECT * FROM `orders` WHERE `phone_number` = '$phone_number'";
$result = $db->query($query);

// TODO: Eksekusi query
if ($result->num_rows > 0) {
    echo "Nomor telepon sudah digunakan";
} else {
    echo "Nomor telepon tersedia";
}

$db->close();
