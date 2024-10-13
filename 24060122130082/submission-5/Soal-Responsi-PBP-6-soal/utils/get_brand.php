<?php
require_once(__DIR__ . '/../lib/db_login.php');

// TODO: Buat query untuk mengambil merek mobil
$query = "SELECT * FROM brands"; 
$result = mysqli_query($connect, $query);
$output .= '<option value="">--Pilih Merek--</option>';

// TODO: Eksekusi query
while($row = mysqli_fetch_array($result))
{
 $output .= '<option value="'.$row["brand_name"].'">'.$row["brand_name"].'</option>';
}



// TODO: Buat respon gagal dan sukses
// Jika gagal, tampilkan pesan error
// Jika sukses, buat option untuk select
