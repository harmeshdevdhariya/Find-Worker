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
    $serviceProviderId = $_GET['id'];

    // Perform the delete operation here
    $deleteQuery = "DELETE FROM serviceprovider WHERE id = ?";
    $stmt = $con->prepare($deleteQuery);
    $stmt->bind_param("i", $serviceProviderId);

    if ($stmt->execute()) {
        $_SESSION['provider_status'] = "Service provider deleted successfully.";
        $provider_alert_class = "alert-success"; // Bootstrap class for success alert
    } else {
        $_SESSION['provider_status'] = "Failed to delete service provider.";
        $provider_alert_class = "alert-danger"; // Bootstrap class for danger alert
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
