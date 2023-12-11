<!DOCTYPE html>
<html>

<head>
    <title>Agriculture user</title>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">


    <!-- Icons font CSS-->
    <!-- Site Icons -->
    <link rel="shortcut icon" href="../images/icon.ico" type="image/x-icon" />
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Include Bootstrap JS (jQuery is required) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Site CSS -->

    <link rel="stylesheet" href="style.css">
    <!-- ALL VERSION CSS -->
    <link rel="stylesheet" href="../css/versions.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/custom.css">

    <!-- Modernizer for Portfolio -->
    <script src="../js/modernizer.js"></script>

    <!--[if lt IE 9]>
         <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
         <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
       <![endif]-->

</head>
<!-- start header -->

<?php include '_nav.php' ?>

<?php
if (!isset($_SESSION['email'])) {
    header("Location:../../login.php"); // Replace 'login.php' with your actual login page
    exit();
}

?>
<!-- End header -->

<body class="host_version">
    <!-- LOADER -->
    <div id="preloader">
        <div class="loader-container">
            <div class="progress-br float shadow">
                <div class="progress__item"></div>
            </div>
        </div>
    </div>
    <!-- END LOADER -->
    <?php
    $selectedCategory = mysqli_real_escape_string($con, $_GET['category']);

    // Query to fetch the image path based on the selected category
    $imageQuery = "SELECT image FROM categories WHERE servicetype = '$selectedCategory'";
    $result = mysqli_query($con, $imageQuery);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        $categoryImage = $row['image'];
    }
    ?>

    <div class="all-title-box" style="background-image:  url(../../admin/uploads/<?php echo $categoryImage; ?>);">

        <div class="container text-center">
            <h1><?php echo $selectedCategory; ?></h1>
        </div>
    </div>



    <div id="overviews" class="section wb">
        <br><br>
        <div class="container">
            <div class="row">
                <div class="center">
                    <div class="form-container">

                        <!-- start the form of city -->
                        <form method="post">
                            <div class="form-row">
                                <h1><b><label for="city" class="name">CITY</label></h1></b>
                                <h2><select id="city" name="city">
                                        <option value="">All CITY</option>
                                        <!-- City options -->
                                        <option value="Ahmedabad" <?php echo isset($_POST['city']) && $_POST['city'] === 'Ahmedabad' ? 'selected' : ''; ?>>Ahmedabad</option>
                                        <option value="Surat" <?php echo isset($_POST['city']) && $_POST['city'] === 'Surat' ? 'selected' : ''; ?>>Surat</option>
                                        <option value="Vadodara" <?php echo isset($_POST['city']) && $_POST['city'] === 'Vadodara' ? 'selected' : ''; ?>>Vadodara</option>
                                        $_POST['city'] === 'Vadodara' ? 'selected' : ''; ?>>Vadodara</option>
                                        <option value="junagadh" <?php echo isset($_POST['city']) && $_POST['city'] === 'junagadh' ? 'selected' : ''; ?>>junagadh</option>
                                        <option value="Amreli" <?php echo isset($_POST['city']) && $_POST['city'] === 'Amreli' ? 'selected' : ''; ?>>Amreli</option>
                                        <option value="Gandhinagar" <?php echo isset($_POST['city']) && $_POST['city'] === 'Gandhinagar' ? 'selected' : ''; ?>>Gandhinagar</option>
                                        <option value="Jamnagar" <?php echo isset($_POST['city']) && $_POST['city'] === 'Jamnagar' ? 'selected' : ''; ?>>Jamnagar</option>
                                        <option value="Bhavnagar" <?php echo isset($_POST['city']) && $_POST['city'] === 'Bhavnagar' ? 'selected' : ''; ?>>Bhavnagar</option>
                                        <option value="Somanath" <?php echo isset($_POST['city']) && $_POST['city'] === 'Somanath' ? 'selected' : ''; ?>>Somanath</option>

                                        <!-- Add more cities here -->
                                    </select>
                                    <button type="submit">SEARCH</button>
                                </h2>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                // Database connection code
                $con = mysqli_connect("localhost", "root", "", "findworker");

                if (!$con) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Initialize variables for category and city filtering
                $selectedCategory = '';
                $selectedCity = '';

                // Check if a category is selected from the URL
                if (isset($_GET['category'])) {
                    $selectedCategory = mysqli_real_escape_string($con, $_GET['category']);
                }

                // Check if the city is selected from the dropdown
                if (isset($_POST['city']) && !empty($_POST['city'])) {
                    $selectedCity = mysqli_real_escape_string($con, $_POST['city']);
                }

                // Initialize the WHERE clause for filtering
                $whereClause = " WHERE 1=1 "; // 1=1 to ensure the first condition always starts with WHERE

                // Check if the city is selected
                if (!empty($selectedCity)) {
                    $whereClause .= " AND city = '$selectedCity'";
                }

                // Check if the category is selected
                if (!empty($selectedCategory)) {
                    $whereClause .= " AND servicetype = '$selectedCategory'";
                }

                // Construct the SQL query to fetch user profiles
                $sql = "SELECT * FROM serviceprovider" . $whereClause;

                // Execute the query and fetch the results
                $result = mysqli_query($con, $sql);

                // Display the user profiles
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col-lg-3 col-md-6 col-12">';
                        echo '<div class="our-team row-line">';
                        echo '<div class="team-img">';
                        echo '<div class="image-container">';
                        echo '<img src="../../provider/userdashboard/uploads/' . $row["image"] . '" alt="image" id="profile-pic">';
                        echo '</div>';
                        echo '</div>';

                        echo '<div class="">';
                        echo '<h5>' . $row["firstname"] . " " . $row["lastname"] . '</h5>';
                        echo '<span>' . "Work Experience: " . $row["experience"] . '</span>';
                        echo '<span>' . "Education Level: " . $row["educationlevel"] . '</span>';
                        echo '<span>' . "Ruppy Charge: " . $row["rupeecharge"] . ' Rs</span>';
                        echo '<a href="booking.php?provider_id=' . $row['id'] . '" class="btn btn-primary"><span>BOOK NOW</span></a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="col-12">';
                    echo "No user profiles found for the selected criteria.";
                    echo '</div>';
                }

                // Close the database connection
                mysqli_close($con);
                ?>
            </div>
        </div><!-- end row -->
    </div><!-- end container -->



    <!-- start footer -->


    <!-- ALL JS FILES -->
    <script src="js/all.js"></script>
    <!-- ALL PLUGINS -->
    <script src="js/custom.js"></script>
    <script src="js/timeline.min.js"></script>
    <script>
        timeline(document.querySelectorAll(".timeline"), {
            forceVerticalMode: 700,
            mode: "horizontal",
            verticalStartPosition: "left",
            visibleItems: 4
        });
    </script>
    <!-- ALL JS FILES -->
    <script src="../js/all.js"></script>
    <!-- ALL PLUGINS -->
    <script src="../js/custom.js"></script>

</body>

</html>
<?php
include('../footer.php');
?>