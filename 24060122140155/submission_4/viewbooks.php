<?php
session_start(); // Memulai sesi

// Contoh data buku, Anda dapat menggantinya dengan data dari database
$books = [
    ['id' => 1, 'title' => 'Book One', 'price' => 10],
    ['id' => 2, 'title' => 'Book Two', 'price' => 15],
    ['id' => 3, 'title' => 'Book Three', 'price' => 20],
];

if (isset($_POST['add_to_cart'])) {
    $book_id = $_POST['book_id'];
    $book_title = $_POST['book_title'];
    $book_price = $_POST['book_price'];
    
    // Memastikan keranjang belanja ada
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // Menambahkan buku ke keranjang
    $_SESSION['cart'][$book_id] = [
        'title' => $book_title,
        'price' => $book_price,
        'quantity' => 1
    ];
}

include('./header.php'); // Memuat header
?>

<div class="container">
    <h2>Available Books</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?php echo $book['title']; ?></td>
                    <td><?php echo $book['price']; ?></td>
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                            <input type="hidden" name="book_title" value="<?php echo $book['title']; ?>">
                            <input type="hidden" name="book_price" value="<?php echo $book['price']; ?>">
                            <button type="submit" class="btn btn-success" name="add_to_cart">Add to Cart</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="show_cart.php" class="btn btn-primary">View Cart</a>
</div>

<?php include('./footer.php'); // Memuat footer ?>
