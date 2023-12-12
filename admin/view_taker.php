<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "findworker");

if (!isset($_SESSION["admin"])) {
    header("Location: index.php"); // Redirect to the login page
    exit();
}

// Check if the ID parameter is present in the URL
if (isset($_GET['id'])) {
    $serviceTakerId = $_GET['id'];

    // Query to fetch the service taker's details based on their ID
    $query = "SELECT * FROM servicetaker WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $serviceTakerId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = mysqli_fetch_assoc($result)) {
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $email1 = $row['email'];
        $phone = $row['phone'];
        $city = $row['city'];
        $gender = $row['gender'];
        // Add more fields as needed

        // Calculate the total number of bookings (you'll need to fetch this from your bookings table)
        $totalBookings = 0; // Replace with your code to fetch the total bookings

        // Calculate the number of confirmed bookings (you'll need to fetch this from your bookings table)
        $confirmedBookings = 0; // Replace with your code to fetch the confirmed bookings

        // Calculate the number of pending bookings (you'll need to fetch this from your bookings table)
        $pendingBookings = 0; // Replace with your code to fetch the pending bookings
    } else {
        echo "Service taker not found.";
        exit(); // Exit if the service taker is not found
    }
} else {
    echo "Service taker ID not provided.";
    exit(); // Exit if the ID is not provided
}


// Assuming $serviceTakerId contains the ID of the current service taker

// Function to get the total bookings count
function getTotalBookings($con, $serviceTakerId) {
    $query = "SELECT COUNT(*) as total FROM bookings WHERE service_taker_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $serviceTakerId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['total'];
}

// Function to get the confirmed bookings count
function getConfirmedBookings($con, $serviceTakerId) {
    $query = "SELECT COUNT(*) as confirmed FROM bookings WHERE service_taker_id = ? AND status = 'confirmed'";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $serviceTakerId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['confirmed'];
}

// Function to get the pending bookings count
function getPendingBookings($con, $serviceTakerId) {
    $query = "SELECT COUNT(*) as pending FROM bookings WHERE service_taker_id = ? AND status = 'pending'";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $serviceTakerId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['pending'];
}

$totalBookings = getTotalBookings($con, $serviceTakerId);
$confirmedBookings = getConfirmedBookings($con, $serviceTakerId);
$pendingBookings = getPendingBookings($con, $serviceTakerId);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Service taker</title>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.10/css/jquery.dataTables.min.css">

    <!-- DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.11.10/js/jquery.dataTables.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <?php
        include 'includes/header.php';
        include 'includes/sidebar.php';
        include 'includes/topbar.php';
        ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
     

        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <!-- Replace with the correct image path or use a default image -->
                                        <img class="profile-user-img img-fluid img-circle" src="../taker/userdashboard/uploads/<?php echo $row['image']; ?>" alt="User profile picture">
                                    </div>
                                    <h3 class="profile-username text-center"><?php echo $firstname . " " . $lastname; ?></h3>
                                    <p class="text-muted text-center">Service Taker</p>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Total Bookings</b> <span class="float-right"><?php echo $totalBookings; ?></span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Confirmed Bookings</b> <span class="float-right"><?php echo $confirmedBookings; ?></span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Pending Bookings</b> <span class="float-right"><?php echo $pendingBookings; ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">About Me</h3>
                                </div>
                                <div class="card-body">
                                    <dl class="row">
                                        <dt class="col-sm-4">Email:</dt>
                                        <dd class="col-sm-8"><?php echo $email1; ?></dd>

                                        <dt class="col-sm-4">Phone:</dt>
                                        <dd class="col-sm-8"><?php echo $phone; ?></dd>

                                        <dt class="col-sm-4">Gender:</dt>
                                        <dd class="col-sm-8"><?php echo $gender; ?></dd>

                                        <dt class="col-sm-4">Location:</dt>
                                        <dd class="col-sm-8"><?php echo $city; ?></dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <script>
            $(document).ready(function() {
                $('#example2').DataTable();
            });
        </script>

        <?php
        include 'includes/footer.php';
        ?>
    </div>
</body>

</html>
