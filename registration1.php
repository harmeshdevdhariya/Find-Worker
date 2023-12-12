<!-- first the service taker database code  -->
<?php
$abc = false;
$hds = false;

$con = mysqli_connect("localhost", "root", "", "findworker");

if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $city = $_POST['city'];

    // Image Upload
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $target_dir = "taker/userdashboard/uploads/";

    // Check whether this email exists
    $existSql = "SELECT * FROM `servicetaker` WHERE email = '$email'";
    $result = mysqli_query($con, $existSql);
    $numExistRows = mysqli_num_rows($result);

    if ($numExistRows > 0) {
        $abc = "Username Already Exists";
    } else {
        if ($firstname != "" && $lastname != "") {
            // Insert the record into the database
            $query = "INSERT INTO servicetaker VALUES('', '$firstname', '$lastname', '$email', '$password', '$phone', '$gender', '$city', '$image')";
            $res = mysqli_query($con, $query);

            if ($res) {
                $insertedId = mysqli_insert_id($con); // Get the ID of the inserted record

                // Rename and move the image file to the desired directory
                $new_image_name = $insertedId . "." . pathinfo($image, PATHINFO_EXTENSION);
                $target_file = $target_dir . $new_image_name;

                if (move_uploaded_file($image_tmp, $target_file)) {
                    // Image upload successful
                    // Update the image field in the database with the new image name
                    mysqli_query($con, "UPDATE servicetaker SET image='$new_image_name' WHERE id='$insertedId'");
                    $hds = true;
                } else {
                    // Image upload failed
                }
            } else {
                // Failed to insert record
            }
        }
    }
}
?>


<?php
$showAlert = false;
$showError = false;

if (isset($_POST['submit1'])) {
    $con = mysqli_connect("localhost", "root", "", "findworker");
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $city = $_POST['city'];
    $servicetype = $_POST['servicetype'];
    $description = $_POST['description'];
    $experience = $_POST['experience'];
    $language = $_POST['language'];
    $educationlevel = $_POST['educationlevel'];
    $rupeecharge = $_POST['rupeecharge'];

    // Image Upload
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $target_dir_provider = "provider/userdashboard/uploads/";
    $target_dir_taker = "taker/userdashboard/uploads/";

    // Check whether this email exists in service provider
    $existSqlProvider = "SELECT * FROM `serviceprovider` WHERE email = '$email'";
    $resultProvider = mysqli_query($con, $existSqlProvider);
    $numExistRowsProvider = mysqli_num_rows($resultProvider);

    // Check whether this email exists in service taker
    $existSqlTaker = "SELECT * FROM `servicetaker` WHERE email = '$email'";
    $resultTaker = mysqli_query($con, $existSqlTaker);
    $numExistRowsTaker = mysqli_num_rows($resultTaker);

    if ($numExistRowsProvider > 0 || $numExistRowsTaker > 0) {
        $showError = "Sorry, the email already exists.";
    } else {
        // Insert the record into the service provider table
        $queryProvider = "INSERT INTO serviceprovider (firstname, lastname, email, password, phone, gender, city, image, servicetype, description, experience, language, educationlevel, rupeecharge) VALUES ('$firstname', '$lastname', '$email', '$password', '$phone', '$gender', '$city', '', '$servicetype', '$description', '$experience', '$language', '$educationlevel', '$rupeecharge')";
        $resProvider = mysqli_query($con, $queryProvider);

        if ($resProvider) {
            $insertedIdProvider = mysqli_insert_id($con); // Get the ID of the inserted record

            // Rename and move the image file to the desired directory for service providers
            $new_image_name_provider = $insertedIdProvider . "." . pathinfo($image, PATHINFO_EXTENSION);
            $target_file_provider = $target_dir_provider . $new_image_name_provider;

            if (move_uploaded_file($image_tmp, $target_file_provider)) {
                // Update the image field in the database with the new image name for service providers
                // mysqli_query($con, "UPDATE serviceprovider SET image='$new_image_name_provider' WHERE id='$insertedIdProvider");

                // Insert the record into the service taker table
                $queryTaker = "INSERT INTO servicetaker (firstname, lastname, email, password, phone, gender, city, image) VALUES ('$firstname', '$lastname', '$email', '$password', '$phone', '$gender', '$city', '$new_image_name_provider')";
                $resTaker = mysqli_query($con, $queryTaker);

                $insertedIdTaker = mysqli_insert_id($con); // Get the ID of the inserted record for service takers

                // Rename and move the image file to the desired directory for service takers
                $new_image_name_taker = $insertedIdTaker . "." . pathinfo($image, PATHINFO_EXTENSION);
                $target_file_taker = $target_dir_taker . $new_image_name_taker;

                if (copy($target_file_provider, $target_file_taker)) {
                    // Update the image field in the database with the new image name for service takers
                    mysqli_query($con, "UPDATE servicetaker SET image='$new_image_name_taker' WHERE id='$insertedIdTaker'");
                    $showAlert = true;
                } else {
                    $showError = "Image upload for service taker failed.";
                }
            } else {
                $showError = "Image upload for service provider failed.";
            }
        } else {
            $showError = "Failed to insert record for service provider.";
        }
    }
}
?>
<!-- HTML Form Here -->



