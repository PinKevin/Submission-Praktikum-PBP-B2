<?php 
// Nama         : Muhammad Rayyis Budi Prasetyo
// NIM          : 24060122140112
// Tanggal      : 13 desember 2024
// File         : logout.php
// Deskripsi    : Untuk logout (menghapus session yang dibuat saat login)

// TODO 1: Inisialisasi session
session_start();

// TODO 2: Hapus username session
if (isset($_SESSION['email'])) {
    unset($_SESSION['email']);
    session_destroy();
}

// TODO 3: Redirect ke halaman login
header('Location: login.php');
?>