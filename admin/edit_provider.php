<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "findworker");

if (!isset($_SESSION["admin"])) {
    header("Location: index.php"); // Redirect to the login page
    exit();
}

// Check if the ID parameter is present in the URL
if (isset($_GET['id'])) {
    $serviceProviderId = $_GET['id'];

    // Query to fetch the service provider's details based on their ID
    $query = "SELECT * FROM serviceprovider WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $serviceProviderId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = mysqli_fetch_assoc($result)) {
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $email1 = $row['email'];
        $phone = $row['phone'];
        $city = $row['city'];
        $gender = $row['gender'];
        $oldemail = $row['email'];
        $servicetype = $row['servicetype'];
        $educationlevel = $row['educationlevel'];
        $description = $row['description'];
        $experience = $row['experience'];
        $language = $row['language'];
        $rupeecharge = $row['rupeecharge'];
        // Add more fields as needed

    } else {
        echo "Service provider not found.";
        exit(); // Exit if the service provider is not found
    }
} else {
    echo "Service provider ID not provided.";
    exit(); // Exit if the ID is not provided
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Service Provider</title>

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

                                <form method="post" enctype='multipart/form-data'>

                                    <?php
                                    if (isset($_POST['update_profile'])) {
                                        $fname = $_POST['firstname'];
                                        $lname = $_POST['lastname'];
                                        $phone = $_POST['phone'];
                                        $gender = $_POST['gender'];
                                        $city = $_POST['city'];
                                        $servicetype = $_POST['servicetype'];
                                        $educationlevel = $_POST['educationlevel'];
                                        $description = $_POST['description'];
                                        $experience = $_POST['experience'];
                                        $language = $_POST['language'];
                                        $rupeecharge = $_POST['rupeecharge'];

                                        // ... (your existing update code for other fields)

                                        $sql = "SELECT * FROM serviceprovider WHERE email='$email'";
                                        $res = mysqli_query($con, $sql);

                                        if (mysqli_num_rows($res) > 0) {
                                            $row = mysqli_fetch_assoc($res);

                                            if ($oldemail != $email) {
                                                if ($email == $row['email']) {
                                                    $error[] = 'Username already exists. Create a unique username';
                                                }
                                            }
                                        }

                                        // Update user details
                                        $result = mysqli_query($con, "UPDATE serviceprovider SET firstname='$fname',lastname='$lname',phone= '$phone', gender='$gender', city='$city', servicetype='$servicetype', description='$description', experience='$experience', language='$language', educationlevel='$educationlevel', rupeecharge='$rupeecharge' WHERE email='$email'");

                                        // Update image code
                                        if ($_FILES['image']['name'] != "") {
                                            $image = $_FILES['image']['name'];
                                            $image_tmp = $_FILES['image']['tmp_name'];
                                            $image_result = mysqli_query($con, "SELECT image FROM serviceprovider WHERE email='$email1'");
                                            $old_image = mysqli_fetch_assoc($image_result)['image'];

                                            // Remove the old image
                                            if ($old_image) {
                                                unlink("../provider/userdashboard/uploads/" . $old_image);
                                            }

                                            // Move the new image
                                            move_uploaded_file($image_tmp, "../provider/userdashboard/uploads/" . $image);

                                            // Update the image name in the database
                                            $image_update_result = mysqli_query($con, "UPDATE serviceprovider SET image='$image' WHERE email='$email1'");
                                            if ($image_update_result) {
                                                $_SESSION['status'] = "Profile and image updated successfully";
                                                $alert_class = "alert-success"; // Bootstrap class for success alert
                                            } else {
                                                $_SESSION['status'] = "Failed to update profile and image";
                                                $alert_class = "alert-danger"; // Bootstrap class for danger alert
                                            }
                                        } else {
                                            if ($result) {
                                                $_SESSION['status'] = "Profile updated successfully";
                                                $alert_class = "alert-success"; // Bootstrap class for success alert
                                            } else {
                                                $_SESSION['status'] = "Failed to update profile";
                                                $alert_class = "alert-danger"; // Bootstrap class for danger alert
                                            }
                                        }

                                        if (isset($_SESSION['status'])) : ?>
                                            <div class="alert <?php echo $alert_class; ?> mt-3">
                                                <?php echo $_SESSION['status']; ?>
                                            </div>
                                            <?php unset($_SESSION['status']); ?>
                                    <?php endif;
                                    }


                                    ?>

                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle" src="../provider/userdashboard/uploads/<?php echo $row['image']; ?>" alt="User profile picture">
                                        </div>

                                        <h3 class="profile-username text-center"><?php echo $firstname . " " . $lastname; ?></h3>
                                        <p class="text-muted text-center">Service provider</p>
                                    </div>
                                    <!-- Profile Update Form -->
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Update Profile</h3>
                                        </div>


                                        <div class="card-body">

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label for="input-file">Change image</label>
                                                    </div>
                                                    <div class="col">
                                                        <label for="input-file" class="btn btn-primary">Browse</label>
                                                        <input type="file" name="image" accept="image/jpeg, image/png, image/jpg" id="input-file" style="display: none;">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label for="firstname">First Name</label>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $firstname; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label for="lastname">Last Name</label>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $lastname; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label for="email">Email</label>
                                                    </div>
                                                    <div class="col">
                                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email1; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label for="phone">Phone</label>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label>Gender</label>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="gender" id="male" value="M" <?php if ($gender == 'M') echo 'checked'; ?>>
                                                            <label class="form-check-label" for="male">Male</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="gender" id="female" value="F" <?php if ($gender == 'F') echo 'checked'; ?>>
                                                            <label class="form-check-label" for="female">Female</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="gender" id="other" value="O" <?php if ($gender == 'O') echo 'checked'; ?>>
                                                            <label class="form-check-label" for="other">Other</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label for="city">City</label>
                                                    </div>
                                                    <div class="col">
                                                        <select class="form-control" id="city" name="city">
                                                            <option value="Ahmedabad" <?php if ($city === 'Ahmedabad') echo 'selected'; ?>>Ahmedabad</option>
                                                            <option value="Surat" <?php if ($city === 'Surat') echo 'selected'; ?>>Surat</option>
                                                            <option value="Junagadh" <?php if ($city === 'Junagadh') echo 'selected'; ?>>Junagadh</option>
                                                            <option value="Amreli" <?php if ($city === 'Amreli') echo 'selected'; ?>>Amreli</option>
                                                            <option value="Gandhinagar" <?php if ($city === 'Gandhinagar') echo 'selected'; ?>>Gandhinagar</option>
                                                            <option value="Jamnagar" <?php if ($city === 'Jamnagar') echo 'selected'; ?>>Jamnagar</option>
                                                            <option value="Bhavnagar" <?php if ($city === 'Bhavnagar') echo 'selected'; ?>>Bhavnagar</option>
                                                            <!-- Add more cities here if needed -->
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label for="servicetype">Service Type</label>
                                                    </div>
                                                    <div class="col">
                                                        <select name="servicetype" id="servicetype" class="form-control">
                                                            <?php
                                                            // Assuming you have a database connection established
                                                            $query = "SELECT servicetype FROM categories"; // Replace 'your_table' with your actual table name

                                                            $con = mysqli_connect("localhost", "root", "", "findworker");
                                                            $result = mysqli_query($con, $query);

                                                            if ($result) {
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    $serviceType = $row['servicetype'];
                                                                    $selected = ($servicetype === $serviceType) ? 'selected' : '';

                                                                    echo "<option value=\"$serviceType\" $selected>$serviceType</option>";
                                                                }
                                                            } else {
                                                                echo "<option value=''>No service types found</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label for="description">Description</label>
                                                    </div>
                                                    <div class="col">
                                                        <div class="input-group">
                                                            <textarea name="description" id="description" class="form-control" placeholder="Enter details about yourself"><?php echo $description; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label for="experience">Experience:</label>
                                                    </div>
                                                    <div class="col">
                                                        <div class="value">
                                                            <div class="input-group">
                                                                <input type="number" class="form-control" id="experience" name="experience" placeholder="Enter Your Work Experience" min="0" value="<?php echo $experience; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label for="language">Languages:</label>
                                                    </div>
                                                    <div class="col">
                                                        <div class="value">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="language" name="language" placeholder="Enter The Languages Which You Know" value="<?php echo $language; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label for="education-level">Education Level</label>
                                                    </div>
                                                    <div class="col">
                                                        <select name="educationlevel" id="education-level" class="form-control">
                                                            <option value="technical-training" <?php if ($educationlevel === 'technical-training') echo 'selected'; ?>>Primary Schools Completion</option>
                                                            <option value="high-school-diploma" <?php if ($educationlevel === 'high-school-diploma') echo 'selected'; ?>>High School</option>
                                                            <option value="bachelors-degree" <?php if ($educationlevel === 'bachelors-degree') echo 'selected'; ?>>Bachelor's Degree</option>
                                                            <option value="masters-degree" <?php if ($educationlevel === 'masters-degree') echo 'selected'; ?>>Master's Degree</option>
                                                            <option value="doctorate" <?php if ($educationlevel === 'doctorate') echo 'selected'; ?>>Doctorate</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label for="rupee-charge">Rupee Charge:</label>
                                                    </div>
                                                    <div class="col">
                                                        <div class="value">
                                                            <div class="input-group">
                                                                <input type="number" class="form-control" id="rupee-charge" name="rupeecharge" min="0" step="0.01" placeholder="Enter the Rupee charge amount" value="<?php echo $rupeecharge; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Add more fields as needed -->
                                            <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- End of Profile Update Form -->
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