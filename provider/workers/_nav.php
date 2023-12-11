  <?php

session_start();
$con = mysqli_connect("localhost", "root" , "" , "findworker");
$email = $_SESSION['email'];

$findresult = mysqli_query($con, "SELECT * FROM serviceprovider WHERE email= '$email'");
if ($res = mysqli_fetch_array($findresult)) {

  $image = $res['image'];
}

?>

<!DOCTYPE html>
<html lang="en">

<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Site Metas -->
<title>find worker</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">

<!-- Site Icons -->
<link rel="shortcut icon" href="images/icon.ico" type="image/x-icon" />
<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Include Bootstrap JS (jQuery is required) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Bootstrap CSS -->

<link rel="stylesheet" href="css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
	integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="../css/bootstrap.min.css">
<!-- Site CSS -->
<link rel="stylesheet" href="../style.css">
<!-- ALL VERSION CSS -->
<link rel="stylesheet" href="../css/versions.css">
<!-- Responsive CSS -->
<link rel="stylesheet" href="../css/responsive.css">
<!-- Custom CSS -->
<link rel="stylesheet" href="../css/custom.css">

<!-- Modernizer for Portfolio -->
<script src="../js/modernizer.js"></script>
    <!-- Modernizer for Portfolio -->
    <script src="../js/modernizer.js"></script>
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
			<a class="navbar-brand" href="../index.php">
				<img src="../images/logo.png" alt="" />
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-host" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbars-host">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
		
        
            <li class="nav-item"><a class="nav-link" href="../mybookings.php">My Bookings</a></li>
					<li class="nav-item "><a class="nav-link" href="../about.php">About Us</a></li>
					<li class="nav-item"><a class="nav-link " href="../contactus.php">Contact Us</a></li>
          <li class="nav-item">
    <a class="nav-link" href="../userdashboard/profile.php">
        <div class="profile-icon">
            <img src="<?php echo '../userdashboard/uploads/' .$image; ?>" class="profile-pic" alt="Profile Image">
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