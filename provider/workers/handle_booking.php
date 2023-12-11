<?php
session_start();
// Include your database connection code here
$con = mysqli_connect("localhost", "root", "", "findworker");
$email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch user details based on email
    // Debugging statement to check the email
    echo "Logged-in email: " . $email . "<br>";

    // Fetch service provider's ID from the form's hidden field
    $serviceProviderId = $_POST['provider_id']; // Make sure the form field is named correctly

    // Fetch service taker's ID based on the logged-in user's email
    $query = "SELECT id FROM serviceprovider WHERE email = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($res = mysqli_fetch_array($result)) {
        // Debugging statement to check the service provider's ID
        echo "Service Provider ID: " . $serviceProviderId . "<br>";

        // Fetch service provider's ID
        $serviceTakerId = $res['id'];

        // Fetch other details ...

        // Assuming you have an array of selected dates
        $selectedDatesJSON = $_POST['selected_dates'];
        $selectedDates = json_decode($selectedDatesJSON);

        // Use a prepared statement for inserting dates
        $status = "pending"; // You can change this to your desired default status
        $query = "INSERT INTO bookings (service_provider_id, service_taker_id, date, status) VALUES (?, ?, ?, ?)";
        $stmt = $con->prepare($query);
        $stmt->bind_param("iiss", $serviceProviderId, $serviceTakerId, $date, $status);

        foreach ($selectedDates as $date) {
            $date = mysqli_real_escape_string($con, $date); // Sanitize date
            $stmt->execute();
        }

        // Check if any insert query failed
        if ($stmt->errno) {
            // Handle the error, you can log it or provide an error message
            echo "Booking failed. Please try again later.";
        } else {
            // Redirect to mybookings.php or any other desired page on successful booking
            header("Location: ../mybookings.php");
            exit();
        }
    } else {
        // Handle case where service provider's details are not found
        echo "Service provider details not found.";
    }
} else {
    // Handle invalid request method
    echo "Invalid request method.";
}
