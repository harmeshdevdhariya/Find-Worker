<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "findworker");

if (!isset($_SESSION["admin"])) {
    header("Location: index.php"); // Redirect to the login page
    exit();
}


// Initialize variables for messages
$successMessage = "";
$errorMessage = "";

// Handle status change form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_status'])) {
    $orderId = $_POST['order_id'];
    $newStatus = $_POST['new_status'];

    // Update the booking status in the database
    $query = "UPDATE bookings SET status = ? WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("si", $newStatus, $orderId);

    if ($stmt->execute()) {
        // Status updated successfully
        $successMessage = "Status updated successfully.";
    } else {
        // Handle the error, e.g., display an error message
        $errorMessage = "Error updating status: " . mysqli_error($con);
    }
}
// Handle delete order form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_order'])) {
    $orderId = $_POST['order_id'];

    // Delete the order from the database
    $deleteQuery = "DELETE FROM bookings WHERE id = ?";
    $stmt = $con->prepare($deleteQuery);
    $stmt->bind_param("i", $orderId);

    if ($stmt->execute()) {
        // Order deleted successfully
        $successMessage = "Order deleted successfully.";
    } else {
        // Handle the error, e.g., display an error message
        $errorMessage = "Error deleting order: " . mysqli_error($con);
    }
}

?>

<!-- JavaScript to automatically hide the success message after 1 second -->
<script>
    // Wait for the page to load
    document.addEventListener("DOMContentLoaded", function() {
        // Select the success message container
        var successMessageContainer = document.getElementById("successMessageContainer");

        // Check if the container exists and has a message
        if (successMessageContainer && successMessageContainer.innerHTML.trim() !== "") {
            // Set a timeout to hide the message after 1000 milliseconds (1 second)
            setTimeout(function() {
                successMessageContainer.style.display = "none";
            }, 1000);
        }
    });
</script>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Orders</title>
    <!-- Add your CSS and JavaScript libraries here -->
    <style>
        /* Add column borders to the table */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        /* Style the status column based on the status value */
        td.status {
            font-weight: bold;
            padding: 8px;
        }

        td.status.confirmed {
            background-color: #4CAF50;
            /* Green */
            color: white;
        }

        td.status.pending {
            background-color: #FFC107;
            /* Amber */
            color: black;
        }

        td.status.rejected {
            background-color: #f44336;
            /* Red */
            color: white;
        }

        /* Style the dropdown */
        select {
            padding: 4px;
        }

        /* Style the change status button */
        button[name="change_status"] {
            background-color: #007BFF;
            /* Blue */
            color: white;
            border: none;
            padding: 4px 8px;
            cursor: pointer;
        }

        .delete {
            background-color: orangered;
        }
    </style>
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
                <div class="card">
                    <center>
                        <h2>Manage Orders :</h2>
                    </center>
                    <div class="card-body p-0">
                        <!-- Display success or error message -->
                        <div id="successMessageContainer">
                            <?php if (!empty($successMessage)) { ?>
                                <div class="alert alert-success"><?php echo $successMessage; ?></div>
                            <?php } ?>
                            <?php if (!empty($errorMessage)) { ?>
                                <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
                            <?php } ?>
                        </div>
                        <!-- Display success message in a container with a unique ID -->

                        <table id="orderTable" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Service Taker</th>
                                    <th>Service Provider</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Fetch orders from the database and join with service taker and service provider tables
                                $query = "SELECT b.id, st.firstname AS taker_firstname, st.lastname AS taker_lastname,
                                                sp.firstname AS provider_firstname, sp.lastname AS provider_lastname,
                                                b.date, b.status
                                          FROM bookings b
                                          INNER JOIN servicetaker st ON b.service_taker_id = st.id
                                          INNER JOIN serviceprovider sp ON b.service_provider_id = sp.id";
                                $result = mysqli_query($con, $query);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $orderId = $row['id'];
                                    $takerName = $row['taker_firstname'] . ' ' . $row['taker_lastname'];
                                    $providerName = $row['provider_firstname'] . ' ' . $row['provider_lastname'];
                                    $date = $row['date'];
                                    $status = $row['status'];
                                ?>

                                    <tr>
                                        <td><?php echo $orderId; ?></td>
                                        <td><?php echo $takerName; ?></td>
                                        <td><?php echo $providerName; ?></td>
                                        <td><?php echo $date; ?></td>
                                        <td class="status <?php echo strtolower($status); ?>"><?php echo $status; ?></td>
                                        <td>
                                            <form method="POST">
                                                <input type="hidden" name="order_id" value="<?php echo $orderId; ?>">
                                                <select name="new_status">
                                                    <option value="confirmed">Confirmed</option>
                                                    <option value="pending">Pending</option>
                                                    <option value="rejected">Rejected</option>
                                                </select>
                                        
                                            <button type="submit" name="change_status">Change Status</button>
                                            <button type="submit" name="delete_order" class="delete">Delete</button>

                                            </form>
                                        </td>
                                    </tr>

                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
        </div>
    </div>

    <?php
    include 'includes/footer.php';
    ?>
</body>

</html>