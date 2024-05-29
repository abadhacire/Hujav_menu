<!DOCTYPE html>
<html>
<head>
    <title>Display Data</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 10px;
        }

        header {
            background-color: green;
            color: white;
            text-align: center;
            padding: 20px;
            margin-bottom: 20px;
            border-bottom: 2px solid #ddd;
            border-radius: 5px;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        header p {
            font-size: 16px;
            margin-top: 5px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            text-align: center;
        }

        nav ul li {
            display: inline-block;
            margin-bottom: 10px;
        }

        nav ul li a {
            text-decoration: none;
            color: #333;
            background-color: #fff;
            padding: 10px 20px;
            display: block;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav ul li a:hover {
            background-color: #ddd;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .container {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .container h2 {
            margin-top: 0;
        }

        .container label {
            display: block;
            margin-bottom: 10px;
        }

        .container input[type="text"],
        .container input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .container button[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .container button[type="submit"]:hover {
            background-color: #555;
        }

        footer {
            text-align: center;
            margin-top: 20px;
        }

        .delete-link {
            text-decoration: none;
            color: #333;
            background-color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            border: 2px solid #333;
            transition: background-color 0.3s;
        }

        .delete-link:hover {
            background-color: green;
            color: #fff;
        }
    </style>
</head>
<body>
    <header>
        <h1>Kitchen Orders</h1>
        <p>GOOD DAY KITCHEN STAFF</p>

    </header>
 <?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "foods_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function displayTableData($conn, $table_name) {
    $sql = "SELECT * FROM $table_name";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>$table_name Data</h2>";
        echo "<form method='post' action='received.php' onsubmit='return confirm(\"Are you sure you want to delete the selected rows?\");'>";
        echo "<input type='hidden' name='table_$table_name' value='$table_name'>"; 
        echo "<table>";
        echo "<tr>";
        $first_row = $result->fetch_assoc();
        foreach ($first_row as $key => $value) {
            echo "<th>" . ucfirst($key) . "</th>";
        }
        echo "<th>Delete</th>"; 
        echo "</tr>";
        $result->data_seek(0);
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . $value . "</td>";
            }
    
            echo "<td><input type='checkbox' name='delete_row[]' value='" . htmlentities(json_encode($row)) . "'></td>"; 
            echo "</tr>";
        }
        echo "</table>";
        echo "<input type='submit' value='Delete Selected Rows'>";
        echo "</form>";
    } else {
        echo "<h2>$table_name Data</h2>";
        echo "<p>No data found in $table_name</p>";
    }
}

displayTableData($conn, "menu");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_row'])) {
    $table_name = $_POST['table_menu'];
    foreach($_POST['delete_row'] as $selected_row_json) {
        $selected_row = json_decode($selected_row_json, true);
        
        $sql = "DELETE FROM $table_name WHERE ";
        $conditions = [];
        foreach ($selected_row as $key => $value) {
            $value = $conn->real_escape_string($value);
            if ($key === 'order') {
                $conditions[] = "`$key` = '$value'";
            } else {
                $conditions[] = "`$key` = '$value'";
            }
        }
        $sql .= implode(" AND ", $conditions);
        if ($conn->query($sql) === FALSE) {
            echo "Error deleting record: " . $conn->error;
        } else {
            echo "Selected row deleted successfully from table: $table_name <br>";
        }
    }
}
$conn->close();
?>



<div class="container">
    <h2>Add Foods</h2>
    <form action="data.php" method="post">
        <label for="itemName">Item Name:</label>
        <input type="text" id="itemName" name="itemName" required>
        <label for="itemPrice">Item Price:</label>
        <input type="number" id="itemPrice" name="itemPrice" required>
        <label for="itemImage">Item Image URL:</label>
        <input type="text" id="itemImage" name="itemImage" required>
        <label for="itemDescription">Item Description:</label>
        <input type="text" id="itemDescription" name="descriptions" required>
        <button type="submit">Add</button>
    </form>
</div>
<div class="container">
<footer>

    <a href="delete.php" class="delete-link">Foods delete</a>
    </footer>
    </div>
<nav>
    <ul>
        <li><a href="index1.php">log out</a></li>
    </ul>
</nav>
</body>
</html>
