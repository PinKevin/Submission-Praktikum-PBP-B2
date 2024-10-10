<?php
//  Nama        : Zahra Nisaa' Fitria Nur'Afifah
//  NIM         : 24060122140162
//  File        : get_brand.php

require_once(__DIR__ . '/../lib/db_login.php');

// TODO: Buat query untuk mengambil merek mobil
$query = "SELECT brand_code, brand_name FROM brands ORDER BY brand_name";
// TODO: Eksekusi query
try {
    $result = $db->query($query);
// TODO: Buat respon gagal dan sukses
// Jika gagal, tampilkan pesan error
// Jika sukses, buat option untuk select
if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['brand_code'] . "'>" . htmlspecialchars($row['brand_name']) . "</option>";
    }
} else {
    echo "<option value=''>Error: Tidak dapat mengambil data merek</option>";
}
} catch (Exception $e) {
echo "<option value=''>Error: " . $e->getMessage() . "</option>";
}

// Tutup koneksi database
$db->close();
?>