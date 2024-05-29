<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "foods_db";
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT item_name, quantity, table_number, price, `order` FROM menu";
$result = $conn->query($sql);

$receipt = "<h2>Receipt</h2>";

if ($result->num_rows > 0) {
    $receipt .= "<table border='1'>
                    <tr>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Table Number</th>
                        <th>Price</th>
                        <th>Order</th>
                        <th>Total Cost</th>
                    </tr>";
    while($row = $result->fetch_assoc()) {
        $total_cost = $row["price"] * $row["quantity"]; 
        $receipt .= "<tr>
                        <td>".$row["item_name"]."</td>
                        <td>".$row["quantity"]."</td>
                        <td>".$row["table_number"]."</td>
                        <td>".$row["price"]."</td>
                        <td>".$row["order"]."</td>
                        <td>".$total_cost."</td>
                    </tr>";
    }
    $receipt .= "</table>";
} else {
    $receipt .= "0 results";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        td:nth-child(4), td:nth-child(6) {
            text-align: right;
        }
        .back-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-link:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <header>
    <h1>Dear valued guest,</h1>
    <p>We hope you're enjoying your stay at our restaurant. You can conveniently settle the bill through cash when your order arrives.</p>
    <p>Thank you for choosing to dine with us. </p>
    <p>Best regards,<br>Hujav All-day</p>
</header>

    <?php echo $receipt; ?>

<nav>
        <ul>
            <a href="menu.php" class="back-link">back</a>
           
        </ul>
    </nav>

</body>
</html>
