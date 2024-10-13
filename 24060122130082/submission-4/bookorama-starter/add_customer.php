<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

require_once('lib/db_login.php');


if (isset($_POST["submit"])) {
    $valid = TRUE;

    // Validasi field name
    $name = test_input($_POST['name']);
    if ($name == '') {
        $error_name = "Name is required";
        $valid = FALSE;
    } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $error_name = "Only letters and white space allowed";
        $valid = FALSE;
    }

    // Validasi field address
    $address = test_input($_POST['address']);
    if ($address == '') {
        $error_address = "Address is required";
        $valid = FALSE;
    }

    // Validasi field city
    $city = $_POST['city'];
    if ($city == '' || $city == 'none') {
        $error_city = "City is required";
        $valid = FALSE;
    }

    // Insert data into database
    if ($valid) {
        // Escape input data
        $name = $db->real_escape_string($name);
        $address = $db->real_escape_string($address);
        $city = $db->real_escape_string($city);

        // Eksekusi query untuk menambahkan data
        $query = "INSERT INTO customers (name, address, city) VALUES ('$name', '$address', '$city')";
        $result = $db->query($query);
        if (!$result) {
            die("Couldn't query the database: <br />" . $db->error . '<br>Query: ' . $query);
        } else {
            header('Location: view_customer.php');
            exit();
        }
    }
}
?>

<?php include('./header.php') ?>
<br>
<div class="card mt-4">
    <div class="card-header">Add Customer Data</div>
    <div class="card-body">
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" autocomplete="on">
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= isset($name) ? $name : ''; ?>">
                <div class="error"><?php if (isset($error_name)) echo $error_name ?></div>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea class="form-control" name="address" id="address" rows="5"><?= isset($address) ? $address : ''; ?></textarea>
                <div class="error"><?php if (isset($error_address)) echo $error_address ?></div>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <select name="city" id="city" class="form-control" required>
                    <option value="none" selected>--Select a city--</option>
                    <option value="Airport West">Airport West</option>
                    <option value="Box Hill">Box Hill</option>
                    <option value="Yarraville">Yarraville</option>
                </select>
                <div class="error"><?php if (isset($error_city)) echo $error_city ?></div>
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
