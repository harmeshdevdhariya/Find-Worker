<?php
if (!isset($_SESSION['email'])) {
    header("Location:../login.php"); // Replace 'login.php' with your actual login page
    exit();
}

// require_once("config.php");

$con = mysqli_connect("localhost", "root" , "" , "findworker");
$email = $_SESSION['email'];
$findresult = mysqli_query($con, "SELECT * FROM serviceprovider WHERE email= '$email'");
if ($res = mysqli_fetch_array($findresult)) {

  $image = $res['image'];
}

?>
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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"
        rel="stylesheet">

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
    

</head> 
<body>
<style>
  .top-navbar .bg-light:hover > a.nav-link {
    color: red; /* Change the color to your desired hover color */
  }

  .profile-icon {
    display: inline-block;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    overflow: hidden;
    margin-right: 8px;
}

.profile-pic {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>
    <header class="top-navbar">
	
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		
		<div class="container-fluid">
			<a class="navbar-brand" href="index.php">
				<img src="images/logo.png" alt="" />
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-host" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbars-host">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
		
            <li class="nav-item"><a class="nav-link" href="mybookings.php">My Bookings</a></li>
					<li class="nav-item "><a class="nav-link" href="about.php">About Us</a></li>
					<li class="nav-item"><a class="nav-link " href="contactus.php">Contact Us</a></li>
          <li class="nav-item">
    <a class="nav-link" href="userdashboard/profile.php">
        <div class="profile-icon">
            <img src="<?php echo 'userdashboard/uploads/' .$image; ?>" class="profile-pic" alt="Profile Image">
        </div>
    </a>
</li>
				</ul>
			</div>
		</div>
	</nav>
</header>
</body>
</html>