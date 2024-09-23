<?php
// File: show_cart.php
// Deskripsi: Untuk menambahkan item ke shopping cart dan menampilkan isi shopping cart

session_start();
error_reporting(0);

// Memeriksa apakah ada parameter id untuk menambahkan item ke cart
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Cek jika id ada, maka tambahkan buku ke keranjang
if ($id != '') {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Jika buku sudah ada di keranjang, tambahkan kuantitasnya, jika belum ada, set kuantitas menjadi 1
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }

    // Setelah menambah buku, lakukan redirect untuk menghapus parameter id dari URL agar tidak menambah item saat refresh
    header('Location: show_cart.php');
    exit();
}
?>
<?php include('./header.php') ?>
<br>
<div class="card mt-4">
    <div class="card-header">Shopping Cart</div>
    <div class="card-body">
        <br>

        <!-- Membuat kontainer tabel scrollable -->
        <div style="max-height: 400px; overflow-y: auto;">
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
                require_once('./lib/db_login.php');
                $sum_qty = 0;
                $sum_price = 0;

                // Memeriksa apakah ada item di keranjang
                if (is_array($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                    foreach ($_SESSION['cart'] as $id => $qty) {
                        // Query untuk mendapatkan detail buku berdasarkan ISBN
                        $query = "SELECT * FROM books WHERE isbn='" . $db->real_escape_string($id) . "'";
                        $result = $db->query($query);

                        if (!$result) {
                            die("Could not query the database: <br>" . $db->error);
                        }

                        while ($row = $result->fetch_object()) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row->isbn) . '</td>';
                            echo '<td>' . htmlspecialchars($row->author) . '</td>';
                            echo '<td>' . htmlspecialchars($row->title) . '</td>';
                            echo '<td>$' . number_format($row->price, 2) . '</td>';
                            echo '<td>' . $qty . '</td>';
                            echo '<td>$' . number_format($row->price * $qty, 2) . '</td>';
                            echo '</tr>';

                            $sum_qty += $qty;
                            $sum_price += ($row->price * $qty);
                        }
                        $result->free();
                    }
                    echo '<tr><td colspan="5" align="right"><strong>Total Price:</strong></td><td>$' . number_format($sum_price, 2) . '</td></tr>';
                    $db->close();
                } else {
                    echo '<tr><td colspan="6" align="center">There is no item in shopping cart</td></tr>';
                }
                ?>
            </table>
        </div>

        <!-- Informasi total item -->
        Total items: <?php echo $sum_qty ?><br><br>
        <a class="btn btn-primary" href="view_books.php">Continue Shopping</a>
        <a class="btn btn-danger" href="delete_cart.php">Empty Cart</a>
    </div>
</div>
<?php include('./footer.php') ?>
