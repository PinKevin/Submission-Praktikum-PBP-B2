

<?php include("./header.php")?>

<br>
<div class="card">
    <div class="card-header">Search Book</div>
    <div class="card-body">
        <input type="text" name="search-book" id="search-book" class="search-book" onkeyup="searchBookByTitle()">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ISBN</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Price</th>
                </tr>
            </thead>
            <br><br>
            <tbody id="display-result">
            <?php
                require_once('./lib/db_login.php');
                
                $query = "SELECT * FROM  books";

                $result = $db->query($query);

                if (!$result) {
                    die("Could not query the database: <br>".$db->error);
                }

                $i = 1;
                while ($row = $result->fetch_object()) {
                    echo "<tr>";
                        echo "<td>".$i."</td>";
                        echo "<td>".$row->isbn."</td>";
                        echo "<td>".$row->author."</td>";
                        echo "<td>".$row->title."</td>";
                        echo "<td>".$row->price."</td>";
                    echo "</tr>";
                    $i++;
                }

                $result->free();
                $db->close();

                ?>
            </tbody>
        </table>
    </div>
</div><br>
<?php include("./footer.php")?>