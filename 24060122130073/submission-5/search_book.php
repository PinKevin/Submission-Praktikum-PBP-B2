<?php
// File         : search_book.php
// Deskripsi    : Untuk mencari buku berdasarkan judul

require_once('./lib/db_login.php');

// Tutup koneksi database setelah query
$db->close();

?>

<?php include('./header.php') ?>

<div class="row w-50 mx-auto">
    <div class="col">
        <div class="card mt-4">
            <div class="card-header">Pencarian Buku</div>
            <div class="card-body">
                <form method="GET" autocomplete="on">
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Buku:</label>
                        <input type="text" class="form-control" id="title" name="title">
                        <div class="text-danger small">
                            <p><?php if (isset($title_error)) echo $title_error ?></p>
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary" onclick="get_book()">Cari Buku</button>
                </form>
                <br>
                <div id="bookDetails"></div> <!-- Tempat untuk menampilkan hasil pencarian buku -->
            </div>
        </div>
    </div>
</div>

<script src="ajax.js"></script>

<?php include('./footer.php') ?>
