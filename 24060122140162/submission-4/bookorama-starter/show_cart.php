<?php

// Nama         : Zahra Nisaa' Fitria Nur'Afifah
// NIM          : 24060122140162
// Lab          : B2
// File         : show_cart.php
// Deskripsi    : Untuk menambahkan item ke shopping cart dan menampilkan isi shopping cart

session_start();

$id = $_GET['id'] ?? '';
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
<?php include('./header.php') ?>
<br>
<div class="card mt-4">
    <div class="card-header">Shopping Cart</div>
    <div class="card-body">
        <br>
        <table class="table table-striped">
            <tr>
                <th>ISBN</th>
                <th>Author</th>
                <th>Title</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Price * Qty</th>
            </tr>
            <?php
            require_once('./lib/db_login.php');
            $sum_qty = 0;
            $sum_price = 0;

            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $id => $qty) {
                    // TODO 1: Tuliskan dan eksekusi query
                    $query = "SELECT * FROM books WHERE isbn = '" . $db->real_escape_string($id) . "'";
                    $result = $db->query($query);
                    if (!$result) {
                        die("Could not query the database: <br />" . $db->error . "<br>Query: " . $query);
                    }

                    $row = $result->fetch_object();
                    echo '<tr>';
                    echo '<td>' . $row->isbn . '</td>';
                    echo '<td>' . $row->author . '</td>';
                    echo '<td>' . $row->title . '</td>';
                    echo '<td>$' . $row->price . '</td>';
                    echo '<td>' . $qty . '</td>';
                    echo '<td>$' . $row->price * $qty . '</td>';
                    echo '</tr>';

                    $sum_qty += $qty;
                    $sum_price += ($row->price * $qty);
                }
                echo '<tr><td colspan="4" align="right"><strong>Total</strong></td>';
                echo '<td><strong>' . $sum_qty . '</strong></td>';
                echo '<td><strong>$' . number_format($sum_price, 2) . '</strong></td></tr>';
                
                $result->free();
                $db->close();
            } else {
                echo '<tr><td colspan="6" align="center">There is no item in shopping cart</td></tr>';
            }
            ?>
        </table>
        <br>
        <a class="btn btn-primary" href="view_books.php">Continue Shopping</a>
        <a class="btn btn-danger" href="delete_cart.php">Empty Cart</a>
    </div>
</div>
<?php include('./footer.php') ?>