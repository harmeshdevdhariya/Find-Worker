<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the booking ID and response (accept or reject) from the form
    $bookingId = $_POST['booking_id'];
    $response = $_POST['response'];

    // Perform validation if needed

    // Update the booking status in the database
    $con = mysqli_connect("localhost", "root", "", "findworker");

    // Update the status based on the response
    if ($response === 'accept') {
        $status = 'confirmed';
    } elseif ($response === 'reject') {
        $status = 'rejected';
    }

    // Update the status in the database
    $updateQuery = "UPDATE bookings SET status = ? WHERE id = ?";
    $stmt = $con->prepare($updateQuery);
    $stmt->bind_param("si", $status, $bookingId);

    // Check if the status was updated successfully
    if ($stmt->execute()) {
        // Status updated successfully, you can redirect or display a success message

        // Send an email to the service taker with the booking status
        $loggedInServiceProviderEmail = $_SESSION['email']; // Adjust this according to your implementation

        // Fetch the booking details and service taker's first name, last name, and email based on the booking ID
        // Fetch the booking details and service provider's first name and last name based on the booking ID
       // Fetch the booking details and service taker's first name, last name, and email based on the booking ID
       $bookingDetailsQuery = "
       SELECT b.*, sp.firstname AS serviceProviderFirstName, sp.lastname AS serviceProviderLastName, st.email AS serviceTakerEmail, st.firstname AS serviceTakerFirstName, st.lastname AS serviceTakerLastName
       FROM bookings b
       INNER JOIN serviceprovider sp ON b.service_provider_id = sp.id
       INNER JOIN servicetaker st ON b.service_taker_id = st.id
       WHERE b.id = ?
   ";
   $stmt = $con->prepare($bookingDetailsQuery);
   $stmt->bind_param("i", $bookingId);
   $stmt->execute();
   $bookingDetailsResult = $stmt->get_result();
   
   if ($bookingRow = $bookingDetailsResult->fetch_assoc()) {
       $serviceProviderFirstName = $bookingRow['serviceProviderFirstName'];
       $serviceProviderLastName = $bookingRow['serviceProviderLastName'];
       $serviceTakerEmail = $bookingRow['serviceTakerEmail'];
       $serviceTakerFirstName = $bookingRow['serviceTakerFirstName'];
       $serviceTakerLastName = $bookingRow['serviceTakerLastName'];
       $bookingDate = $bookingRow['date'];

       // Rest of the code
   
   
            // Rest of the code

            // Construct the email subject and message based on the response
            if ($response === 'accept') {
                $subject = "Your booking has been confirmed";
                $message = "Hello, " . $serviceTakerFirstName . " " . $serviceTakerLastName . " Your booking with " . $serviceProviderFirstName . " " . $serviceProviderLastName . " for " . $bookingDate . " has been confirmed.";
            } elseif ($response === 'reject') {
                $subject = "Your booking has been rejected";
                $message = "Hello, " . $serviceTakerFirstName . " " . $serviceTakerLastName . " Your booking with " . $serviceProviderFirstName . " " . $serviceProviderLastName . " for " . $bookingDate . " has been rejected. Please try booking with another date.";
            }
            


            // Use the PHPMailer code to send the email
            $mail = new PHPMailer(true);

            //Server settings
            $mail->isSMTP(); // Send using SMTP
            $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'harmeshdevdhariya04@gmail.com'; // SMTP write your email
            $mail->Password = 'lkqrzqyzoxopfkrg'; // SMTP password
            $mail->SMTPSecure = 'ssl'; // Enable implicit SSL encryption
            $mail->Port = 465;

            // Set up the email configuration, including SMTP settings and credentials
            $mail->setFrom($loggedInServiceProviderEmail, 'Your Name'); // Use the service provider's name
            $mail->addAddress($serviceTakerEmail, 'Service Taker Name');
            // Use the service taker's name

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;

            if ($mail->send()) {
                $_SESSION['email_sent'] = true;

                // Email sent successfully
                header("Location: myorder.php"); // Redirect to the booking page
                // After sending the email successfully

                exit();
            } else {
                // Email sending error
                echo "Email could not be sent. Error: " . $mail->ErrorInfo;
            }
        } else {
            // Error fetching booking details
            echo "Error fetching booking details: " . $stmt->error;
        }
    } else {
        // Error updating status
        echo "Error updating status: " . $stmt->error;
    }
} else {
    // Handle if the form was not submitted
    echo "Invalid request.";
}
