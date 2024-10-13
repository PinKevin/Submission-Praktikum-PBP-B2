
<?php
// require_once(_DIR_ . '/../lib/db_login.php');
require_once(__DIR__ . '/../lib/db_login.php');

$brand_name = $_GET['brand'];
// TODO: Buat query untuk mengambil merek mobil
$query = "SELECT * FROM brands ORDER BY brand_name";

// TODO: Eksekusi query
$result = $db->query($query);

if (!$result) {
    die("Could not query the database: <br>" . $db->error);
}

while ($row = $result->fetch_object()) {
        echo '<option value="' . $row->brand_code . '">' . $row->brand_name . '</option>';
    }

$result->free();
$db->close();

// Jika gagal, tampilkan pesan error
// Jika sukses, buat option untuk select