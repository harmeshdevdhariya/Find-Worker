<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "findworker");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['clear_records'])) {
    // Define the status to clear (in this case, "rejected")
    $statusToClear = 'rejected';

    // Delete records with the specified status
    $deleteQuery = "DELETE FROM bookings WHERE status = ?";
    $stmt = $con->prepare($deleteQuery);
    $stmt->bind_param("s", $statusToClear);

    if ($stmt->execute()) {
        // Records cleared successfully
        header("Location: mybookings.php?clearSuccess=true");

        exit();
        
    } else {
        // Error
        echo "Error clearing records: " . $stmt->error;
    }
} else {
    // Invalid request
    echo "Invalid request.";
}
?>
