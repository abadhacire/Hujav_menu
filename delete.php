<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
      body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f3f3;
            color: #333;
        }

        header {
            background-color: green;
            color: #fff;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        .container {
            max-width: 8000px;
            margin: 0 auto;
            padding: 20px;
            background-color: whitesmoke;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: green;
            color: #fff;
            font-weight: bold;
        }

        td {
            vertical-align: top;
        }

        input[type="submit"] {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #444;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #666;
        }

        .delete-checkbox {
            text-align: center;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: green;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-link:hover {
            background-color: #666;
        }
    
    </style>
</head>
<body>
    <header>
        <h1>Delete foods</h1>
    </header>

    <div class="container">
        <?php
       
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "foods_db";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

    
        function displayTableData($conn, $table_name, $columns) {
            $sql = "SELECT " . implode(", ", $columns) . " FROM " . $table_name;
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<h2>$table_name Data</h2>";
                echo "<form method='post' action='deletes.php' onsubmit='return confirm(\"Are you sure you want to delete the selected products?\");'>";
                echo "<input type='hidden' name='table_$table_name' value='$table_name'>";
                echo "<table>";
                echo "<tr>";
                foreach ($columns as $column) {
                    echo "<th>" . ucfirst($column) . "</th>";
                }
                echo "<th>Delete</th>";
                echo "</tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($columns as $column) {
                        echo "<td>" . htmlspecialchars($row[$column]) . "</td>";
                    }
                    echo "<td><input type='checkbox' name='delete_item[]' value='" . htmlentities(json_encode($row)) . "'></td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "<input type='submit' value='Delete'>";
                echo "</form>";
            } else {
                echo "<h2>$table_name Data</h2>";
                echo "<p>No data found in $table_name</p>";
            }
        }

        displayTableData($conn, "`foods`", array("item", "price", "image_path", "descriptions"));
        $conn->close();
        ?>
    </div>
    <a href="received.php" class="back-link">back</a>
</body>
</html>
