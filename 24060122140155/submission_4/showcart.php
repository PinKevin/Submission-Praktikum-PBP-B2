<?php
session_start(); // Memulai sesi

include('./header.php'); // Memuat header

// Memeriksa apakah keranjang belanja ada
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<div class='container'><h2>Your cart is empty!</h2></div>";
} else {
    ?>

    <div class="container">
        <h2>Your Cart</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cart'] as $book_id => $book): ?>
                    <tr>
                        <td><?php echo $book['title']; ?></td>
                        <td><?php echo $book['price']; ?></td>
                        <td><?php echo $book['quantity']; ?></td>
                        <td>
                            <a href="delete_cart.php?id=<?php echo $book_id; ?>" class="btn btn-danger">Remove</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="view_books.php" class="btn btn-primary">Continue Shopping</a>
    </div>

    <?php
}
include('./footer.php'); // Memuat footer
?>
