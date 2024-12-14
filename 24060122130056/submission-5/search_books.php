<?php include('./header.php') ?>

<div class="container mt-4">
    <h2>Search Book</h2>
    <div class="mb-3">
        <input type="text" id="book_title" class="form-control" placeholder="Enter book title" />
    </div>
    <button class="btn btn-primary" onclick="get_book()">Search</button>
    
    <div id="search_results" class="mt-3"></div>
</div>

<script>

function get_book() {
    var title = document.getElementById('book_title').value; // Ambil nilai judul dari input
    var xmlhttp = getXMLHTTPRequest();
    
    // Cek jika judul tidak kosong
    if (title.trim() !== "") {
        var url = "search_books.php?title=" + encodeURIComponent(title); // Encode judul untuk URL
        xmlhttp.open('GET', url, true);
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                // Menampilkan hasil di elemen HTML
                document.getElementById('search_results').innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.send();
    } else {
        alert("Please enter a book title.");
    }
}

// Jika ada query string 'title', ambil data buku
if (window.location.search.indexOf('title=') > -1) {
    var urlParams = new URLSearchParams(window.location.search);
    var title = urlParams.get('title');

    // Menampilkan hasil pencarian di halaman yang sama
    if (title) {
        get_book(); // Panggil fungsi get_book untuk menampilkan hasil
    }
}
</script>

<?php
if (isset($_GET['title'])) {
    // Koneksi ke database
    require_once('./lib/db_login.php');

    $book_title = $_GET['title'];

    // Gunakan prepared statement untuk query
    $query = $db->prepare("SELECT * FROM books WHERE title LIKE ?");
    $searchTerm = '%' . $book_title . '%'; // Menambahkan wildcard untuk pencarian
    $query->bind_param("s", $searchTerm);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_object()) {
            echo '<div class="card mt-2">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $row->title . '</h5>';
            echo '<p class="card-text">ISBN: ' . $row->isbn . '</p>';
            echo '<p class="card-text">Author: ' . $row->author . '</p>';
            echo '<p class="card-text">Price: ' . $row->price . '</p>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "<p>No books found.</p>";
    }

    $result->free();
    $query->close();
    $db->close();
}
?>

<?php include('./footer.php') ?>
