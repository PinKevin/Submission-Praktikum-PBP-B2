<?php
require_once(__DIR__ . '/../lib/db_login.php');
$phone_number = $_GET['phone_number'] ?? '';

if (isset($phone_number) && !empty($phone_number)) {
// TODO: Buat query untuk mengambil pesanan sesuai nomor telepon
    $query = "SELECT * FROM orders WHERE phone_number = ?";

// TODO: Buat respon gagal dan sukses
// Jika ada pesanan dengan nomor telepon yang diberikan, tampilkan pesan "Nomor telepon sudah digunakan" atau sejenisnya
// Jika tidak ada pesanan dengan nomor telepon yang diberikan, tampilkan pesan "Nomor telepon tersedia" atau sejenisnya
    if ($stmt = $db->prepare($query)) {
        $stmt->bind_param('s', $phone_number);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo "Nomor telepon sudah digunakan";
        } else {
            echo "Nomor telepon tersedia";
        }
        $stmt->close();
    } else {
        die("Could not prepare the query: <br>" . $db->error);
    }
} else {
    echo "Nomor telepon tidak valid";
}
$db->close();
?>

