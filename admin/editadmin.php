<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "findworker");

if (!isset($_SESSION["admin"])) {
    header("Location: index.php"); // Redirect to the login page
    exit();
}

$alert = $_GET["alert"] ?? null; // Get the alert query parameter


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Example: Update admin details in the database
    $adminId = $_POST["admin_id"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if a new image was uploaded
    if ($_FILES['image']['size'] > 0) {
        // Image Upload
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $target_dir = "adminimg/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($image_tmp, $target_file);
    } else {
        // No new image uploaded, keep the existing image
        $image = $_POST["existing_image"];
    }

    // Update the data in the database
    $sql = "UPDATE admin SET username = '$username', password = '$password', image = '$image' WHERE id = $adminId";

    if (mysqli_query($con, $sql)) {
        // Redirect to the page with a success message
        header("Location: alladmins.php?alert=success1");
        exit();
    } else {
        // Handle the error, e.g., display an error message
        echo "Error: " . mysqli_error($con);
    }
}

// Fetch the admin details to pre-fill the form
if (isset($_GET["id"])) {
    $adminId = $_GET["id"];

    $sql = "SELECT * FROM admin WHERE id = $adminId";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        // Handle the case where admin with the given ID is not found
        header("Location: alladmins.php?alert=notfound");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Admin</title>
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

                    <center>
                        <h2>Edit Admin Details :</h2>
                    </center>
                    <div class="card-body p-0">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" required value="<?php echo $row["username"]; ?>">
                                </div>

                                <!-- Add an input field for image upload here -->
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" class="form-control-file">
                                    <!-- Hidden field to store the existing image name -->
                                    <input type="hidden" name="existing_image" value="<?php echo $row["image"]; ?>">
                                    <img src="adminimg/<?php echo $row['image']; ?>" alt="Admin Image" id="adminImage" style="max-width: 100%; max-height: 200px;">


                                </div>
                             
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="change_password.php?admin_id=<?php echo $adminId; ?>" class="btn btn-primary">Change Password</a>

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