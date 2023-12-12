
<?php
session_start();

$con=mysqli_connect("localhost","root","","findworker");

    if(isset($_POST['login2']))
    {
        $eml=$_POST['email'];
        $Pwd=$_POST['password'];

        $query="SELECT * FROM serviceprovider WHERE email='$eml' && password='$Pwd'";

        $data=mysqli_query($con,$query);

        $total=mysqli_num_rows($data);
        // echo $total;

        if($total==1)
        {
            $_SESSION['email']=$eml;
            header("location:provider/index.php");
        }
        else
        {
          echo  ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Error! </strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> ';
        }
        
    }
    if(isset($_POST['login']))
    {
        $eml=$_POST['email'];
        $Pwd=$_POST['password'];

        $query="SELECT * FROM servicetaker WHERE email='$eml' && password='$Pwd'";

        $data=mysqli_query($con,$query);

        $total=mysqli_num_rows($data);
        // echo $total;

        if($total==1)
        {
            $_SESSION['email']=$eml;
            header("location:taker/index.php");
        }
        else
        {
           echo "invalid username or password login faild !";
        }
        
    }
?>

<html>
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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"
        rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="registrationcss/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="registrationcss/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="registrationcss/css/main.css" rel="stylesheet" media="all">

    <!-- this code is from index.php file headers for givin all files access -->
    

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
  <!-- styling using the chatgpt -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  
  
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background: url('images/login.jpg') no-repeat center center fixed;
      background-size: cover;
    }
    
    .login-form-container {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 113vh;
    }
    
    .login-form-wrapper {
      display: flex;
      justify-content: space-between;
      width: 1100px;
    }
    
    .login-form {
      width: 380px;
      background:rgb(200 213 227 / 50%);
      padding: 40px;
      border-radius: 8px;
      box-shadow: 0px 0px 20px #2eb7cc;
    }
    
    .login-form h2 {
      margin-bottom: 30px;
      text-align: center;
      color: #fff356;
    }
    
    .login-form img {
      display: block;
      margin: 0 auto 30px;
      max-width: 100%;
      height: auto;
    }
    
    .login-form .form-group {
      margin-bottom: 20px;
    }
    
    .login-form label {
      font-weight: bold;
      color: #1b00e5;
    }
    
    .login-form input[type="email"],
    .login-form input[type="password"] {
      width: 100%;
      padding: 12px;
      border: 1px solid #2000ff;
      border-radius: 4px;
    }
    
    .login-form button[type="submit"] {
      width: 100%;
      padding: 12px;
      background-color: #20c95d;
      border: none;
      color: #ffffff;
      font-weight: bold;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
 img.haru
    {
        border-style: solid;
        border-color:blue;
    }
    .login-form button[type="submit"]:hover {
      background-color: #0069d9;
    }
  </style>
</head>
<?php
  require '_nav.php';
  ?>
<body class="host_version">
  
  <div class="login-form-container">
 
    <div class="login-form-wrapper">
      <div class="login-form">
        <h2>Service Taker </h2>
     
        <img class="haru" src="images/service_finder.jpg" alt="Service Taker Image">
        <form  method="POST">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email"  placeholder="Enter E-Mail" name="email" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" placeholder="Enter Your Password" id="password" name="password" required>
          </div>
          <button type="submit" name="login" value="login">Login</button>
        </form>
      </div>
      
      <div class="login-form">
        <h2>Service Provider</h2>
        <img class="haru" src="images/service_provider.jpg">
        <form action="" method="POST">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Enter E-Mail" name="email" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Enter Your Password" name="password" required>
          </div>
          <button type="submit" name="login2" value="login">Login</button>

        </form>
<?php
 if(isset($msg))
{
  echo $msg;
}
?>
      </div>
    </div>
  </div>
  </body>
</html>
