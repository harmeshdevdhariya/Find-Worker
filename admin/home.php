<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "findworker");

if (!isset($_SESSION["admin"])) {
    header("Location: index.php"); // Redirect to the login page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.10/css/jquery.dataTables.min.css">

    <!-- DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.11.10/js/jquery.dataTables.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


</head>

<?php
include 'includes/header.php';

include 'includes/sidebar.php';
include 'includes/topbar.php';
?>



<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <?php
                        // Your database connection code here

                        // Query to count the total service takers
                        $query = "SELECT COUNT(*) as totalServiceTakers FROM servicetaker";
                        $result = mysqli_query($con, $query);

                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            $totalServiceTakers = $row['totalServiceTakers'];
                        } else {
                            $totalServiceTakers = 0;
                        }
                        ?>
                        <?php
                        // Your database connection code here

                        // Query to count the total service providers
                        $query = "SELECT COUNT(*) as totalServiceProviders FROM serviceprovider";
                        $result = mysqli_query($con, $query);

                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            $totalServiceProviders = $row['totalServiceProviders'];
                        } else {
                            $totalServiceProviders = 0;
                        }
                        ?>

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?php echo $totalServiceTakers; ?></h3>
                                    <p>SERVICE TAKER</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-solid fa-users"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-indigo">
                                <div class="inner">
                                    <h3><?php echo $totalServiceProviders; ?></h3>


                                    <p>SERVICE PROVIDER</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-solid fa-users"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <?php
                                    // Your database connection code here

                                    // Query to count the total pending orders
                                    $query = "SELECT COUNT(*) as totalPendingOrders FROM bookings WHERE status = 'pending'";
                                    $result = mysqli_query($con, $query);

                                    if ($result) {
                                        $row = mysqli_fetch_assoc($result);
                                        $totalPendingOrders = $row['totalPendingOrders'];
                                    } else {
                                        $totalPendingOrders = 0;
                                    }
                                    ?>

                                    <h3><?php echo $totalPendingOrders; ?></h3>

                                    <p>TOTAL PENDING ORDER</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <?php
                                    // Your database connection code here

                                    // Query to count the total confirmed orders
                                    $query = "SELECT COUNT(*) as totalConfirmedOrders FROM bookings WHERE status = 'confirmed'";
                                    $result = mysqli_query($con, $query);

                                    if ($result) {
                                        $row = mysqli_fetch_assoc($result);
                                        $totalConfirmedOrders = $row['totalConfirmedOrders'];
                                    } else {
                                        $totalConfirmedOrders = 0;
                                    }
                                    ?>

                                    <h3><?php echo $totalConfirmedOrders; ?></h3>

                                    <p>CONFIRM ORDER</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-solid fa-check"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <!-- ./col -->

                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <?php
                                    // Your database connection code here

                                    // Query to count the total rejected orders
                                    $query = "SELECT COUNT(*) as totalRejectedOrders FROM bookings WHERE status = 'rejected'";
                                    $result = mysqli_query($con, $query);

                                    if ($result) {
                                        $row = mysqli_fetch_assoc($result);
                                        $totalRejectedOrders = $row['totalRejectedOrders'];
                                    } else {
                                        $totalRejectedOrders = 0;
                                    }
                                    ?>

                                    <h3><?php echo $totalRejectedOrders; ?></h3>

                                    <p>REJECTED ORDER</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-solid fa-ban "></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-secondary">
                                <div class="inner">
                                    <?php
                                    // Database connection code
                                    $con = mysqli_connect("localhost", "root", "", "findworker");

                                    if (!$con) {
                                        die("Connection failed: " . mysqli_connect_error());
                                    }

                                    // Query to count the total categories
                                    $query = "SELECT COUNT(*) as totalCategories FROM categories";
                                    $result = mysqli_query($con, $query);

                                    if ($result) {
                                        $row = mysqli_fetch_assoc($result);
                                        $totalCategories = $row['totalCategories'];
                                    } else {
                                        $totalCategories = 0;
                                    }
                                    ?>

                                    <h3><?php echo $totalCategories; ?></h3>

                                    <p>TOTAL CATEGORIES</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-solid fa-database"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

    </div>

    <div class="content-wrapper">
        <!-- show the delete alert message -->

        <?php if (isset($_SESSION['status'])) : ?>
            <div class="alert <?php echo $alert_class; ?> mt-3">
                <?php echo $_SESSION['status']; ?>
            </div>
            <?php unset($_SESSION['status']); ?>
        <?php endif; ?>
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Service Taker Data</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover dataTable">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>City</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Fetch service taker data from your database
                                        $query = "SELECT * FROM servicetaker";
                                        $result = mysqli_query($con, $query);

                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['firstname']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['phone']; ?></td>
                                                <td><?php echo $row['city']; ?></td>
                                                <td>
                                                    <a href="view_taker.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">View</a>
                                                    <a href="edit_taker.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Update</a>
                                                    <a href="delete_taker.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Service Provider Data</h3>
                            </div>
                            <div class="card-body">
                                <?php if (isset($_SESSION['provider_status'])) : ?>
                                    <div class="alert <?php echo $provider_alert_class; ?> mt-3">
                                        <?php echo $_SESSION['provider_status']; ?>
                                    </div>
                                    <?php unset($_SESSION['provider_status']); ?>
                                <?php endif; ?>


                                <!-- show the service provider table  -->
                                <table id="example2" class="table table-bordered table-hover dataTable">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>City</th>
                                            <th>ServiceType</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Fetch service taker data from your database
                                        $query = "SELECT * FROM serviceprovider";
                                        $result = mysqli_query($con, $query);

                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['firstname']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['phone']; ?></td>
                                                <td><?php echo $row['city']; ?></td>
                                                <td><?php echo $row['servicetype']; ?></td>
                                                <td>
                                                    <a href="view_provider.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">View</a>
                                                    <a href="edit_provider.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Update</a>
                                                    <a href="delete_provider.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <script>
        $(document).ready(function() {
            $('#example2').DataTable();
        });
    </script>



    <?php
    include 'includes/footer.php';
    ?>
</body>

</html>