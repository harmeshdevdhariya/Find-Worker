<?php
// Replace with your database credentials
$host = "localhost";
$username = "root";
$password = "";
$database = "findworker";

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// 

// Fetch the providerId from the URL
if (isset($_GET['provider_id'])) {
    $providerId = $_GET['provider_id'];
} else {
    // Handle the case where provider_id is not provided
    echo "Provider ID not provided.";
    exit; // Terminate the script or handle the error accordingly
}

// Calculate the first day of the current month
$firstDayOfMonth = date("Y-m-01");

// Calculate the last day of the current month
$lastDayOfMonth = date("Y-m-t");

// Fetch booking data for the specified service provider
$sql = "SELECT date, status FROM bookings WHERE service_provider_id = $providerId AND date >= '$firstDayOfMonth' AND date <= '$lastDayOfMonth'";
$result = $conn->query($sql);

$events = array();

// Create an array of all dates from today until the end of the current month
$currentDate = date("Y-m-d");
$endDate = date("Y-m-t");

while (strtotime($currentDate) <= strtotime($endDate)) {
    $status = 'Available'; // Default status for dates is 'Available'
    
    // Check if the date is in the booking data and set the status accordingly
    if ($result->num_rows > 0) {
        $found = false; // Flag to check if the date is found in booking data
        while ($row = $result->fetch_assoc()) {
            if ($row['date'] == $currentDate) {
                $status = ($row['status'] == 'confirmed') ? 'UNAVAILABLE' : 'Available';
                $found = true;
                break; // Exit the loop once status is found
            }
        }
        
        // If the date was not found in booking data, set it as 'Available'
        if (!$found) {
            $status = 'Available';
        }
        
        // Reset the result pointer to the beginning for the next date
        $result->data_seek(0);
    }

    $events[] = array(
        'title' => $status,
        'start' => $currentDate,
        'color' => ($status == 'UNAVAILABLE') ? 'gray' : 'green'
    );

    $currentDate = date("Y-m-d", strtotime($currentDate . "+1 day"));
}

// Close the database connection
$conn->close();

// Return events in JSON format
echo json_encode($events);


?>
