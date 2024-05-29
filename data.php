<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "foods_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$itemName = $_POST['itemName'] ?? null;
$itemPrice = $_POST['itemPrice'] ?? null;
$itemImage = $_POST['itemImage'] ?? null;
$descriptions = $_POST['descriptions'] ?? null;

echo "Received data: <br>";
echo "Item Name: " . htmlspecialchars($itemName) . "<br>";
echo "Item Price: " . htmlspecialchars($itemPrice) . "<br>";
echo "Item Image: " . htmlspecialchars($itemImage) . "<br>";
echo "descriptions: " . htmlspecialchars($descriptions) . "<br>";

$sql = "INSERT INTO `foods` (item, price, image_path, descriptions) VALUES ('$itemName', '$itemPrice', '$itemImage', '$descriptions')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: received.php");
exit();
?>
