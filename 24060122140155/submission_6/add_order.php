<?php
session_start();
require_once(__DIR__ . '/../lib/db_login.php');

$name = $db->real_escape_string($_POST['name']);
$phone = $db->real_escape_string($_POST['phone']);
$address = $db->real_escape_string($_POST['address']);
$brand = $db->real_escape_string($_POST['brand']);
$model = $db->real_escape_string($_POST['model']);
$color = $db->real_escape_string($_POST['color']);

//Asign a query
$query_brand= "SELECT brand_name FROM brands WHERE brand_code='$brand'";
$query_model= "SELECT model_name FROM models WHERE model_code='$model' AND brand_code='$brand'";
$result_brand = $db->query($query_brand);
$result_brand = $db->query($query_model);
$query_insert = "INSERT INTO orders (name, phone, address, brand_code, model_code, color) VALUES ('$name', '$phone', '$address', '$brand', '$brand', '$model', '$color')";
$result_insert= $db->query($query_insert);
if(!$result){
    echo '<div class="alert alert-danger alert-dismissible">
    <strong>Error!</strong>could not query the database<br>'.$db->error. '<br>query = '.$query.'</div>';
}else{
    echo '<div class="alert alert-success alert-dismissible">
    <strong>SUKSES!</strong>Data has been added.<br> 
    Name: '.$name.' <br>
    Phone: '.$phone.' <br>
    Address: '.$address.' <br>
    Brand: '.$brand.' <br>
    Model: '.$model.' <br>
    Color: '/$color.' <br>
    </div>';
}

$db->close();
exit;
?>
