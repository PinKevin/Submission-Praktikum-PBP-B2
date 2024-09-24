<?php 

// Nama         : Zahra Nisaa' Fitria Nur'Afifah
// NIM          : 24060122140162
// Lab          : B2
// File         : view_books.php
// Deskripsi    : Untuk menampilkan daftar buku dari database


include('./header.php') ?>
<div class="card mt-5">
    <div class="card-header">Books Data</div>
    <div class="card-body">
        <table class="table table-striped">
            <tr>
                <th>ISBN</th>
                <th>Author</th>
                <th>Title</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            <?php
            // Include our login information
            require_once('./lib/db_login.php');

            // Check connection
            if ($db->connect_errno) {
                die("Could not connect to the database: <br />" . $db->connect_error);
            }

            // TODO 1: Tuliskan dan eksekusi query
            $query = "SELECT * FROM books";
            $result = $db->query($query);
            if (!$result) {
                die ("Could not query the database: <br />" . $db->error . "<br>Query: " . $query);
            }

            // Fetch and display the results
            if ($result->num_rows > 0) {
                $i = 1;
                while ($row = $result->fetch_object()) {
                    echo '<tr>';
                    echo '<td>' . $row->isbn . '</td>';
                    echo '<td>' . $row->author . '</td>';
                    echo '<td>' . $row->title . '</td>';
                    echo '<td>$' . $row->price . '</td>';
                    echo '<td><a class="btn btn-primary btn-sm" href="show_cart.php?id=' . $row->isbn . '">Add to Cart</a></td>';
                    echo '</tr>';
                    $i++;
                }
            } else {
                echo '<tr><td colspan="5">No books found</td></tr>';
            }
            ?>
        </table>
        <br />
        <?php
        echo 'Total Rows = ' . $result->num_rows;

        $result->free();
        $db->close();
        ?>
    </div>
</div>
<?php include('./footer.php') ?>