<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "findworker");

if (!isset($_SESSION["admin"])) {
    header("Location: index.php"); // Redirect to the login page
    exit();
}

$alert = $_GET["alert"] ?? null; // Get the alert query parameter
$message = $_GET["message"] ?? null; // Get the message query parameter


?>
<!DOCTYPE html>
<html>

<head>
    <title>All Admins</title>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.10/css/jquery.dataTables.min.css">

    <!-- DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.11.10/js/jquery.dataTables.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Add this before </body> tag -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-4fqwz3FXz6p2S6jbpxY8Hf5fRkZz+9Jpo5HJd5fVv9zPK3KS5F5JsG5fF5fBdJ5++z" crossorigin="anonymous"></script>


</head>
<?php
include 'includes/header.php';

include 'includes/sidebar.php';
include 'includes/topbar.php';
?>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
        <div class="content-wrapper">
            <section class="content">
                <div class="card">
                <?php if ($alert === "success"): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Admin Deleted successfully!</strong> <?php echo urldecode($message); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<?php if ($alert === "success1"): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Admin Updated successfully!</strong> <?php echo urldecode($message); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<?php if ($alert === "success2"): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>New Admin Added successfully!</strong> <?php echo urldecode($message); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
                    <center><h2>All Admins :</h2></center>
                    <div class="card-body p-0">
                        <table id="adminTable" class="display" style="width:100%"><br><br>
                        <a href="addadmin.php" class="btn btn-primary">Add Admin</a> <!-- Link to add a new admin page -->
        <br><br>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Username</th>                                    
                                    <th>Action</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Database connection
                                $conn = mysqli_connect("localhost", "root", "", "findworker");

                                if (!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                }

                                // Fetch admins from the admin table
                                $sql = "SELECT * FROM admin";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td><img src='adminimg/" . $row['image'] . "' alt='Admin Image' width='100' height='100'></td>"; // Display the admin image
                                        echo "<td>" . $row['username'] . "</td>";
                                        echo '<td><a href="editadmin.php?id=' . $row['id'] . '"class="btn btn-warning">Edit</a></td>';
                                        echo '<td><a href="deleteadmin.php?id=' . $row['id'] . '"class="btn btn-danger">Delete</a></td>';
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No admins found.</td></tr>";
                                }

                                // Close the database connection
                                mysqli_close($conn);
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