<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt/Report Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .total {
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Receipt/Report Form</h2>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Customer Name</th>
                <th>Customer Address</th>
                <th>Transaction ID</th>
                <th>User Info</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Payment</th>
                <th>Date</th>
            </tr>
            <!-- PHP code to fetch data from database and populate the table -->
            <?php
            // Connect to the database
            $conn = new mysqli("localhost", "username", "password", "database");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch data from the database
            $sql = "SELECT * FROM orders";
            $result = $conn->query($sql);

            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["order_id"] . "</td>";
                echo "<td>" . $row["product_name"] . "</td>";
                echo "<td>" . $row["customer_name"] . "</td>";
                echo "<td>" . $row["customer_address"] . "</td>";
                echo "<td>" . $row["transaction_id"] . "</td>";
                echo "<td>" . $row["user_info"] . "</td>";
                echo "<td>" . $row["quantity"] . "</td>";
                echo "<td>" . $row["total_price"] . "</td>";
                echo "<td>" . $row["payment"] . "</td>";
                echo "<td>" . $row["date"] . "</td>";
                echo "</tr>";
            }
            // Close connection
            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
