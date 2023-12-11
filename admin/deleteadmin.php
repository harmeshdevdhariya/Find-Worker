<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "findworker");

if (!isset($_SESSION["admin"])) {
    header("Location: index.php"); // Redirect to the login page
    exit();
}

// Check if the admin ID is provided in the query parameter
if (isset($_GET["id"])) {
    $adminID = $_GET["id"];
    
    // Remove the admin record from the database
    $sql = "DELETE FROM admin WHERE id = $adminID";
    
    if (mysqli_query($con, $sql)) {
        // Redirect back to alladmins.php with a success message
        header("Location: alladmins.php?alert=success");
        exit();
    } else {
        // Handle the error, e.g., display an error message
        echo "Error: " . mysqli_error($con);
    }
} else {
    // Handle the case where no admin ID is provided in the query parameter
    echo "Invalid admin ID.";
}
?>
