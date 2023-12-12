<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "findworker");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancel'])) {
    $bookingId = $_POST['booking_id'];
    $newStatus = 'rejected'; // Define the new status

    // Update the status of the booking entry
    $updateQuery = "UPDATE bookings SET status = ? WHERE id = ?";
    $stmt = $con->prepare($updateQuery);
    $stmt->bind_param("si", $newStatus, $bookingId);
    if ($stmt->execute()) {
        // Success
        header("Location: mybookings.php"); // Redirect to mybookings.php
        exit();
    } else {
        // Error
        echo "Error updating booking status: " . $stmt->error;
    }
} else {
    // Invalid request
    echo "Invalid request.";
}
?>
