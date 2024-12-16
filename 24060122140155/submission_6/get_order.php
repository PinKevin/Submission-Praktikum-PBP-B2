<?php
require_once(__DIR__ . '/../lib/db_login.php');
$phone_number = $_GET['phone_number'];
if (isset($_GET['phone_number'])) {
    // Amankan input dengan real_escape_string
    $phone_number = $db->real_escape_string($_GET['phone_number']);
    echo "Phone Number: $phone_number<br>"; // Debugging Output

    // Query untuk mengambil pesanan sesuai nomor telepon
    $query = "SELECT * FROM orders WHERE phone_number = '$phone_number'";
    $result = $db->query($query);

    // Jika query gagal, tampilkan pesan error
    if (!$result) {
        die("Could not query the database: <br />" . $db->error);
    }

    // Debugging: Tampilkan jumlah baris yang ditemukan
    echo "Rows found: " . $result->num_rows . "<br>";

    // Cek apakah ada pesanan dengan nomor telepon yang diberikan
    if ($result->num_rows > 0) {
        echo 'Nomor telepon sudah digunakan.';
    } else {
        echo 'Nomor telepon tersedia.';
    }

    // Bebaskan hasil dan tutup koneksi
    $result->free();
    $db->close();
} else {
    echo 'Nomor telepon tidak diberikan.';
}
?>
// TODO: Buat query untuk mengambil pesanan sesuai nomor telepon

// TODO: Eksekusi query

// TODO: Buat respon gagal dan sukses
// Jika ada pesanan dengan nomor telepon yang diberikan, tampilkan pesan "Nomor telepon sudah digunakan" atau sejenisnya
// Jika tidak ada pesanan dengan nomor telepon yang diberikan, tampilkan pesan "Nomor telepon tersedia" atau sejenisnya