<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>user registration</title>

    <!-- Icons font CSS-->
    <link href="registrationcss/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="registrationcss/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="registrationcss/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="registrationcss/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="registrationcss/css/main.css" rel="stylesheet" media="all">

    <!-- this code is from index.php file headers for givin all files access -->
    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/icon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <!-- Site CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- ALL VERSION CSS -->
    <link rel="stylesheet" href="css/versions.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">


    <!-- Modernizer for Portfolio -->
    <script src="js/modernizer.js"></script>
    <!-- phone number validation on javascript -->
    <script>
        function validatePhoneNumber() {
            var phoneNumber = document.getElementById("phone").value;
            var pattern = /^\d{10}$/; // 10 digits only

            if (pattern.test(phoneNumber)) {
                alert("Valid phone number!");
            } else {
                alert("Invalid phone number! Please enter a 10-digit number.");
            }
        }
    </script>

    <!-- this code is for my check box tick logic  -->
    <style>
        #serviceProviderDetails {
            opacity: 0.5;
            font-weight: normal;
        }

        #serviceProviderDetails.bold {
            opacity: 1;
            font-weight: bold;
        }
    </style>
    <script>
        function toggleServiceProviderDetails() {
            var checkbox = document.getElementById("serviceProviderCheckbox");
            var serviceProviderDetails = document.getElementById("serviceProviderDetails");
            var inputs = serviceProviderDetails.getElementsByTagName("input");
            var select = serviceProviderDetails.getElementsByTagName("select")[0];

            if (checkbox.checked) {
                serviceProviderDetails.classList.add("bold");
                for (var i = 0; i < inputs.length; i++) {
                    inputs[i].disabled = false;
                }
                select.disabled = false;
            } else {
                serviceProviderDetails.classList.remove("bold");
                for (var i = 0; i < inputs.length; i++) {
                    inputs[i].disabled = true;
                }
                select.disabled = true;
            }
        }
    </script>

    <!-- end code of check box code logic -->

    <!-- start the image preview code -->
    <script>
        function previewImage(event) {
            var input = event.target;
            var preview = document.getElementById('preview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <!-- ending the image preview code -->
</head>

<body>

    <!-- this code is for navigation bar -->


    <?php
    require '_nav.php'
    ?>

    <!-- ending the code of navigation bar -->

    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <!-- dissmisible alert for data insert succesfully -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

        <?php
        if ($showAlert || $hds)
            echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created and you can login
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';

        if ($showError || $abc) {
            echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error! </strong> ' . $showError . ' ' . $abc . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> ';
        }
        ?>
        <!-- end alert -->
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">USER REGISTRATION FORM </h2>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <!-- FIRST NAME  -->
                        <div class="form-row">
                            <div class="name"><label for="first-name">First-Name</label></div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="name" id="first-name" name="firstname" placeholder="Enter-Your-First-Name">
                                </div>
                            </div>
                        </div>

                        <!-- LAST NAME -->

                        <div class="form-row">
                            <div class="name"><label for="last-name">Last-Name</label></div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="last-name" id="last-name" name="lastname" placeholder="Enter-Your-Last-Name">
                                </div>
                            </div>
                        </div>
                        <!-- USER EMAIL -->
                        <div class="form-row">
                            <div class="name"><label for="email">E-Mail</label></div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" placeholder="Enter-Your-Email-ID" id="email" type="email" name="email">
                                </div>
                            </div>
                        </div>

                        <!-- PASSWORD -->
                        <div class="form-row">
                            <div class="name"><label for="password">Password</label></div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" id="password" type="password" name="password" placeholder="Enter-Your-Password" />

                                </div>
                            </div>
                        </div>

                        <!--PHONE NUMBER  -->

                        <div class="form-row">
                            <div class="name"> <label for="phone">Phone Number:</label></div>
                            <div class="value">
                                <div class="input-group">

                                    <input class="input--style-5" type="tel" id="phone" placeholder="Enter-phone" name="phone" pattern="[0-9]{10}">
                                </div>
                            </div>
                        </div>
                        <!-- gender -->
                        <div class="form-row p-t-20">
                            <label class="label label--block">Choose Your Gender</label>
                            <div class="p-t-15">
                                <label class="radio-container m-r-55" for="male">Male
                                    <input type="radio" id="male" value="M" checked="checked" name="gender">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="radio-container m-r-55" for="female">Female
                                    <input type="radio" value="F" name="gender" id="female">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="radio-container" for="other">Other
                                    <input type="radio" name="gender" value="O" id="other">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>


                        <!-- address  -->
                        <div class="form-row">
                            <label for="city" class="name">city</label>
                            <select id="city" name="city">

                                <option value="Ahmedabad">Ahmedabad</option>
                                <option value="Surat">Surat</option>
                                <option value="Vadodara">Vadodara</option>
                                <option value="Junagadh">Junagadh</option>
                                <option value="Amreli">Amreli</option>
                                <option value="Gandhinagar">Gandhinagar</option>
                                <option value="Jamnagar">Jamnagar</option>
                                <option value="Bhavnagar">Bhavnagar</option>
                                <option value="Somanath">Somanath</option>
                                <!-- Add more cities here -->
                            </select>
                        </div>

                        <!-- end address -->


                        <!-- select the profile image -->
                        <div class="form-row">
                            <label for="image" class="name">Your image:</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                                <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)" required><br>
                                <img id="preview" src="#" alt="preview" style="max-width:200px; display:none;"><br>
                            </div>
                        </div>


                        <!-- first submission button  for service taker-->
                        <style>
                            .taker {
                                width: 1000px;
                            }
                        </style>
                        <div class="form-row">
                            <button class="btn btn--radius-2 btn--red taker" type="submit" onclick="validatePhoneNumber()" name="submit">Register With Service Taker </button>
                        </div>
                        <!-- database connection start -->


                        <!---------------------------------- now the second part is start------------------  -->

                        <!-- want to become service provider part -->
                        <div class="form-row">
                            <div class="">
                                <label for="serviceProvider" class="label">Want to become a service
                                    provider also?</label>
                            </div>
                            <div class="col-sm">
                                <div class="value">
                                    <div class="input-group">

                                        <input type="checkbox" id="serviceProviderCheckbox" name="serviceProvider" onclick="toggleServiceProviderDetails()">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-row p-t-20"> -->

                        <!-- ************* select the labor category *************** -->

                        <div id="serviceProviderDetails">
                            <div class="form-row">
                                <div class="name"> <label for="servicetype">Service Type:</label></div>
                                <div class="value">
                                    <div class="input-group">
                                        <class class="rs-select2 js-select-simple select--no-search">
                                            <select id="servicetype" name="servicetype" disabled>
                                                <?php

                                                // Query to fetch service types from the category table
                                                $query = "SELECT DISTINCT servicetype FROM categories";
                                                $result = mysqli_query($con, $query);

                                                // Check if there are service types to display
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo '<option value="' . $row['servicetype'] . '">' . $row['servicetype'] . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="">No service types found.</option>';
                                                }

                                                // Close the database connection
                                                mysqli_close($con);
                                                ?>
                                            </select>
                                        </class>
                                    </div>
                                </div>
                            </div>

                            <!--  user description -->
                            <div class="form-row">
                                <div class="name"><label for="discription">Description</label></div>
                                <div class="value">
                                    <div class="input-group">
                                        <div class="description-box" class="input--style-5" name="description">
                                            <h2>Service Provider Description</h2>
                                            <textarea name="description" id="discription" placeholder="Enter details about yourself"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- work experience -->
                            <div class="form-row">
                                <div class="name">
                                    <label for="experience">Experience:</label>
                                </div>
                                <div class="col-sm">
                                    <div class="value">
                                        <div class="input-group">

                                            <input type="number" class="form-control" id="experience" name="experience" placeholder="Enter Your Work Experience" min="0" disabled>
                                            <span class="years-symbol"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- language knowns -->

                            <div class="form-row">
                                <div class="name">

                                    <label for="language">Languges:</label>
                                </div>
                                <div class="col-sm">
                                    <div class="value">
                                        <div class="input-group">

                                            <input type="text" class="form-control" id="language" name="language" min="0" placeholder="Enter The Languages Which You Know" value="Hindi,English,Gujarati" disabled>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- education qualification -->

                            <div class="form-row">
                                <div class="name"> <label for="education-level">Education <br> Level:</label></div>
                                <div class="value">
                                    <div class="input-group">
                                        <class class="rs-select2 js-select-simple select--no-search">

                                            <select id="education-level" name="educationlevel">
                                                <option value="primary schools completion">primary schools completion</option>
                                                <option value="high-school-diploma">High School</option>
                                                <option value="bachelors-degree">Bachelor's Degree</option>
                                                <option value="masters-degree">Master's Degree</option>
                                                <option value="doctorate">Doctorate</option>
                                            </select>
                                        </class>
                                    </div>
                                </div>
                            </div>

                            <!-- service charges -->
                            <!-- work experience -->
                            <div class="form-row">
                                <div class="name">
                                    <label for="rupee-charge">Rupee Charge:</label>
                                </div>
                                <div class="col-sm">
                                    <div class="value">
                                        <div class="input-group">

                                            <input type="number" class="form-control" id="rupee-charge" name="rupeecharge" min="0" step="0.01" placeholder="Enter the Rupee charge amount" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
                <button class="btn btn--radius-2 btn--red" type="submit" onclick="validatePhoneNumber()" name="submit1">Registration With Both </button>
            </div>

            <!-- second submission -->



            <!-- database connection start  for second submit button-->


            </form>
        </div>
    </div>
    </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>


</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->