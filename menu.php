<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Menu</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
        }

        section {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
        }

        h2 {
            color: #333;
        }

        .menu-category {
            margin-top: 20px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }

        .menu-item img {
            height: 150px;
            width: 150px;
            border-radius: 5px;
            margin-right: 20px;
        }

        .menu-item-info {
            flex: 1;
        }

        .menu-item-info h4 {
            margin: 0;
        }

        .menu-item-info p {
            margin: 5px 0;
        }
        .home-link {
        text-decoration: none;
        color: #333; 
        font-weight: bold;
        padding: 5px 10px;
        border: 2px solid #333; 
        border-radius: 5px;
        background-color: #fff; 
        transition: all 0.3s ease; 
    }
    .home-link:hover {
        background-color: #333;
        color: #fff;
    }
    .Receipt-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .Receipt-link:hover {
            background-color: #555;
        }
    </style>
   <script>
        function showConfirmation() {
            alert("Your order has been successfully submitted. We'll process it shortly.");
        }
    </script>
</head>
<body>
    <header>
        <h1>Delicious Menu</h1>
    </header>
    <section>
    <form action="submit_order.php" method="post" onsubmit="showConfirmation()">
    <div class="menu-category">
        <?php
        $conn = new mysqli('localhost', 'root', '', 'foods_db');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT item, price, image_path, descriptions FROM foods";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="menu-item">';
                echo '<img src="' . htmlspecialchars($row['image_path']) . '" alt="' . htmlspecialchars($row['item']) . '">';
                echo '<div class="menu-item-info">';
                echo '<h4>' . htmlspecialchars($row['item']) . '</h4>';
                echo '<p>Price: ₱' . htmlspecialchars($row['price']) . '</p>';
                echo '<p>Description: ' . htmlspecialchars($row['descriptions']) . '</p>';
                echo '<input type="hidden" name="items[' . htmlspecialchars($row['item']) . '][price]" value="' . htmlspecialchars($row['price']) . '">';
                echo '<input type="number" name="items[' . htmlspecialchars($row['item']) . '][quantity]" placeholder="Quantity">';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>No menu items found.</p>";
        }

        $conn->close();
        ?>
    </div>
    <label for="tableNumber">Select a table Number:</label>
    <select id="tableNumber" name="tableNumber">
        <?php
        for ($i = 1; $i <= 40; $i++) {
            echo "<option value='$i'>$i</option>";
        }
        ?>
    </select>
    <label for="order">and</label>
    <select id="order" name="order">
        <option value="dine-in">Dine-in</option>
        <option value="takeout">Takeout</option>
    </select>
    <input type="submit" value="Submit the Order">
</form>

        <a href="price.php" class="Receipt-link">Receipt</a>
    </section>


    <nav>
        <ul>
            <a href="index.php" class="home-link">home</a>
        </ul>
    </nav>
</body>
</html>