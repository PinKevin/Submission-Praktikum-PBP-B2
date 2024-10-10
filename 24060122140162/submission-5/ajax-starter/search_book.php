<!--  
Nama        : Zahra Nisaa' Fitria Nur'Afifah
NIM         : 24060122140162
File        : search_book.php
Deskripsi   : Melakukan pencarian buku (live search) dengan memasukkan judul buku yang diinginkan dan menjalankan fungsi ajax -->

<?php
include('./header.php');
require_once('./lib/db_login.php');

// AJAX request handler
if (isset($_GET['ajax']) && $_GET['ajax'] == 1) {
    $term = isset($_GET['term']) ? $db->real_escape_string($_GET['term']) : '';
    
    if (!empty($term)) {
        $query = "SELECT * FROM books WHERE title LIKE '%$term%' ORDER BY title";
        $result = $db->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                echo "<p><strong>Title:</strong> " . htmlspecialchars($row->title) . "</p>";
                echo "<p><strong>Author:</strong> " . htmlspecialchars($row->author) . "</p>";
                echo "<p><strong>ISBN:</strong> " . htmlspecialchars($row->isbn) . "</p>";
                echo "<hr>";
            }
        } else {
            echo "<p>No books found matching your search.</p>";
        }

        $result->free();
    } else {
        echo "<p>Please enter a search term.</p>";
    }
    
    $db->close();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Book</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Search Book</h2>
        <form id="searchForm" class="mb-4">
            <div class="input-group">
                <input type="text" id="searchTerm" name="searchTerm" class="form-control" placeholder="Enter book title...">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </form>
        <div id="searchResults">
            <!-- Results will be displayed here -->
        </div>
    </div>

    <script src="ajax.js"></script>
</body>
</html>

<?php include('./footer.php'); ?>