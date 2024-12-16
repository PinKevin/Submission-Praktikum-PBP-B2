<?php
session_start();
require_once('./lib/db_login.php');
$servername ='localhost';
$username ='root';
$password = 'fefefwd2qe3r134rr3r3r3@#$%';
$dbname = 'bookrama';

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}
function getBookDetails($isbn){
    global $conn;
    $sql = "SELECT b.isbn, b.author, b.title, b.price, br.review FROM books b LEFT JOIN book_reviews br ON b.isbn = br.isbn WHERE b.isbn =?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $isbn);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            echo "ISBN: " . $row["isbn"] . "<br>";
            echo "Author: " . $row["author"] . "<br>";
            echo "Title: " . $row["title"] . "<br>";
            echo "Price: $" . number_format($row["price"], 2) . "<br>";
            echo "Review: " . ($row["review"] ? $row["review"] : "No review available") . "<br><br>";

        }
    }else{
        echo "No book found with ISBN: " . $isbn;
 
    }
    $stmt->close();

}
$isbn = "0-672-31697-8"; 
getBookDetails($isbn);

$conn->close();


?>