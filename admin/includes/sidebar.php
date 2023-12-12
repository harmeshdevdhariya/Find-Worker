<?php
// session_start();

$con = mysqli_connect("localhost", "root", "", "findworker");

if (!isset($_SESSION["admin"])) {
  header("Location: index.php"); // Redirect to the login page
  exit();
}
$con = mysqli_connect("localhost", "root", "", "findworker");
$email = $_SESSION['admin'];
$findresult = mysqli_query($con, "SELECT * FROM admin WHERE username= '$email'");
if ($res = mysqli_fetch_array($findresult)) {

    $uname = $res['username'];
    $image = $res['image'];

}
?>


<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminPanel</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image text-center">
        <img src="adminimg/<?php echo $image; ?>" class="img-circle elevation-3" alt="Admin Image" style="width: 100px; height: 100px;"> <!-- Modify image size here -->
        <br>
        <span class="d-block" style="color: white; font-weight: bold;">Hellow!😊 <?php echo $uname; ?></span> <!-- Modify text color and font-weight here -->
    </div>
</div>


    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="home.php" class="nav-link ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              <!-- <i class="right fas fa-angle-left"></i> -->
            </p>
          </a>

        </li>



        <li class="nav-item">
          <a href="alladmins.php" class="nav-link">
            <i class=" nav-icon far fa-solid fa-user"></i>
            <p>
              All Admins
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="manageorder.php" class="nav-link">
            <i class=" nav-icon far fas fa-cart-arrow-down"></i>
            <p>
              Manage-Order
            </p>
          </a>
        </li>
    
        <li class="nav-item">
          <a href="category.php" class="nav-link">
            <i class=" nav-icon fas fa-book"></i>
            <p>
               Services
              <!-- <i class="fas fa-angle-left right"></i> -->
            </p>
          </a>

        </li>
        <li class="nav-item">
          <a href="addcategory.php" class="nav-link">
            <i class=" nav-icon fas fa-solid fa-folder-plus"></i>
            <p>
              Add Services
              <!-- <i class="fas fa-angle-left right"></i> -->
            </p>
          </a>

        </li>
        <li class="nav-item">
          <a href="aboutus.php" class="nav-link">
            <i class=" nav-icon fas fa-solid fa-address-card"></i>
            <p>
              About us
            </p>
          </a>

        </li>
        <li class="nav-item">
          <a href="feedback.php" class="nav-link">
            <i class=" nav-icon fas fa-solid fa-comment"></i>
            <p>
              Feedback
              <!-- <i class="fas fa-angle-left right"></i> -->
            </p>
          </a>

        </li>
        <li class="nav-item">
          <a href="logout.php" class="nav-link">
            <i class=" nav-icon fas fa-solid fa-outdent"></i>
            <p>
              LOGOUT
              <!-- <i class="fas fa-angle-left right"></i> -->
            </p>
          </a>

        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>