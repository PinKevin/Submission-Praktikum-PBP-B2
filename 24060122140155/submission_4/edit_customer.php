<?php
require_once('./lib/db_login.php');
$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($id === '') {
    die("ID tidak ditemukan");
}

$name = $address = $city = '';
$error_name = $error_address = $error_city = '';

if (!isset($_POST["submit"])) {
    $query = "SELECT * FROM customers WHERE customerid=" . $id;
    $result = $db->query($query);
    
    if (!$result) {
        die("Could not query the database: <br/>" . $db->error);
    } else {
        $row = $result->fetch_object();
        if ($row) {
            $name = $row->name;
            $address = $row->address;
            $city = $row->city;
        } else {
            die("Customer not found.");
        }
    }
} else {
    $valid = TRUE;
    $name = test_input($_POST['name']);
    if ($name == '') {
        $error_name = "Name is required";
        $valid = FALSE;
    }
    $address = test_input($_POST['address']);
    if ($address == '') {
        $error_address = "Address is required";
        $valid = FALSE;
    }
    $city = $_POST['city'];
    if ($city == '' || $city == 'none') {
        $error_city = "City is required";
        $valid = FALSE;
    }

    if ($valid) {
        $query = "UPDATE customers SET name='$name', address='$address', city='$city' WHERE customerid=" . $id;
        $result = $db->query($query);
        if (!$result) {
            die("Could not query the database: <br/>" . $db->error);
        } else {
            header('Location: view_customer.php');
            exit;
        }
    }
}

include('./header.html');
?>

<div class="container">
    <h2>Edit Customer</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
            <div class="error"><?php if (isset($error_name)) echo $error_name; ?></div>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>">
            <div class="error"><?php if (isset($error_address)) echo $error_address; ?></div>
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <select name="city" id="city" class="form-control">
                <option value="none" <?php if ($city == '' || $city == 'none') echo 'selected="selected"'; ?>> --Select a City--</option>
                <option value="Airport West" <?php if ($city == "Airport West") echo 'selected="selected"'; ?>>Airport West</option>
                <option value="Box Hill" <?php if ($city == "Box Hill") echo 'selected="selected"'; ?>>Box Hill</option>
                <option value="Yarraville" <?php if ($city == "Yarraville") echo 'selected="selected"'; ?>>Yarraville</option>
            </select>
            <div class="error"><?php if (isset($error_city)) echo $error_city; ?></div>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Update</button>
        <a href="view_customer.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php
$db->close();
include('./footer.html');
?>
