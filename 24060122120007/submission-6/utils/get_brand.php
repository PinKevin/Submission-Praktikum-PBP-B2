<?php
require_once(__DIR__ . '/../lib/db_login.php');

// TODO: Buat query untuk mengambil merek mobil

// TODO: Eksekusi query
$query= " SELECT * FROM brands ORDER BY brand_name";
$result = $db->query($query);

// TODO: Buat respon gagal dan sukses
// Jika gagal, tampilkan pesan error
if (!$result) {
    die("Could not query the database: <br>" . $db->error);
}
// Jika sukses, buat option untuk select
while($row = $result->fetch_object()){
    echo '<option value="'.$row->brand_code.'">'.$row->brand_name.'</option>';
}
// TODO 4: Dealokasi variabel dan tutup koneksi database
$result->free();
$db->close();
