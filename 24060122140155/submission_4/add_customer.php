<?php
require_once('./lib/db_login.php');
$name = $address = $city = '';
$error_name = $error_address = $error_city = '';

if (isset($_POST["submit"])) {
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
        $query = "INSERT INTO customers (name, address, city) VALUES ('$name', '$address', '$city')";
        $result = $db->query($query);
        if (!$result) {
            die("Could not query the database: <br/>" . $db->error);
        } else {
            header('Location: view_customer.php');
            exit;
        }
    }
}

include('./header.php');
?>

<div class="container">
    <h2>Add Customer</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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
                <option value="none"> --Select a City--</option>
                <option value="Airport West">Airport West</option>
                <option value="Box Hill">Box Hill</option>
                <option value="Yarraville">Yarraville</option>
            </select>
            <div class="error"><?php if (isset($error_city)) echo $error_city; ?></div>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Add Customer</button>
        <a href="view_customer.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php
$db->close();
include('./footer.php');
?>
