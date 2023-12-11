<?php

session_start();
require '_nav.php';
if (!isset($_SESSION['email'])) {
    header("Location:../login.php"); // Replace 'login.php' with your actual login page
    exit();
}
$con = mysqli_connect("localhost", "root", "", "findworker");
$email = $_SESSION['email'];
$findresult = mysqli_query($con, "SELECT * FROM servicetaker WHERE email= '$email'");
if ($res = mysqli_fetch_array($findresult)) {

    $image = $res['image'];
}
// Assuming the user is a service taker, get their email from the session
$loggedInServiceTakerEmail = $_SESSION['email']; // Adjust this according to your implementation

// Fetch the service taker's details based on their email
$serviceTakerQuery = "SELECT * FROM servicetaker WHERE email = ?";
$stmt = $con->prepare($serviceTakerQuery);
$stmt->bind_param("s", $loggedInServiceTakerEmail);
$stmt->execute();
$serviceTakerResult = $stmt->get_result();

if ($serviceTakerRow = $serviceTakerResult->fetch_assoc()) {
    $loggedInServiceTakerId = $serviceTakerRow['id'];

    // Fetch booking details along with associated service provider details
    $bookingQuery = "
        SELECT b.*, sp.firstname AS sp_firstname,sp.phone AS sp_phone,sp.city AS sp_city, sp.lastname AS sp_lastname,sp.servicetype AS sp_servicetype, sp.image AS sp_image,sp.email,sp.rupeecharge
        FROM bookings b
        INNER JOIN serviceprovider sp ON b.service_provider_id = sp.id
        WHERE b.service_taker_id = ?
    ";
    $stmt = $con->prepare($bookingQuery);
    $stmt->bind_param("i", $loggedInServiceTakerId);
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
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Include Bootstrap JS (jQuery is required) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Site CSS -->
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">


    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        p {
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
</head>

<body>
    <table class="table table-bordered table-striped">
        <?php
        if (isset($_GET['clearSuccess']) && $_GET['clearSuccess'] === 'true') {
            // Display a success message here
            echo '<div class="alert alert-success" role="alert">Rejected records have been cleared successfully.</div>';
        }
        ?>
<script>
        // Hide the success alert after 3 seconds (3000 milliseconds)
        setTimeout(function() {
            document.getElementById('success-alert').style.display = 'none';
        }, 3000);
    </script>
        <form action="clear_rejected_records.php" method="post">
            <button type="submit" name="clear_records" class="btn btn-danger float-right">Clear Rejected Records</button>
        </form>
        <br><br>
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Service</th>
                <th>Phone</th>
                <th>City</th>
                <th>Date</th>
                <th>Charges</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($bookingRow = $bookingResult->fetch_assoc()) : ?>
                <tr>
                    <td><img src="../provider/userdashboard/uploads/<?php echo $bookingRow['sp_image']; ?>" alt="Service Provider Image" width="50" height="50"></td>
                    <td><?php echo $bookingRow['sp_firstname'] . ' ' . $bookingRow['sp_lastname']; ?></td>
                    <td><?php echo $bookingRow['email']; ?></td>
                    <td><?php echo $bookingRow['sp_servicetype']; ?></td>
                    <td><?php echo $bookingRow['sp_phone']; ?></td>
                    <td><?php echo $bookingRow['sp_city']; ?></td>
                    <td><?php echo $bookingRow['date']; ?></td>
                    <td><?php echo $bookingRow['rupeecharge']; ?></td>
                    <td>
                        <?php if ($bookingRow['status'] === 'confirmed') : ?>
                            <span class="badge badge-success">Confirmed</span>
                        <?php elseif ($bookingRow['status'] === 'rejected') : ?>
                            <span class="badge badge-danger">Rejected</span>
                        <?php else : ?>
                            <span class="badge badge-warning">Pending</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($bookingRow['status'] === 'confirmed') : ?>
                            <form action="handle_booking_cancel.php" method="post" class="status-buttons">
                                <input type="hidden" name="booking_id" value="<?php echo $bookingRow['id']; ?>">
                                <button class="btn btn-danger" type="submit" name="cancel" value="rejected">Cancel Booking</button>
                            </form>
                        <?php else : ?>
                            <!-- Display appropriate status message or action for rejected or pending bookings -->
                        <?php endif; ?>

                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <script>
        // Hide the success alert after 3 seconds (3000 milliseconds)
        setTimeout(function() {
            document.getElementById('success-alert').style.display = 'none';
        }, 3000);
    </script>

</body>

</html>
<?php
require('footer.php');
?>