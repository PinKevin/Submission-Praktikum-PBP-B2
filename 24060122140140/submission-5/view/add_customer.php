<?php  

require_once('../lib/db_login.php');
$id = $name = $address = $city = "";

if (!isset($_POST['submit'])) {
  $query = "SELECT MAX(customerid) AS id FROM customers";
  $result = $db->query($query);
  if (!$result) {
    die ("Could not query the database: <br>".$db->error."<br>Query: ".$query);
  } 
} else { 
  $valid = TRUE; // validation flag
  $name = test_input($_POST['name']);
  if ($name == '') {
    $error_name = "Name is required";
    $valid = FALSE;
  } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
    $error_name = "Only letters and white space allowed";
    $valid = FALSE;
  }

  $address = test_input($_POST['address']);
  if ($address == '') {
    $error_address = "Address is required";
    $valid = FALSE;
  } 

  $city = test_input($_POST['city']);
  if ($city == '' || $city == 'none') {
      $error_city = "City is required";
      $valid = FALSE;
  }

  // insert data to database
  if ($valid) {
    $address = $db->real_escape_string($address);

    // assign query
    $query = "INSERT INTO customers (name, address, city) values ('".
              $name."', '".$address."', '".$city."')";
    // execute query
    $result = $db->query($query);
    if (!$result) {
      die ("Could not query the database: <br>".$db->error."<br>Query: ".$query);
    } else {
      header('Location: view_customer.php');
    }
  }
}

?>

<?php include('./header.php'); ?>
 <br>
 <div class="card col-md-4 mx-auto">
    <div class="card-header">Edit Customer Data</div>
    <div class="card-body">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?id='.$id; ?>" 
    method="post" autocomplete="on">
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" class="form-control"
            value="<?php echo $name; ?>">
            <div class="error"><?php if(isset($error_name)) echo $error_name; ?></div>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea rows="5" class="form-control" id="address" name="address"><?php echo $address; ?></textarea>
            <div class="error"><?php if(isset($error_address)) echo $error_address; ?></div>
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <select name="city" id="city" class="form-control" required>
                <option value="none" <?php if(!isset($city)) echo 'selected="true"'; ?>>
                --Select a city--</option>
                <option value="Airport West" <?php if(isset($city) && $city=="Airport West") 
                echo 'selected="true"'; ?>>Airport West</option>
                <option value="Box Hill" <?php if(isset($city) && $city=="Box Hill") 
                echo 'selected="true"'; ?>>Box Hill</option>
                <option value="Yarraville" <?php if(isset($city) && $city=="Yarraville") 
                echo 'selected="true"'; ?>>Yarraville</option>
            </select>
            <div class="error"><?php if(isset($error_city)) echo $error_city; ?></div>
        </div>
        <br>
        <button type="button" class="btn btn-primary" onclick="add_customer_get()">
          Add Get
        </button>
        <button type="button" class="btn btn-primary" onclick="add_customer_post()">
          Add Post
        </button>
        <a href="../" class="btn btn-danger">Cancel</a>
    </form>
    <br>
    <div id="add_response"></div>
    </div>
 </div>
 <?php include('./footer.php'); ?>
 <?php 
 $db->close();
?>