<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pname = $_POST['product_name'];
    $stock = $_POST['product_stocks'];
    $stat = $_POST['product_status'];

    try {
        // Use the function to get a PDO connection
        $conn = connectDB();

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO product (p_name, p_price, p_status) VALUES (:prod, :sto, :pstat)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':prod', $pname);
        $stmt->bindParam(':sto', $stock);
        $stmt->bindParam(':pstat', $stat);
        $stmt->execute();

        // Redirect back to the user data page after successful insertion
        header("Location: ../product.php");
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
