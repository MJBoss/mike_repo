<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pid = $_POST['product'];
    $cid = $_POST['customer'];
    $quant = $_POST['quantity'];
    $currentDate = date('Y-m-d');

    try {
        // Use the function to get a PDO connection
        $conn = connectDB();

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO orders (p_id, c_id, quantity, date) VALUES (:pid, :cid, :quant, :dates)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':pid', $pid);
        $stmt->bindParam(':cid', $cid);
        $stmt->bindParam(':quant', $quant);
        $stmt->bindParam(':dates', $currentDate);
        $stmt->execute();

        // Redirect back to the user data page after successful insertion
        header("Location: ../order.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Always close the connection
        if ($conn) {
            $conn = null;
        }
    }
}
?>
