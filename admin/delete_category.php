<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "findworker");

if (!isset($_SESSION["admin"])) {
    header("Location: index.php"); // Redirect to the login page
    exit();
}

if (isset($_GET["id"])) {
    $categoryId = $_GET["id"];
    
    // Perform the deletion of the category based on $categoryId
    $deleteQuery = "DELETE FROM categories WHERE id = $categoryId";
    $deleteResult = mysqli_query($con, $deleteQuery);

    if ($deleteResult) {
        // Category deleted successfully, you can set a success alert if needed
        $alert = "success";
    } else {
        // Category deletion failed, you can set an error alert if needed
        $alert = "error";
    }
}

// Redirect back to the category.php page after deletion
header("Location: category.php?alert=$alert");
exit();
?>
