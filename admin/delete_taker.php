<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "findworker");

if (!isset($_SESSION["admin"])) {
    header("Location: index.php"); // Redirect to the login page
    exit();
}

?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<?php
if (isset($_GET['id'])) {
    $serviceTakerId = $_GET['id'];

    // Perform the delete operation here
    $deleteQuery = "DELETE FROM servicetaker WHERE id = ?";
    $stmt = $con->prepare($deleteQuery);
    $stmt->bind_param("i", $serviceTakerId);

    if ($stmt->execute()) {
        $_SESSION['status'] = "Service taker  deleted successfully.";
        $alert_class = "alert-success"; // Bootstrap class for success alert
    } else {
        $_SESSION['status'] = "Failed to delete service taker.";
        $alert_class = "alert-danger"; // Bootstrap class for danger alert
    }

    // Redirect back to the home page
    header("Location: home.php");
    exit();
} else {
    $_SESSION['status'] = "Invalid request to delete service taker.";
    $alert_class = "alert-danger"; // Bootstrap class for danger alert
    header("Location: home.php"); // Redirect back to the home page
    exit();
}
?>
