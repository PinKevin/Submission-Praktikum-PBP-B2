<?php

// File : admin.php
// Deskripsi: Halaman ini hanya dapat ditampilkan jika user telah login, jika belum akan
// di-redirect ke halaman login.php

session_start(); // Inisialisasi session

// Cek apakah user sudah login, jika tidak maka redirect ke halaman login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit(); // Penting untuk menghentikan eksekusi script setelah redirect
}

include('header.php');; ?>


<br>

<div class="card">
    <div class="card-header">Admin Page</div>
    <div class="card-body">
        <p>Welcome</p>
        <p>You are logged in as <b><?php echo $_SESSION['username']; ?></b></p> <!-- Perbaikan variabel $_SESSION -->
        <br><br>
        <a class="btn btn-primary" href="logout.php">Logout</a>
    </div>
</div>

<?php include('footer.php'); ?>
