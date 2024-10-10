<?php
require_once(__DIR__ . '/../lib/db_login.php');

// TODO: Buat query untuk mengambil merek mobil
$sql = "SELECT * FROM brands ORDER BY brand_code, brand_name";
// TODO: Eksekusi query
$result = $db->query($sql);
if (!$result){
    die("could not query the database: <br/>". $db->error);
}
while ($row = $result->fetch_object()) {
    echo '<option value="'.$row->brands.'">'.$row->brand_code.'">'.$row->brand_name.'</option>';
}
$result->free();
$db->close();
?>

//TODO: Jika gagal, tampilkan pesan error

// TODO: Buat respon gagal dan sukses
// Jika gagal, tampilkan pesan error
// Jika sukses, buat option untuk select
