<?php include('header.php') ?>
<div class="card mt-5">
    <div class="card-header">Books Data</div>
    <div class="card-body">
        <!-- Search Input -->
        <input type="text" id="searchTitle" placeholder="Search by Title" onkeyup="searchBooks()" class="form-control mb-3" />
        <div id="searchResults"></div>

            <?php
            // Include our login information
            require_once('./lib/db_login.php');

            // Fetch all books initially
            $query = "SELECT * FROM books ORDER BY isbn";
            $result = $db->query($query);
            if (!$result){
                die ("Could not query the database: <br />". $db->error ."<br>Query: ". $query);
            }

           

            $result->free();
            $db->close();
            ?>
    </div>
</div>
<?php include('footer.php') ?>
