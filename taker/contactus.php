<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location:../login.php"); // Replace 'login.php' with your actual login page
        exit();
    }

    ?>
<?php
$con = mysqli_connect("localhost", "root", "", "findworker");

$alert = ''; // Initialize the alert variable

if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $comments = $_POST['comments'];

    if ($firstname != "" && $lastname != "") {
        $query = "INSERT INTO feedback (firstname, lastname, email, phone, comment) VALUES ('$firstname', '$lastname', '$email', '$phone', '$comments')";

        $res = mysqli_query($con, $query);

        if ($res) {
            // Set a success alert
            $alert = '<div class="alert alert-success" role="alert">Feedback Sent Successfully!</div>';
        } else {
            // Set an error alert
            $alert = '<div class="alert alert-danger" role="alert">Something went wrong. Please try again.</div>';
        }
    }
}
?>
<!-- Add JavaScript to automatically remove the alert after 3 seconds -->
<script>
    setTimeout(function() {
        document.querySelector(".alert").style.display = "none";
    }, 3000); // 3000 milliseconds (3 seconds)
</script>
<?php
require '_nav.php'
?>
<!DOCTYPE html>
<html lang="en">

<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Site Metas -->
<title>Daily labor</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">

<!-- Site Icons -->
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
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

<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

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

    <!-- Start header -->
    <div id="contact" class="section wb">
        <div class="container">
            <div class="section-title text-center">

                <style>
                    h1.main-title {
                        text-align: center;
                        font-size: 48px;
                        background: linear-gradient(to right, #1ad80e, #cca30c);
                        -webkit-background-clip: text;
                        -webkit-text-fill-color: transparent;
                        animation: movingLightEffect 5s linear infinite;
                    }

                    @keyframes movingLightEffect {
                        0% {
                            text-shadow: none;
                        }

                        50% {
                            text-shadow: 0px 0px 8px rgba(255, 255, 255, 0.8),
                                0px 0px 16px rgba(255, 255, 255, 0.4),
                                0px 0px 32px rgba(255, 255, 255, 0.2),
                                0px 0px 64px rgba(255, 255, 255, 0.1);
                        }

                        100% {
                            text-shadow: none;
                        }
                    }
                </style>
                    <!-- Display the alert -->
    <?php echo $alert; ?>

                <h1 class="main-title">Need Help? Sure we are Online!</h1>
                <!-- <p class="lead">"Get in touch - We're just a click away from turning your ideas into reality!"</p> -->

                </style>

            </div><!-- end title -->

            <div class="row">
                <div class="col-xl-6 col-md-12 col-sm-12">
                    <div class="contact_form">
                        <div id="message"></div>
                        <form id="contactform" class="" action="contactus.php" name="contactform" method="post">
                            <div class="row row-fluid">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input type="text" name="firstname" id="first_name" class="form-control" placeholder="First Name">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input type="text" name="lastname" id="last_name" class="form-control" placeholder="Last Name">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Your Email">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Your Phone">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <textarea class="form-control" name="comments" id="comments" rows="6" placeholder="Give us more details.."></textarea>
                                </div>
                                <div class="text-center pd">
                                    <button type="submit" value="SEND" id="submit" name="submit" class="btn btn-light btn-radius btn-brd grd1 btn-block">SEND MESSAGE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- end col -->
                <div class="col-xl-6 col-md-12 col-sm-12">
                    <div class="map-box">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7432.86759171645!2d70.279185!3d21.333378!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bfd57b1119da71f%3A0x25ab0c664e83e710!2sKUDARAT%20FARM!5e0!3m2!1sen!2sin!4v1687834855193!5m2!1sen!2sin" width="600" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->



    <?php
    include('footer.php');
    ?>

    <!-- ALL JS FILES -->
    <script src="js/all.js"></script>

    <!-- Mapsed JavaScript -->
    <script src="js/mapsed.js"></script>
    <script src="js/01-custom-places-example.js"></script>
    <!-- ALL PLUGINS -->
    <script src="js/custom.js"></script>
</body>

</html>