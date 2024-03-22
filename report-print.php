<?php

$_SESSION['edit'] = $_POST["edit"];



  if(isset($_SESSION['edit']) && !empty($_SESSION['edit'])) {
    $editid = $_SESSION['edit'];
  }else{
    header("location:order.php?error=nofile");
  }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
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
        .print-button {
            text-align: center;
            margin-top: 20px;
        }
        @media print {
            .container {
                border: none;
            }
            .print-button {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Transaction Report</h2>
        <table>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            <!-- PHP code to fetch data from database and populate the table -->
            <?php
            // Connect to the database
            $conn = new mysqli("localhost", "root", "", "testdb");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch data for a single transaction from the database (replace `transaction_id` with the actual transaction ID)
            $sql = "SELECT * FROM orders 
                    INNER JOIN customer ON customer.c_id = orders.c_id
                    INNER JOIN product ON product.p_id = orders.p_id
                    INNER JOIN users ON users.user_id = orders.user_id
                    WHERE orders.o_id = '$editid'";
            $result = $conn->query($sql);

            // Output data
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>Order ID</td><td>" . $row["o_id"] . "</td></tr>";
                    echo "<tr><td>Product Name</td><td>" . $row["p_name"] . "</td></tr>";
                    echo "<tr><td>Customer Name</td><td>" . $row["c_name"] . "</td></tr>";
                    echo "<tr><td>Customer Address</td><td>" . $row["c_address"] . "</td></tr>";
                    echo "<tr><td>Transaction ID</td><td>" . $row["o_id"] . "</td></tr>";
                    echo "<tr><td>User Info</td><td>" . $row["name"] . "</td></tr>";
                    echo "<tr><td>Quantity</td><td>" . $row["quantity"] . "</td></tr>";
                    echo "<tr><td>Total Price</td><td>" . $row["p_price"] . "</td></tr>";
                    $total_payment = $row["quantity"] * $row["p_price"];
                    echo "<tr><td>Total Payment</td><td>" . $total_payment . "</td></tr>";
                    echo "<tr><td>Date</td><td>" . $row["date"] . "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No data found</td></tr>";
            }

            // Close connection
            $conn->close();
            ?>
        </table>
        <div class="print-button">
            <button onclick="window.print()">Print Report</button>
        </div>
    </div>
</body>
</html>
