<?php
include_once "includes/db_connection.php";

?>



<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        #container {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 80%;
            max-width: 600px;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }

        a {
            color: #4caf50;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        a:hover {
            text-decoration: underline;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div id="container">
    <h2 style="text-align: center;">Add Order</h2>

    <?php
                 $conn = connectDB();
                 echo "<form action='includes/insert_order.php' method='post'>";
                 echo "<label for='c_name'>Select Customer:</label>";
                 echo "<select name='customer'>";
                 try {
                     $sql = 'SELECT * FROM customer';
                     $stmt = $conn->query($sql);
                     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                         echo "<option value='" . $row["c_id"] . "'>" . $row["c_name"] . "</option>";
                     }
                     echo "</select>";
                 } catch (PDOException $e) {
                     echo "There is some problem in connection: " . $e->getMessage();
                 }
                 echo "<br>";
                 
                 // Generate the HTML select element for products
                 echo "<label for='p_name'>Select Product:</label>";
                 echo "<select name='product'>";
                 try {
                     $sql = 'SELECT * FROM product';
                     $stmt = $conn->query($sql);
                     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                         echo "<option value='" . $row["p_id"] . "'>" . $row["p_name"] . "</option>";
                     }
                     echo "</select>";
                     echo "<br>";

                     echo "<label for='quantity'>Quantity:</label>";
                     echo "<input type='number' name='quantity' value='1' min='1'><br>";


                     echo "<button type='submit' name='submit' class='datatable-input'>Submit</button>";
                     echo "</form>";
                 } catch (PDOException $e) {
                     echo "There is some problem in connection: " . $e->getMessage();
                 }
                 
                 $conn = null; // Close connection
                 ?>

    <div class="button-container">
        <a href="order.php">Back to Order List</a>
    </div>
</div>

</body>
</html>
