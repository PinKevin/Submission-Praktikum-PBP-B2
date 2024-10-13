<!-- Nama: Keisya Intan Nabila
     NIM: 24060122130063
     Tanggal: Selasa, 24 September 2024
     Deskripsi: file untuk logout -->

<?php 
// TODO 1: Inisialisasi session
session_start();
// TODO 2: Hapus username session
if(isset($_SESSION['username'])){
    unset($_SESSION['username']);
    session_destroy();
}
// TODO 3: Redirect ke halaman login
header('Location: login.php');
?>