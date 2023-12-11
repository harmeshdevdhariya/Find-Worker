<?php
session_start();
require '_nav.php';
if (!isset($_SESSION['email'])) {
   header("Location:../login.php"); // Replace 'login.php' with your actual login page
   exit();
}

$con = mysqli_connect("localhost", "root", "", "findworker");

// Assuming the user is a service provider, get their email from the session
$loggedInServiceProviderEmail = $_SESSION['email']; // Adjust this according to your implementation

// Fetch the service provider's details based on their email
$serviceProviderQuery = "SELECT * FROM serviceprovider WHERE email = ?";
$stmt = $con->prepare($serviceProviderQuery);
$stmt->bind_param("s", $loggedInServiceProviderEmail);
$stmt->execute();
$serviceProviderResult = $stmt->get_result();

if ($serviceProviderRow = $serviceProviderResult->fetch_assoc()) {
   $loggedInServiceProviderId = $serviceProviderRow['id'];

   // Fetch booking details along with associated service taker details
   $bookingQuery = "
        SELECT b.*, st.firstname, st.phone, st.email, st.city, st.lastname, st.image
        FROM bookings b
        INNER JOIN servicetaker st ON b.service_taker_id = st.id
        WHERE b.service_provider_id = ?
    ";
   $stmt = $con->prepare($bookingQuery);
   $stmt->bind_param("i", $loggedInServiceProviderId);
   $stmt->execute();
   $bookingResult = $stmt->get_result();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- Site Icons -->
   <!-- Include Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

   <!-- Include Bootstrap JS (jQuery is required) -->
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <!-- Bootstrap CSS -->

   <!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
   <!-- Site CSS -->
   <!-- <link rel="stylesheet" href="../style.css"> -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">


   <style>
      body {
         font-family: Arial, sans-serif;
         background-color: #f5f5f5;
         margin: 0;
         padding: 0;
      }

      td.lable {
         color: brown;
      }

      td.content {
         color: blue;
      }

      h1 {
         text-align: center;
         padding: 20px 0;
         background-color: #333;
         color: white;
      }

      .booking-card {
         width: 600px;
         /* Set the width of the booking card */
         margin: 0 auto;
         /* Center the card horizontally */
         background-color: #ffffff;
         border: 1px solid #ddd;
         padding: 20px;
         margin-bottom: 20px;
         border-radius: 5px;
         box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
         text-align: center;
      }

      .booking-card img {
         width: 100px;
         height: 100px;
         border-radius: 50%;
         margin-bottom: 10px;
      }

      .booking-card p {
         margin: 0;
         font-size: 14px;
      }

      .booking-card form {
         margin-top: 10px;
      }

      .booking-card button {
         background-color: #0000FF;
         color: #fff;
         border: none;
         padding: 5px 10px;
         border-radius: 5px;
         cursor: pointer;
      }

      .booking-card button.accept {
         background-color: #28a745;
      }

      .booking-card button.reject {
         background-color: #dc3545;
      }

      /* Example CSS styles for status buttons */
      .status-button {
         padding: 5px 10px;
         border-radius: 5px;
         cursor: pointer;
         width: 100px;
      }

      .confirm-button {
         background-color: #28a745;
         color: white;
         border: none;
      }

      .reject-button {
         background-color: #dc3545;
         color: white;
         border: none;
      }

      /* Example CSS styles for status button group */
      .status-button-group {
         display: flex;
         justify-content: space-between;
         align-items: center;
         margin-top: 10px;
      }
   </style>
   <script>
      <?php
      if (isset($_SESSION['email_sent']) && $_SESSION['email_sent']) {
         echo 'document.addEventListener("DOMContentLoaded", function() {
      var successAlert = document.getElementById("success-alert");
      successAlert.style.display = "block";

      // Hide the alert after 3 seconds
      setTimeout(function() {
        successAlert.style.display = "none";
      }, 3000); // 3000 milliseconds = 3 seconds
    });';

         // Reset the session variable so the message is not shown again
         $_SESSION['email_sent'] = false;
      }
      ?>
   </script>
</head>

<body>
   <div class="alert alert-success alert-dismissible fade show" id="success-alert" style="display: none;">
      <strong>Success!</strong> Email sent successfully.
      <button type="button" class="close" data-dismiss="alert">&times;</button>
   </div>

   <br><br>
   <?php while ($bookingRow = $bookingResult->fetch_assoc()) : ?>
      <div class="booking-card">
         <img src="../../taker/userdashboard/uploads/<?php echo $bookingRow['image']; ?>" alt="Service Taker Image" width="150" height="150">

         <table>

            <td class="lable">Name:</td>
            <td class="content"><?php echo $bookingRow['firstname'] . ' ' . $bookingRow['lastname']; ?></td>

            <tr>
               <td class="lable">Phone:</td>
               <td class="content"><?php echo $bookingRow['phone']; ?></td>
            </tr>
            <tr>
               <td class="lable">Email:</td>
               <td class="content"><?php echo $bookingRow['email'] ?></td>
            </tr>
            <tr>
               <td class="lable">Address:</td>
               <td class="content"><?php echo $bookingRow['city'] ?></td>
            </tr>
            <tr>
               <td class="lable">Date:</td>
               <td class="content"><?php echo $bookingRow['date']; ?></td>
            </tr>
            <tr>
               <td class="lable">Booking Status:</td>
               <td class="content"><?php echo $bookingRow['status']; ?></td>
            </tr>
            <tr>
               <td>
                  <form action="handle_booking_response.php" method="post">
                     <input type="hidden" name="booking_id" value="<?php echo $bookingRow['id']; ?>">
                     <div class="status-button-group">
                        <input type="hidden" name="response" value="accept">
                        <button class="accept" type="submit">Accept</button>
                     </div>
                  </form>
               </td>

               <td>
                  <form action="handle_booking_response.php" method="post">
                     <input type="hidden" name="booking_id" value="<?php echo $bookingRow['id']; ?>">
                     <input type="hidden" name="response" value="reject">
                     <button class="reject" type="submit">Reject</button>
                  </form>
               </td>
            </tr>
         </table>

      </div>

   <?php endwhile; ?>
</body>

</html>
<?php
require('../footer.php');
?>