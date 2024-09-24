<?php 

//Nama      : Zahra Nisaa' Fitria Nur'Afifah
//NIM       : 24060122140162
//Lab       : B2
//File      : logout.php
//Deskripsi : untuk logout (menghapus session yang dibuat saat login)

// TODO 1: Inisialisasi session
session_start();
// TODO 2: Hapus username session
if (isset($_SESSION['username'])) {
    unset($_SESSION['username']);
    session_destroy();
}
// TODO 3: Redirect ke halaman login
header('Location: login.php');
?>