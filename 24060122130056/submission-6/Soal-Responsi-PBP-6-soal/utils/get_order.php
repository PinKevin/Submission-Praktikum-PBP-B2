<!-- get_order.php -->
<?php
require_once(__DIR__ . '/../lib/db_login.php');

$phone_number = $_GET['phone_number'];

// TODO: Buat query untuk mengambil pesanan sesuai nomor telepon
$query = "SELECT * FROM orders WHERE phone_number = '$phone_number'";
$result = $db->query($query);

if ($result->num_rows > 0) {
    echo "<div class='alert alert-error'>Nomor telepon sudah digunakan</div>";
} else {
    echo "<div class='alert alert-success'>Nomor telepon tersedia</div>";
}

$db->close();

?>