<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "findworker");

if (!isset($_SESSION["admin"])) {
    header("Location: index.php"); // Redirect to the login page
    exit();
}

$alert = $_GET["alert"] ?? null; // Get the alert query parameter

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle form data, including image upload, and insert the new admin into the database
    // Make sure to validate and sanitize user inputs before inserting into the database
    
    // Example: Insert new admin into the database
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Image Upload
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $target_dir = "adminimg/";
    $target_file = $target_dir . basename($image);
    move_uploaded_file($image_tmp, $target_file);
    
    // Insert the data into the database
    $sql = "INSERT INTO admin (username, password, image) VALUES ('$username', '$password', '$image')";
    
    if (mysqli_query($con, $sql)) {
        // Redirect to the page with a success message
        header("Location: alladmins.php?alert=success2");
        exit();
    } else {
        // Handle the error, e.g., display an error message
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Admin</title>
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
        <!-- Add your form here -->
        <div class="content-wrapper">
            <section class="content">
                <div class="card">
                    <center><h2>Add New Admin :</h2></center>
                    <div class="card-body p-0">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <!-- Add an input field for image upload here -->
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" class="form-control-file">
                                    
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
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

