<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "foods_db";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tableNumber = intval($_POST['tableNumber']);
$orderType = sanitize($_POST['order']);

function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
function insertOrder($itemName, $quantity, $tableNumber, $price, $orderType, $conn) {
    $stmt = $conn->prepare("INSERT INTO menu (item_name, quantity, table_number, price, `order`) VALUES (?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("siiis", $itemName, $quantity, $tableNumber, $price, $orderType);
        $stmt->execute();
        $stmt->close();
    } else {
        
        error_log("Statement preparation failed: " . $conn->error);
    }
}


foreach ($_POST['items'] as $itemName => $item) {
    $quantity = intval($item['quantity']);
    if ($quantity > 0) {
        $price = floatval($item['price']);
        insertOrder($itemName, $quantity, $tableNumber, $price, $orderType, $conn);
    }
}

$conn->close();

header("Location: menu.php");
exit();
?>
