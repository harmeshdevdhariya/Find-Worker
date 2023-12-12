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
    <title>Feedback</title>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.10/css/jquery.dataTables.min.css">

    <!-- DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.11.10/js/jquery.dataTables.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        .card {
            margin: 10px;
        }
    </style>
</head>

<?php
include 'includes/header.php';

include 'includes/sidebar.php';
include 'includes/topbar.php';
?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>PEOPLE FEEDBACK</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <?php
                // Query to fetch feedback data
                $query = "SELECT * FROM feedback";
                $result = mysqli_query($con, $query);

                if (mysqli_num_rows($result) > 0) {
                    echo '<div class="row">';

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col-md-6">';
                        echo '<div class="card card-primary">';
                        echo '<div class="card-header">';
                        echo '<h3 class="card-title">' . $row["firstname"] . ' ' . $row["lastname"] . '</h3>';
                        echo '</div>';
                        echo '<div class="card-body">';
                        echo '<strong>Email: </strong>' . $row["email"] . '<br>';
                        echo '<strong>Phone: </strong>' . $row["phone"] . '<br>';
                        echo '<strong>Comment: </strong>' . $row["comment"];
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }

                    echo '</div>';
                } else {
                    echo '<p>No feedback available.</p>';
                }
                ?>
            </section>
        </div>
        <?php
        include 'includes/footer.php';
        ?>
    </div>
</body>

</html>
