<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cname = $_POST['c_name'];
    $cemail = $_POST['c_email'];

    try {
        // Use the function to get a PDO connection
        $conn = connectDB();

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO customer (c_name, c_email) VALUES (:cn, :cem)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cn', $cname);
        $stmt->bindParam(':cem', $cemail);
        $stmt->execute();

        // Redirect back to the user data page after successful insertion
        header("Location: ../customer.php");
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
