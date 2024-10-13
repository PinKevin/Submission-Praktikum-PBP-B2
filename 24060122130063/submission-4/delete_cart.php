<!-- Nama: Keisya Intan Nabila
     NIM: 24060122130063
     Tanggal: Selasa, 24 September 2024
     Deskripsi: file untuk menghapus session, mengosongkan cart -->

<?php 
// TODO 1: Inisialisasi data session
session_start();
// TODO 2: Hapus session
if(isset($_SESSION['cart'])){
    unset($_SESSION['cart']);
}
// TODO 3: Redirect ke halaman show_cart.php
header('Location: show_cart.php');
?>