<?php
require_once('./lib/db_login.php'); // Menghubungkan ke database
include('./header.php'); // Menghubungkan header
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Search for Books</h1>
    <div class="mb-3">
        <input type="text" id="searchQuery" class="form-control" onkeyup="searchBooks()" placeholder="Search for books...">
    </div>
    <div id="results">
        <!-- Hasil pencarian akan muncul di sini dalam format tabel -->
    </div>
</div>

<?php include('./footer.php'); // Menghubungkan footer ?>
