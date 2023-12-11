<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "findworker");

if (!isset($_SESSION["admin"])) {
    header("Location: index.php"); // Redirect to the login page
    exit();
}

$alert = $_GET["alert"] ?? null; // Get the alert query parameter

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Service Category</title>


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
<?php
// Your database connection code here
// Make a database connection and fetch data from the categories table
$con = mysqli_connect("localhost", "root", "", "findworker"); // Replace with your database credentials

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM categories";
$result = mysqli_query($con, $sql);
?>

<div class="wrapper">
    <!-- ... (Preloader and other parts of your template) ... -->

    <div class="content-wrapper">
        <!-- ... (Content Header and other parts of your template) ... -->

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card">
            <?php
if ($alert === "success") {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Category deleted successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
} elseif ($alert === "error") {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Category deletion failed.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
}
?>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Service Name</th>
                                <th>Service Image</th>
                                <th>Service Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>{$row['id']}</td>";
                                    echo "<td>{$row['servicetype']}</td>";
                                    echo "<td><img alt='Service Image' class='table-avatar' height=100px width=100px src='uploads/{$row['image']}'></td>";

                                    echo "<td>{$row['description']}</td>";
                                    echo "<td>";
                                    echo "<a href='edit_category.php?id={$row['id']}' class='btn btn-primary btn-sm'>Edit<i class='fas fa-pencil-alt'></i></a>";
                                    echo "<a class='btn btn-danger btn-sm' href='delete_category.php?id={$row['id']}'><i class='fas fa-trash'></i> Delete</a>";
    
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No categories found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
</div>

        <?php
        include 'includes/footer.php';
        ?>

</body>

</html>