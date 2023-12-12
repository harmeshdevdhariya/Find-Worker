<?php
session_start();
require '_nav.php';
if (!isset($_SESSION['email'])) {
    header("Location:../login.php"); // Replace 'login.php' with your actual login page
    exit();
}

$con = mysqli_connect("localhost", "root", "", "findworker");
$email = $_SESSION['email'];
$findresult = mysqli_query($con, "SELECT * FROM servicetaker WHERE email= '$email'");
if ($res = mysqli_fetch_array($findresult)) {

    $fname = $res['firstname'];
    $lname = $res['lastname'];
    $email = $res['email'];
    $phone = $res['phone'];
    $image = $res['image'];
    $gender = $res['gender'];
    $city = $res['city'];
    $oldemail = $res['email'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Profile</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Site Icons -->
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Include Bootstrap JS (jQuery is required) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap CSS -->

    <!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Site CSS -->
    <!-- <link rel="stylesheet" href="../style.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">



    <style>
        body {
            background: #b3d7ff;
        }

        label {
            display: inline-block;
            margin-bottom: 0.5rem;
            color: white;
        }

        .login_form {
            width: 1100px;
            margin-top: 0%;
            margin-bottom: 50px;
            background: #17a2b8;
            padding: 50px;
            box-shadow: 0px 1px 36px 5px rgba(0, 0, 0, 0.28);
            border-radius: 5px;
        }

        .form_btn {
            background: #fb641b;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2);
            border: none;
            color: #fff;
            width: 100%;
        }

        .lable_txt {
            font-size: 12px;
        }

        .form-control {
            border-radius: 25px;
            background-color: #000000;
            color: #fff;
        }

        .signup_form {
            background: #fff;
            padding-left: 25px;
            padding-right: 25px;
            padding-bottom: 5px;
            box-shadow: 0px 1px 36px 5px rgba(0, 0, 0, 0.28);
            border-radius: 5px;
        }

        .logo {
            height: 50px;
            width: auto;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-success {
            color: white;
            background-color: #ffc107;
            border-color: blue;
        }

        .errmsg {
            margin: 2px auto;
            border-radius: 5px;
            border: 1px solid red;
            background: pink;
            text-align: left;
            color: brown;
            padding: 1px;
        }

        textarea {
            overflow: auto;
            resize: vertical;
            background-color: black;
            color: #fff;
        }

        .form-check-label {
            margin-bottom: 0;
            color: rebeccapurple;
            font-weight: 600;
        }

        .successmsg {
            margin: 5px auto;
            border-radius: 5px;
            border: 1px solid green;
            background: #33CC00;
            text-align: left;
            color: white;
            padding: 10px;
        }

        .hero img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            margin-top: 40px;
            margin-bottom: 30px;
        }

        p.right {
            margin-left: 200px;
            font-size: 20px;
            color: brown;
        }
    </style>

</head>

<body>

    <div class="container">

        <center>
            <h1>My Profile</h1>
            <p class="right">Welcome, <?php echo  $fname, $lname ?></p>
        </center>
        <div class="row">
        </div>
        <div class="col-sm-6">

            <form action="" method="POST" enctype='multipart/form-data'>
                <div class="login_form">

                    <!-- code for the when hit the update details button which updating the details on the database -->
                    <?php
                    if (isset($_POST['update_profile'])) {
                        $fname = $_POST['firstname'];
                        $lname = $_POST['lastname'];
                        $phone = $_POST['phone'];
                        $gender = $_POST['gender'];
                        $city = $_POST['city'];

                        // ... (your existing update code for other fields)

                        $sql = "SELECT * FROM servicetaker WHERE email='$email'";
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
                        $result = mysqli_query($con, "UPDATE servicetaker SET firstname='$fname',lastname='$lname',phone= '$phone', gender='$gender', city='$city' WHERE email='$email'");

                        // Update image code
                        if ($_FILES['image']['name'] != "") {
                            $image = $_FILES['image']['name'];
                            $image_tmp = $_FILES['image']['tmp_name'];
                            $image_result = mysqli_query($con, "SELECT image FROM servicetaker WHERE email='$email'");
                            $old_image = mysqli_fetch_assoc($image_result)['image'];

                            // Remove the old image
                            if ($old_image) {
                                unlink("uploads/" . $old_image);
                            }

                            // Move the new image
                            move_uploaded_file($image_tmp, "uploads/" . $image);

                            // Update the image name in the database
                            $image_update_result = mysqli_query($con, "UPDATE servicetaker SET image='$image' WHERE email='$email'");
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

                    <!-- Fetch and display profile image -->
                    <div class="row">
                        <div class="col"></div>
                        <div class="col-6">
                            <center>
                                <div class="hero">
                                    <img src="<?php echo 'uploads/' . $image; ?>" id="profile-pic">

                                    <label for="input-file">Change image</label>
                                    <input type="file" name="image" accept="image/jpeg, image/png, image/jpg" id="input-file">
                                </div>
                                <script>
                                    let profilePic = document.getElementById("profile-pic");
                                    let inputFile = document.getElementById("input-file");

                                    inputFile.onchange = function() {
                                        profilePic.src = URL.createObjectURL(inputFile.files[0])
                                    }
                                </script>

                            </center>
                        </div>
                        <div class="col">
                            <p></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-3">
                                <label>First Name</label>
                            </div>
                            <div class="col">
                                <input type="text" name="firstname" value="<?php echo $fname; ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-3">
                                <label>Last Name</label>
                            </div>
                            <div class="col">
                                <input type="text" name="lastname" value="<?php echo $lname;  ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-3">
                                <label>Phone</label>
                            </div>
                            <div class="col">
                                <input type="text" name="phone" value="<?php echo $phone; ?>" class="form-control">
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
                                    <input class="form-check-input" type="radio" name="gender" value="F" id="female" <?php if ($gender == 'F') echo 'checked'; ?>>
                                    <label for="female" class="form-check-label">Female</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="other" name="gender" value="O" <?php if ($gender == 'O') echo 'checked'; ?>>
                                    <label class="form-check-label" for="other">Other</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- address -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-3">
                                <label>city</label>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <select id="city" name="city">
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
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6">
                            <button class="btn btn-success" name="update_profile">UPDATE PROFILE</button>
                        </div>
                    </div>
                    </>
                </div>
                <div class="col-sm-3">
                </div>
            </form>
        </div>

    </div>

</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

</html>
<?php
require('../footer.php');
?>