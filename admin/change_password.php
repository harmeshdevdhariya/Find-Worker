<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "findworker");

if (!isset($_SESSION["admin"])) {
    header("Location: index.php"); // Redirect to the login page
    exit();
}

$adminId = isset($_GET["admin_id"]) ? $_GET["admin_id"] : null;
$alert = isset($_GET["alert"]) ? $_GET["alert"] : null;
$alert_message = ""; // Initialize the alert message

if (isset($_POST["submit"])) {
    $old = $_POST["old"];
    $new = $_POST["new"];
    $repass = $_POST["repass"];
    $res = mysqli_query($con, "SELECT * FROM admin WHERE id = $adminId and password = '$old'");
    if (mysqli_num_rows($res)) {
        if ($new == $repass) {
            mysqli_query($con, "UPDATE admin SET password = '$new' WHERE id = $adminId");
            $alert = "success"; // Set the success alert
            $alert_message = "Password changed successfully.";
        } else {
            $alert = "error"; // Set the error alert
            $alert_message = "New password and confirm password do not match.";
        }
    } else {
        $alert = "error"; // Set the error alert
        $alert_message = "Current password is incorrect.";
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Change Password</title>
    <?php
    include 'includes/header.php';

    include 'includes/sidebar.php';
    include 'includes/topbar.php';
    ?>
</head>
<body>

    <div class="content-wrapper">
        <section class="content">
            <div class="card">
                <div class="card-body p-0">
                    <?php if ($alert === "success") { ?>
                        <div class="alert alert-success">
                            <?php echo $alert_message; ?>
                        </div>
                    <?php } elseif ($alert === "error") { ?>
                        <div class="alert alert-danger">
                            <?php echo $alert_message; ?>
                        </div>
                    <?php } ?>
                    <form method="post" enctype='multipart/form-data' action="">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="old">Current Password</label>
                                <input type="password" name="old" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="new">New Password</label>
                                <input type="password" name="new" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="repass">Confirm Password</label>
                                <input type="password" name="repass" class="form-control" required>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" name="submit" class="btn btn-primary">Change Password</button>&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="editadmin.php?id=<?php echo $adminId; ?>" class="btn btn-warning">Back</a>
                        </div>

                    </form>



                </div>
            </div>
        </section>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>