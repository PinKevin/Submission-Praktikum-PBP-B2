<?php
session_start(); // Mulai session
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>

<?php
// File: edit_customer.php
// Deskripsi: Untuk mengedit data customer

// Lakukan koneksi dengan database
require_once('./lib/db_login.php');

// Buat variabel $id yang diambil dari query string parameter
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id === null) {
    die("Customer ID is missing.");
}

// Memeriksa apakah user belum menekan tombol submit
if (!isset($_POST["submit"])) {
    // Query untuk mengambil informasi customer berdasarkan id
    $query = "SELECT * FROM customers WHERE customerid = " . $db->real_escape_string($id);
    $result = $db->query($query);

    if (!$result) {
        die("Could not query the database: <br />" . $db->error);
    } else {
        // Fetching the customer data
        $row = $result->fetch_object();
        if ($row) {
            $name = $row->name;
            $address = $row->address;
            $city = $row->city;
        } else {
            die("No customer found with the given ID.");
        }
    }
} else {
    $valid = TRUE;
    $name = test_input($_POST['name']);

    // Validasi terhadap field name
    if ($name == '') {
        $error_name = "Name is required";
        $valid = FALSE;
    } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $error_name = "Only letters and white space allowed";
        $valid = FALSE;
    }

    // Validasi terhadap field address
    $address = test_input($_POST['address']);
    if ($address == '') {
        $error_address = "Address is required";
        $valid = FALSE;
    }

    // Validasi terhadap field city
    $city = $_POST['city'];
    if ($city == '' || $city == 'none') {
        $error_city = "City is required";
        $valid = FALSE;
    }

    // Update data into database
    if ($valid) {
        // Update data pada database
        $query = "UPDATE customers SET name='" . $db->real_escape_string($name) . "', address='" . $db->real_escape_string($address) . "', city='" . $db->real_escape_string($city) . "' WHERE customerid=" . $db->real_escape_string($id);
        $result = $db->query($query);

        if (!$result) {
            die("Could not query the database: <br />" . $db->error . '<br>Query: ' . $query);
        } else {
            $db->close();
            header('Location: view_customer.php');
            exit;
        }
    }
}
?>
<?php include('./header.php') ?>
<br>
<div class="card mt-4">
    <div class="card-header">Edit Customers Data</div>
    <div class="card-body">
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . $id ?>" method="POST" autocomplete="on">
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= isset($name) ? htmlspecialchars($name) : ''; ?>">
                <div class="error"><?php if (isset($error_name)) echo $error_name; ?></div>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea class="form-control" name="address" id="address" rows="5"><?php echo isset($address) ? htmlspecialchars($address) : ''; ?></textarea>
                <div class="error"><?php if (isset($error_address)) echo $error_address; ?></div>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <select name="city" id="city" class="form-control" required>
                    <option value="none" <?php if (!isset($city)) echo 'selected'; ?>>--Select a city--</option>
                    <option value="Airport West" <?php if (isset($city) && $city == "Airport West") echo 'selected'; ?>>Airport West</option>
                    <option value="Box Hill" <?php if (isset($city) && $city == "Box Hill") echo 'selected'; ?>>Box Hill</option>
                    <option value="Yarraville" <?php if (isset($city) && $city == "Yarraville") echo 'selected'; ?>>Yarraville</option>
                </select>
                <div class="error"><?php if (isset($error_city)) echo $error_city; ?></div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
            <a href="view_customer.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
<?php include('./footer.php') ?>
<?php
$db->close();
?>
