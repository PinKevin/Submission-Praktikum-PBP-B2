<?php
session_start();
$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($id != "") {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }
}
?>

<!-- Menampilkan isi shopping cart -->
<?php include('./header.php') ?>
<br>
<div class="card">
    <div class="card-header">Shopping Cart</div>
    <div class="card-body">
        <table class="table table-striped">
            <tr>
                <th>ISBN</th>
                <th>Author</th>
                <th>Title</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>

            <?php
            require_once('./db_login.php');
            $sum_qty = 0;
            $sum_price = 0;

            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $id => $qty) {
                    $query = "SELECT * FROM books WHERE isbn='" . $id . "'";
                    $result = $db->query($query);
                    $sum_qty += $qty;

                    if (!$result) {
                        die("Could not query the database: <br>" . $db->error . "<br>Query: " . $query);
                    }

                    while ($row = $result->fetch_object()) {
                        echo '<tr>';
                        echo '<td>' . $row->isbn . '</td>';
                        echo '<td>' . $row->author . '</td>';
                        echo '<td>' . $row->title . '</td>';
                        echo '<td>Rp ' . number_format($row->price, 2) . '</td>';
                        echo '<td>' . $qty . '</td>';
                        echo '<td>Rp ' . number_format($row->price * $qty, 2) . '</td>';
                        echo '</tr>';
                        $sum_price += ($row->price * $qty);
                    }
                    $result->free();
                }
                $db->close();
            } else {
                echo '<tr><td colspan="6" align="center">Keranjang belanja Anda kosong. Mulailah berbelanja dan temukan buku-buku favorit Anda!</td></tr>';
            }
            ?>
        </table>
        <p>Total items: <?php echo $sum_qty; ?></p>
        <p>Total harga untuk semua item: Rp <?php echo number_format($sum_price, 2); ?></p>
        <a class="btn btn-primary" href="view_books.php">Continue Shopping</a>
        <a class="btn btn-danger" href="delete_cart.php">Empty Cart</a><br />
    </div>
</div>

<?php include('./footer.php') ?>