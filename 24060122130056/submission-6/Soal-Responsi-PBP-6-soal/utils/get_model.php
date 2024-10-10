<?php
require_once(__DIR__ . '/../lib/db_login.php');

$brand_code = $_GET['brand_code'] ?? '';

$query = "SELECT * FROM models WHERE brand_code = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("s", $brand_code);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<option value='" . htmlspecialchars($row['model_code']) . "'>" . htmlspecialchars($row['model_name']) . "</option>";
  }
} else {
  echo "<option value=''>Model tidak tersedia</option>";
}

$stmt->close();
$db->close();
?>