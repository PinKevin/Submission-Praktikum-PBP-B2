<?php
session_start(); // Memulai sesi
require_once('./lib/db_login.php');

// Memeriksa apakah pengguna telah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect ke login jika belum login
    exit;
}

// Cek apakah user adalah admin (ganti 'admin' dengan role sesuai di database Anda)
if ($_SESSION['username'] !== 'admin') {
    die("Access denied."); // Tampilkan pesan jika bukan admin
}

// Kode untuk menampilkan data pelanggan
// ...
?>
<!-- Tambahkan link logout -->
<a href="logout.php" class="btn btn-danger">Logout</a>
