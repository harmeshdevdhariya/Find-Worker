  <!-- Start header -->

  <?php
    session_start();
    require '_nav.php';
    if (!isset($_SESSION['email'])) {
        header("Location:../login.php"); // Replace 'login.php' with your actual login page
        exit();
    }

    ?>
  <?php
    // Establish a database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "findworker";

    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }


    $serviceTakerQuery = "SELECT service_taker_content,service_taker_title FROM about_us";
    $serviceTakerResult = mysqli_query($conn, $serviceTakerQuery);

    if ($serviceTakerRow = mysqli_fetch_assoc($serviceTakerResult)) {
        $service_taker_title = $serviceTakerRow['service_taker_title'];
        $serviceTakerContent = $serviceTakerRow['service_taker_content'];
    }

    // Fetch data for "SERVICE PROVIDER SIDE"
    $providerQuery = "SELECT provider_content,provider_title FROM about_us";
    $providerResult = mysqli_query($conn, $providerQuery);

    if ($providerRow = mysqli_fetch_assoc($providerResult)) {
        $providerContent = $providerRow['provider_content'];
        $providerTitle = $providerRow['provider_title'];
    }

    // Fetch data for "Mission"
    $missionQuery = "SELECT mission_content FROM about_us";
    $missionResult = mysqli_query($conn, $missionQuery);

    if ($missionRow = mysqli_fetch_assoc($missionResult)) {
        $missionContent = $missionRow['mission_content'];
    }

    // Fetch data for "Vision"
    $visionQuery = "SELECT vision_content FROM about_us";
    $visionResult = mysqli_query($conn, $visionQuery);

    if ($visionRow = mysqli_fetch_assoc($visionResult)) {
        $visionContent = $visionRow['vision_content'];
    }

    // Fetch data for "History"
    $historyQuery = "SELECT history_content FROM about_us";
    $historyResult = mysqli_query($conn, $historyQuery);

    if ($historyRow = mysqli_fetch_assoc($historyResult)) {
        $historyContent = $historyRow['history_content'];
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
  <title>Find Worker</title>
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

  <!-- [if lt IE 9]> -->
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <!-- <![endif] -->

  <!-- not important -->
  <!-- Include the required CSS file -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

  <!-- Include jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- Include the Owl Carousel JavaScript file -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>


  <style>
      .container2 {
          font-family: Arial, sans-serif;
          background-color: #0d000357;
          max-width: 1500px;
          margin: 0 auto;
          padding: 20px;

          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }



      .workflow {
          display: flex;
          align-items: center;
          justify-content: space-between;
          margin: 20px 0;
          padding: 20px;
          border: 2px solid #ccc;
          border-radius: 8px;
          background-color: #509a90;
      }

      .workflow-step {
          text-align: center;

      }

      .workflow-step h3 {
          font-size: 24px;
          color: white;
      }

      .workflow-step p {
          font-size: 16px;

      }

      .workflow-arrow {
          flex: 1;
          text-align: center;
      }

      .workflow-arrow::before {
          content: "\2192";
          /* Right arrow unicode character */
          font-size: 24px;
          color: #333;
      }
  </style>
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


      <div class="all-title-box">
          <div class="container text-center">
              <h1>About Us<span class="m_1">HERE YOU CAN SHOW OUR COMMUNITY SUCCESS AND OUR HARD WORK.</span></h1>
          </div>
      </div>

      <div id="harubha" class="section lb">
          <div class="container">
              <div class="section-title row text-center">
                  <div class="col-md-8 offset-md-2">
                      <h3>About</h3>
                      <p class="lead">Here you can show our project parts and how to work project on internet.</p>
                  </div>
              </div><!-- end title -->

              <div class="row align-items-center">
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                      <div class="message-box">
                          <h2><?php echo $service_taker_title ?></h2>
                          <p><?php echo $serviceTakerContent; ?></p>
                      </div><!-- end messagebox -->
                  </div><!-- end col -->

                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                      <div class="post-media wow fadeIn">
                          <img src="images/finder.jpg" alt="Service Provider Image" class="img-fluid img-rounded">

                      </div><!-- end media -->
                  </div><!-- end col -->
              </div>
              <div class="row align-items-center">
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                      <div class="post-media wow fadeIn">
                          <img src="images/service_provider.jpg" alt="Service Provider Image" class="img-fluid img-rounded">
                      </div><!-- end media -->
                  </div><!-- end col -->

                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                      <div class="message-box">
                          <h2><?php echo $providerTitle ?></h2>
                          <p><?php echo $providerContent; ?></p>

                          <p>
                          <h4>Efficient Schedule Management:</h4> Service providers can efficiently manage their schedules, ensuring they make the most of their available time.</p>
                      </div><!-- end messagebox -->
                  </div><!-- end col -->
              </div><!-- end row -->
          </div><!-- end container -->
      </div><!-- end section -->

      <div class="hmv-box">
          <div class="container">
              <div class="row">
                  <div class="col-lg-4 col-md-6 col-12">
                      <div class="inner-hmv">
                          <div class="icon-box-hmv"><i class="flaticon-achievement"></i></div>
                          <h3>Mission</h3>
                          <div class="tr-pa">M</div>
                          <p><?php echo $missionContent; ?></p>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-12">
                      <div class="inner-hmv">
                          <div class="icon-box-hmv"><i class="flaticon-eye"></i></div>
                          <h3>Vision</h3>
                          <div class="tr-pa">V</div>
                          <p><?php echo $visionContent; ?></p>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-12">
                      <div class="inner-hmv">
                          <div class="icon-box-hmv"><i class="flaticon-history"></i></div>
                          <h3>History</h3>
                          <div class="tr-pa">H</div>
                          <p><?php echo $historyContent; ?></p>
                      </div>
                  </div>
              </div>
          </div>
      </div>


      <div class="container2">
          <div class="section-title text-center">
              <h3 style="color: white; font-weight:bold;">How Find Worker Works</h3>
          </div>
          <div class="workflow">
              <div class="workflow-step">
                  <h3>Sign Up</h3>
                  <p>Create an account</p>
              </div>
              <div class="workflow-arrow"></div>
              <div class="workflow-step">
                  <h3>Select Service</h3>
                  <p>Choose the service</p>
              </div>
              <div class="workflow-arrow"></div>
              <div class="workflow-step">
                  <h3>Select city</h3>
                  <p>Choose your work place city</p>
              </div>
          </div>
          <div class="workflow">
              <div class="workflow-step">
                  <h3>Select Provider</h3>
                  <p>Match with your budget price providers select</p>
              </div>
              <div class="workflow-arrow"></div>
              <div class="workflow-step">
                  <h3>Choose Date</h3>
                  <p>Choosing the perticular date and book provider </p>
              </div>
              <div class="workflow-arrow"></div>
              <div class="workflow-step">
                  <h3>Wait For Respond</h3>
                  <p>Now wait for service provider response </p>
              </div>
          </div>
          <!-- Add more workflow steps as needed -->
      </div>
      <!-- our team  -->



      <div id="testimonials" class="parallax section db parallax-off" style="background-image:url('images/parallax_04.jpg');">
          <div class="container">
              <div class="section-title text-center">
                  <h3>Testimonials</h3>
                  <p>Here you can show our project Leader, Developers and Tester. They can be make the project very well.</p>
              </div><!-- end title -->

              <div class="row">
                  <div class="col-md-12 col-sm-12">
                      <div class="testi-carousel owl-carousel owl-theme">
                          <div class="testimonial clearfix">
                              <div class="testi-meta">
                                  <img src="images/harmesh.jpeg" alt="" class="img-fluid img-rounded ">
                                  <h4>HARMESH DEVDHARIYA</h4>
                              </div>
                              <div class="desc">
                                  <h3><i class="fa fa-quote-left"></i>Project Leader</h3>
                                  <p class="lead">
                                      Strong project management skills and Excellent communication and leadership abilities.strategic thinking and problem-solving skills.he'll be in charge of setting project goals, timelines, and ensuring that everyone is aligned with the project's mission and vision.</p>
                              </div>
                              <!-- end testi-meta -->
                          </div>
                          <!-- end testimonial -->

                          <div class="testimonial clearfix">
                              <div class="testi-meta">
                                  <img src="images/ruchit.jpg" alt="" class="img-fluid ">
                                  <h4>RUCHIT KARDANI</h4>
                              </div>
                              <div class="desc">
                                  <h3><i class="fa fa-quote-left"></i>Web Developer</h3>
                                  <p class="lead">Web developers are the backbone of the project, responsible for bringing the platform to life.
                                      They will use their coding expertise to design and develop the website or application, implementing the necessary features, such as user profiles, scheduling systems, and secure payment options.</p>
                              </div>
                              <!-- end testi-meta -->
                          </div>
                          <!-- end testimonial -->
                          <div class="testimonial clearfix">
                              <div class="testi-meta">
                                  <img src="images/vijay.jpg" alt="" class="img-fluid">
                                  <h4>VIJAY GHODADRA</h4>
                              </div>
                              <div class="desc">
                                  <h3><i class="fa fa-quote-left"></i>Tester</h3>
                                  <p class="lead">Testers play a vital role in ensuring the quality and reliability of the platform. They will rigorously test all aspects of the website or app, identifying and reporting any bugs or issues. </p>
                              </div>
                              <!-- end testi-meta -->
                          </div>
                          <!-- end testimonial -->
                      </div><!-- end testi-carousel -->
                  </div><!-- end col -->
              </div><!-- end row -->
          </div>
      </div>
      <?php
        include('footer.php');
        ?>
  </body>

  </html>