  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>
  <?php

    session_start();

    $con = mysqli_connect("localhost", "root", "", "findworker");

    if (!isset($_SESSION["admin"])) {
        header("Location: index.php"); // Redirect to the login page
        exit();
    }

    $alert = $_GET["alert"] ?? null; // Get the alert query parameter

    ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Add Category</title>


      <!-- jQuery -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

      <!-- DataTables CSS -->
      <link rel="stylesheet" href="https://cdn.datatables.net/1.11.10/css/jquery.dataTables.min.css">

      <!-- DataTables JavaScript -->
      <script src="https://cdn.datatables.net/1.11.10/js/jquery.dataTables.min.js"></script>

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

      <?php
        include 'includes/header.php';

        include 'includes/sidebar.php';
        include 'includes/topbar.php';
        ?>

  </head>

  <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">

          <!-- Preloader -->
          <div class="preloader flex-column justify-content-center align-items-center">
              <img class="animation__shake" src="assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
          </div>

          <div class="content-wrapper">
              <!-- Content Header (Page header) -->
              <section class="content-header">
                  <div class="container-fluid">
                      <div class="row mb-2">
                          <div class="col-sm-6">
                              <h1>CATEGORY</h1>
                          </div>
                          <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                                  <li class="breadcrumb-item active">Addcategory</li>
                              </ol>
                          </div>
                      </div>
                  </div><!-- /.container-fluid -->
              </section>

              <!-- Main content -->
              <section class="content">
                  <?php
                    if ($alert === "success") {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Category inserted successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
                    } elseif ($alert === "error") {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Failed to insert category.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
                    }
                    ?>
                  <div class="row">
                      <div class="col-md-12">
                          <div class="card card-primary">
                              <div class="card-header">
                                  <h3 class="card-title">Manage Service Category</h3>
                                  <div class="card-tools">
                                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                          <i class="fas fa-minus"></i>
                                      </button>
                                  </div>
                              </div>
                              <div class="card-body">
                                  <form method="POST" action="insert_category.php" enctype="multipart/form-data">
                                      <div class="form-group">
                                          <label for="inputClientCompany">Add Image</label>
                                          <input type="file" name="image" id="inputClientCompany" class="form-control">
                                      </div>
                                      <div class="form-group">
                                          <label for="inputName">Add Service Name</label>
                                          <input type="text" name="servicetype" id="inputName" class="form-control">
                                      </div>
                                      <div class="form-group">
                                          <label for="inputDescription">Description</label>
                                          <textarea name="description" id="inputDescription" class="form-control" rows="4"></textarea>
                                      </div>
                                      <div class="form-group">
                                          <input type="submit" value="Create New Category" class="btn btn-success">
                                      </div>
                                  </form>
                              </div>
                              <!-- /.card-body -->
                          </div>
                          <!-- /.card -->
                      </div>
                  </div>
              </section>

              <!-- /.content -->
          </div>

          <?php
            include 'includes/footer.php';
            ?>
  </body>

  </html>