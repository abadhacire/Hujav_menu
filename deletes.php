<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "foods_db";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['delete_item'])) {
        
        foreach ($_POST['delete_item'] as $item_json) {
            $item = json_decode($item_json, true);
            $sql = "DELETE FROM `foods` WHERE item = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $item['item']);
            $stmt->execute();
        }
        echo "Selected products deleted successfully.";
    } else {
        echo "No products selected for deletion.";
    }
}

$conn->close();
header("Location: delete.php");
exit();
?>
