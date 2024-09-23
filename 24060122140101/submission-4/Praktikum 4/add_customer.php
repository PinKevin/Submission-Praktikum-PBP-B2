<?php
session_start(); // Mulai session
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Koneksi ke database
require_once('./lib/db_login.php');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = TRUE;
    $name = test_input($_POST['name']);
    $address = test_input($_POST['address']);
    $city = $_POST['city'];

    if ($name == '') {
        $error_name = "Name is required";
        $valid = FALSE;
    }
    if ($valid) {
        $query = "INSERT INTO customers (name, address, city) VALUES ('".$db->real_escape_string($name)."', '".$db->real_escape_string($address)."', '".$db->real_escape_string($city)."')";
        $result = $db->query($query);
        if ($result) {
            header('Location: view_customer.php');
            exit();
        } else {
            echo "Error: Could not insert data: " . $db->error;
        }
    }
}
?>

<?php include('./header.php'); ?>
<div class="container">
    <h2>Add Customer</h2>
    <form method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <textarea class="form-control" id="address" name="address" required></textarea>
        </div>
        <div class="form-group">
            <label for="city">City:</label>
            <select class="form-control" id="city" name="city" required>
                <option value="Airport West">Airport West</option>
                <option value="Box Hill">Box Hill</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top: 20px;" >Submit</button>
        <a href="view_customer.php" class="btn btn-secondary" style="margin-top: 20px;">Cancel</a>
    </form>
</div>
<?php include('./footer.php'); ?>
