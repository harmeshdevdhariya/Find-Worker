<?php
session_start();
require '_nav.php';
if (!isset($_SESSION['email'])) {
    header("Location:../login.php"); // Replace 'login.php' with your actual login page
    exit();
}

?>
<?php

$con = mysqli_connect("localhost", "root", "", "findworker");

if (isset($_POST["submit"])) {
    $uname = $_SESSION['email'];
    $old = $_POST["old"];
    $new = $_POST["new"];
    $repass = $_POST["repass"];
    $res = mysqli_query($con, "SELECT * FROM serviceprovider WHERE email='" . $uname . "' and Password='" . $old . "'");
    if (mysqli_num_rows($res)) {
        if ($new == $repass)
            mysqli_query($con, "UPDATE serviceprovider SET Password='" . $new . "' WHERE email='" . $uname . "'");
    } else {
        echo "Username Or Password Invalid";
    }
}
?>

<html>

<head>
    <title>Change Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background: #EAE9E5;
        }

        .login_form {
            width: 700px;
            margin-top: 0%;
            margin-bottom: 50px;
            background: #fff;
            padding: 30px;
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

        .errmsg {
            margin: 2px auto;
            border-radius: 5px;
            border: 1px solid red;
            background: pink;
            text-align: left;
            color: brown;
            padding: 1px;
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
    </style>
</head>

<body>

    <h1 style="text-align: center;">Change Password</h1>
    <div class="container1">
        <div class="row">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-6">
                <div class="login_form">

                    <form method="post" enctype='multipart/form-data' action="">

                        <div class="form-group">

                            <div class="row">
                                <div class="col-3">
                                    <label>password</label>
                                </div>
                                <div class="col">
                                    <input type="password" class="form-control" name="old" id="current-password" placeholder="Current password">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label>new password</label>
                                </div>
                                <div class="col">
                                    <input type="password" name="new" class="form-control" id="new-password" placeholder="New password">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label>confirm password</label>
                                </div>
                                <div class="col">
                                    <input type="password" class="form-control" name="repass" id="confirm-password" placeholder="Confirm password">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                            </div>
                            <div class="col-sm-6">
                                <input type="submit" class="btn btn-success" name="submit" value="Change Password" class="btn">
                            </div>
                        </div>


                </div>
            </div>
            </form>
        </div>
</body>

</html>
<?php
require('../footer.php');
?>