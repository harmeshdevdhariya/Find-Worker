<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "findworker");

if (!isset($_SESSION["admin"])) {
    header("Location: index.php"); // Redirect to the login page
    exit();
}

$alert = $_GET["alert"] ?? null; // Get the alert query parameter

// Initialize variables to store category details
$categoryId = null;
$category = null;
$image11 = "";
$servicetype = "";
$description = "";

// Check if the category ID is provided in the URL
if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];

    // Retrieve category details based on ID
    $query = "SELECT * FROM categories WHERE id = $categoryId";
    $result = mysqli_query($con, $query);
    $category = mysqli_fetch_assoc($result);

    if ($category) {
        $image1 = $category['image'];
        $servicetype = $category['servicetype'];
        $description = $category['description'];
    } else {
        // Handle category not found
        header("Location: category.php"); // Redirect to category list page
        exit();
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $newServicetype = $_POST["servicetype"];
    $newDescription = $_POST["description"];

    // Image Upload
    if ($_FILES['image']['name'] != "") {
        $newImage = $_FILES['image']['name'];
        $newImageTmp = $_FILES['image']['tmp_name'];
        $targetDir = "uploads/";
        $newImageName = $categoryId . "." . pathinfo($newImage, PATHINFO_EXTENSION);
        $targetFile = $targetDir . $newImageName;

        // Update category details in the database
        $updateQuery = "UPDATE categories SET servicetype = '$newServicetype', description = '$newDescription', image = '$newImageName' WHERE id = $categoryId";
        $updateResult = mysqli_query($con, $updateQuery);

        if ($updateResult) {
            // Move the new image to the target directory
            if (move_uploaded_file($newImageTmp, $targetFile)) {
                // Set success alert
                $alert = "success";
            } else {
                // Error moving the uploaded file
                $alert = "error";
                $errorMsg = "Error moving the uploaded file to the target directory.";
            }
        } else {
            // Database update failed
            $alert = "error";
            $errorMsg = "Failed to update category in the database.";
        }
    } else {
        // If no new image is provided, update only text fields
        $updateQuery = "UPDATE categories SET servicetype = '$newServicetype', description = '$newDescription' WHERE id = $categoryId";
        $updateResult = mysqli_query($con, $updateQuery);

        if ($updateResult) {
            // Set success alert
            $alert = "success";
        } else {
            // Database update failed
            $alert = "error";
            $errorMsg = "Failed to update category in the database.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.10/css/jquery.dataTables.min.css">

    <!-- DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.11.10/js/jquery.dataTables.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


</head>

<?php
include 'includes/header.php';

include 'includes/sidebar.php';
include 'includes/topbar.php';
?>



<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>EDIT CATEGORY</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">EditCategory</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Service Category</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php
                                if ($alert === "success") {
                                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        Category updated successfully.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>';
                                } elseif ($alert === "error") {
                                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Failed to update category.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>';
                                }
                                ?>
                                <form method="POST" action="edit_category.php?id=<?php echo $categoryId; ?>" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <center><img src="uploads/<?php echo $image1; ?>" alt="Category Image" width="100"></center>
                                        <?php echo $image1 ?>;
                                        <label for="inputClientCompany">Update Image</label>
                                        <input type="file" name="image" id="inputClientCompany" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Update Service Name</label>
                                        <input type="text" name="servicetype" id="inputName" class="form-control" value="<?php echo $servicetype; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescription">Update Description</label>
                                        <textarea name="description" id="inputDescription" class="form-control" rows="4"><?php echo $description; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Update Category" class="btn btn-success">
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </section>
        </div>

        <?php
        include 'includes/footer.php';
        ?>
</body>

</html>