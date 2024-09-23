<?php
require_once('lib/db_login.php');
if (isset($_POST["submit"])) {
    $valid = TRUE;
    $name = test_input($_POST['name']) ?? "";

    // Validasi terhadap field name
    if ($name == '') {
        $error_name = "Name is required";
        $valid = FALSE;
    } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $error_name = "Only letters and white space allowed";
        $valid = FALSE;
    }

    $address = test_input($_POST['address']) ?? "";
    if ($address == "") {
        $error_address = "Address is required";
        $valid = FALSE;
    }

    $city = $_POST['city'];
    if ($city == '' || $city == 'none') {
        $error_city = "City is required";
        $valid = FALSE;
    }

    if ($valid) {
        $query = "INSERT INTO customers (name, address, city) VALUES (?, ?, ?)";
        $stmt = $db->prepare($query);

        if (!$stmt) {
            die("Gagal membuat query: " . $db->error);
        }

        $stmt->bind_param("sss", $name, $address, $city);

        if ($stmt->execute()) {
            echo "Data berhasil disimpan.";
            $db->close();
            header('Location: view_customer.php');
        } else {
            echo "Data gagal disimpan: " . $stmt->error;
        }
    }
}
?>
<?php include('./header.php') ?>
<br>
<div class="mt-4 card">
    <div class="card-header">Add Customers Data</div>
    <div class="card-body">
        <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" class="form-control" id="name" name="name" value="">
                <div class="error"><?php if (isset($error_name)) echo $error_name ?></div>
            </div>
            <div class="form-group">
                <label for="name">Address:</label>
                <textarea class="form-control" name="address" id="address" rows="5"></textarea>
                <div class="error"><?php if (isset($error_address)) echo $error_address ?></div>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <select name="city" id="city" class="form-control" required>
                    <option value="none" <?php if (!isset($city)) echo 'selected' ?>>--Select a city--</option>
                    <option value="Airport West" <?php if (isset($city) && $city == "Airport West") echo 'selected' ?>>Airport West</option>
                    <option value="Box Hill" <?php if (isset($city) && $city == "Box Hill") echo 'selected' ?>>Box Hill</option>
                    <option value="Yarraville" <?php if (isset($city) && $city == "Yarraville") echo 'selected' ?>>Yarraville</option>
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