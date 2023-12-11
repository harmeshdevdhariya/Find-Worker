<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "findworker";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission to update About Us content
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle form data and escape single quotes
    $service_taker_title = mysqli_real_escape_string($conn, $_POST["service_taker_title"]);
    $service_taker_content = mysqli_real_escape_string($conn, $_POST["service_taker_content"]);
    $service_provider_title = mysqli_real_escape_string($conn, $_POST["service_provider_title"]);
    $service_provider_content = mysqli_real_escape_string($conn, $_POST["service_provider_content"]);
    $mission_content = mysqli_real_escape_string($conn, $_POST["mission_content"]);
    $vision_content = mysqli_real_escape_string($conn, $_POST["vision_content"]);
    $history_content = mysqli_real_escape_string($conn, $_POST["history_content"]);

    

    // Update About Us content in the database
    $updateQuery = "UPDATE about_us SET 
    service_taker_title = '$service_taker_title',
    service_taker_content = '$service_taker_content',
   
    provider_title = '$service_provider_title',
    provider_content = '$service_provider_content',
   
    mission_content = '$mission_content',
    vision_content = '$vision_content',
    history_content = '$history_content'";

    if (mysqli_query($conn, $updateQuery)) {
        $alert = "success";
    } else {
        $alert = "error";
    }
}

// Fetch the current About Us content from the database
$selectQuery = "SELECT * FROM about_us";
$result = mysqli_query($conn, $selectQuery);
$data = mysqli_fetch_assoc($result);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <title>About us </title>
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

    <style>
        textarea.form-control {
            height: auto;
            background-color: darkgray;
        }

        div.card {
            background: black;
        }

        label {
            color: yellow;
        }

        input.form-control {
            background-color: darkgray;
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
        <!-- Add your form here -->
        <div class="content-wrapper">
            <section class="content">
                <div class="card">
                    <center>
                        <h2 style="color:white;">Edit About Us Page :</h2>
                    </center>

                    <?php if (isset($alert) && $alert === "success") : ?>
                        <div class="alert alert-success" role="alert">Content updated successfully.</div>
                    <?php elseif (isset($alert) && $alert === "error") : ?>
                        <div class="alert alert-danger" role="alert">Error updating content.</div>
                    <?php endif; ?>
                    <form method="post" enctype="multipart/form-data">
                        
                        <div class="form-group">
                            <label for="service_taker_title">Service Taker Title</label>
                            <input type="text" class="form-control" id="service_taker_title" name="service_taker_title" value="<?= $data['service_taker_title'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="service_taker_content">Service Taker Content</label>
                            <textarea class="form-control" id="service_taker_content" name="service_taker_content" rows="4"><?= $data['service_taker_content'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="service_provider_title">Service Provider Title</label>
                            <input type="text" class="form-control" id="service_provider_title" name="service_provider_title" value="<?= $data['provider_title'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="service_provider_content">Service Provider Content</label>
                            <textarea class="form-control" id="service_provider_content" name="service_provider_content" rows="4"><?= $data['provider_content'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="mission_content">Mission Content</label>
                            <textarea class="form-control" id="mission_content" name="mission_content" rows="4"><?= $data['mission_content'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="vision_content">Vision Content</label>
                            <textarea class="form-control" id="vision_content" name="vision_content" rows="4"><?= $data['vision_content'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="history_content">History Content</label>
                            <textarea class="form-control" id="history_content" name="history_content" rows="4"><?= $data['history_content'] ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Content</button>
                    </form>
                </div>
            </section>
        </div>
    </div>


    <?php
    include 'includes/footer.php';
    ?>
</body>

</html>