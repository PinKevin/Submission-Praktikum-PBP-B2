<?php
require_once(__DIR__ . '/../lib/db_login.php');
$phone_number = $_GET['phone_number'];

// TODO: Buat query untuk mengambil pesanan sesuai nomor telepon
$query = "SELECT * FROM orders WHERE phone_number =".$phone_number;
// TODO: Eksekusi query
$result = $db->query($query);
if(!$result){
    die("Could not query the database: <br>" .  $db->error);
}
// TODO: Buat respon gagal dan sukses
// Jika ada pesanan dengan nomor telepon yang diberikan, tampilkan pesan "Nomor telepon sudah digunakan" atau sejenisnya
// Jika tidak ada pesanan dengan nomor telepon yang diberikan, tampilkan pesan "Nomor telepon tersedia" atau sejenisnya
if($result -> num_rows > 0){
    echo "Nomor telepon sudah digunakan";
}
else{
    echo '<div class "alert alert-success">Nomor telepon tersedia</div>';
}