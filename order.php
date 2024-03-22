

<!DOCTYPE HTML>
<html lang="en">
<!--test-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrieve Products</title>
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

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #5401a6;
            color: white;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .add-button {
            background-color: #5401a6;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-right: 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        .edit-button {
            background-color: #2196f3;
            color: white;
            border: none;
            padding: 6px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<div id="container">
    <h2 style="text-align: center;">Orders Data</h2>

    
<div class="button-container">
    <a href="add_order.php" class="add-button">Add Order</a>
</div>

<?php
include 'includes/db_connection.php';

try {
    $conn = connectDB();

    if ($conn) {
        $sql = "SELECT * FROM orders
                INNER JOIN customer ON customer.c_id = orders.c_id
                INNER JOIN product ON product.p_id = orders.p_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<table>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Customer Name</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>";
        foreach ($result as $row) {
            echo "<tr>
                    <td>{$row['o_id']}</td>
                    <td>{$row['p_name']}</td>
                    <td>{$row['p_price']}</td>
                    <td>{$row['c_name']}</td>
                    <td>{$row['quantity']}</td>
                    <td>{$row['date']}</td>
                    <td>
                        <form action='report-print.php' method='post'>
                            <input type='hidden' name='edit' value='{$row['o_id']}'>
                            <button type='submit' class='edit-button'>View</button>
                        </form>
                    </td>
                </tr>";
        }
        echo "</table>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    if ($conn) {
        $conn = null;
    }
}
?>

<div class="button-container">
    <a href="index.php" class="add-button">Users</a>
    <a href="product.php" class="add-button">Products</a>
    <a href="customer.php" class="add-button">Customer</a>
</div>

</div>

</body>
</html>
