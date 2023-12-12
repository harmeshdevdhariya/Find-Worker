<?php
	
	require '_nav.php';
	if (!isset($_SESSION['email'])) {
		header("Location:../../login.php"); // Replace 'login.php' with your actual login page
		exit();
	}

	?>
 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book worker</title>
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
    <link rel="shortcut icon" href="../../images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="../../images/apple-touch-icon.png">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Include Bootstrap JS (jQuery is required) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Site CSS -->
    <!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="../css/timeline.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- ALL VERSION CSS -->
    <link rel="stylesheet" href="../../css/versions.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="../../css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../css/custom.css">

    <!-- Modernizer for Portfolio -->
    <script src="../js/modernizer.js"></script>
    <script src="../js/all.js"></script>
    <script src="../js/custom.js"></script>
    <script src="../js/mapsed.js"></script>
    <script src="../js/timeline.min.js"></script>
    <script src="../js/01-custom-places-example.js"></script>

    <!-- 
    [if lt IE 9]>
         <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
         <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
       <![endif] -->

    <!-- calender link online -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="../css/bootstrap.min.css.map">
    <link href="../css/timeline.min.css.map">

    <script src="../js/all.js"></script>

    <style>
        /* Target only elements within the booking page */

        body {
            color: blue;
        }

        h2.dates {
            color: wheat;
        }

        p.card-text {
            color: blue;
        }

        .card-title {
            color: white;
        }

        /* Define a class to style selected dates */
        .fc-day.selected {
            background-color: green;
        }

        .book {
            margin-top: 30px;
            background-color: orangered;
            border-radius: 5%;
            color: white;
        }

        /* Define a CSS class for the hover effect */
        .book-hover:hover {
            background-color: orange;
            color: black;
        }


        .card-background {
            background-color: #f8f9fa;
        }

        p.card-text {
            color: white;
        }

        .col-md-8 {
            background-color: #8f8f8fb5;
        }

        ul.provider-info {
            padding: 0;
            list-style: none;
        }

        .provider-info-outer {
            background-color: #fff;
        }

        ul.provider-info li {
            padding: 15px;
            margin-bottom: 0;
            width: 50%;
            border-top: 1px solid #652020;
            border-right: 1px solid #4256d1;
            float: left;
            line-height: 20px;
        }

        .page-content ul li,
        .page-content ol li {
            padding: 0;
        }


        li {
            display: list-item;
            text-align: -webkit-match-parent;
        }

        ul {
            list-style: disc;
        }

        dl,
        ul,
        ol {
            list-style-position: outside;
            padding: 0;
        }

        ul {
            list-style-type: disc;
        }

        strong {
            color: blue;
        }

        span {
            color: #fb219d;
        }

        .col-md-9 {
            background-color: #1d161b;
        }

        .col-md-3 {
            background-color: #1d161b;
        }

        /* this style is for calender  */

        .fc-direction-ltr {
            background-color: white;
            direction: ltr;
            text-align: left;
        }
    </style>

    <?php
    $con = mysqli_connect("localhost", "root", "", "findworker");

    if (isset($_GET['provider_id'])) {
        $providerId = $_GET['provider_id'];

        // Fetch provider details based on provider ID
        $query = "SELECT * FROM serviceprovider WHERE id = '$providerId'";
        // Fetch user details based on user ID

        $result = mysqli_query($con, $query);

        if ($res = mysqli_fetch_array($result)) {
            // Fetch user details
            $fname = $res['firstname'];
            $lname = $res['lastname'];
            $image = $res['image'];
            $experience = $res['experience'];
            $educationlevel = $res['educationlevel'];
            $rupeecharge = $res['rupeecharge'];
            $gender = $res['gender'];
            $servicetype = $res['servicetype'];
            $phone = $res['phone'];
            $city = $res['city'];
            $description = $res['description'];
        } else {
            // Handle case where user details are not found
            // You can redirect to an error page or display a message
            echo "User details not found.";
        }
    } else {
        // Handle case where user ID is not provided
        // You can redirect to an error page or display a message
        echo "User ID not provided.";
    }
    ?>


    <script>
        var selectedDates = []; // Array to store selected dates

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek,dayGridDay'
                },
                // Fetch data using AJAX
                events: {
                    url: 'fetch_booking_data.php', // Replace with the actual URL of your PHP script
                    method: 'GET',
                    extraParams: {
                        provider_id: <?php echo $providerId; ?> // Get provider_id from PHP
                    },
                    failure: function() {
                        alert('Error fetching booking data.');
                    }
                },

                dateClick: function(info) {
                    var currentDate = new Date();
                    currentDate.setHours(0, 0, 0, 0); // Set current date to start of day
                    var clickedDate = new Date(info.dateStr);
                    clickedDate.setHours(0, 0, 0, 0); // Set clicked date to start of day

                    if (clickedDate < currentDate) { // Check if selected date is in the past
                        alert('You cannot select past dates.');
                    } else {
                        // Check if the clicked date has the 'fc-unavailable' class (unavailable)
                        var dayEl = info.dayEl;
                        if (dayEl.classList.contains('fc-unavailable')) {
                            alert('This date is unavailable and cannot be selected.');
                        } else {
                            // Handle the selection of available dates
                            var dateStr = info.dateStr;
                            var dateIndex = selectedDates.indexOf(dateStr);
                            if (dateIndex === -1) {
                                selectedDates.push(dateStr);
                            } else {
                                selectedDates.splice(dateIndex, 1);
                            }
                            updateSelectedDates(); // Update the UI to show selected dates

                            // Toggle the selected class on the clicked date cell
                            dayEl.classList.toggle('selected');
                        }
                    }
                }
            });

            calendar.render();

            function updateSelectedDates() {
                var events = [];
                selectedDates.forEach(function(dateStr) {
                    events.push({
                        title: 'Selected',
                        start: dateStr,
                        color: 'blue',
                    });
                });
                calendar.getEvents().forEach(function(event) {
                    if (event.title === 'Selected') {
                        event.remove();
                    }
                });
                calendar.addEventSource(events);
            }

            document.getElementById('bookButton').addEventListener('click', function() {
                if (selectedDates.length === 0) {
                    alert('Please select at least one date before booking.');
                } else {
                    // Update the hidden input field with the selected dates
                    document.getElementById('selectedDatesInput').value = JSON.stringify(selectedDates);
                    // Submit the form using JavaScript
                    document.getElementById('bookingForm').submit();
                }
            });
        });
    </script>
</head>

<body>

  
    <!-- LOADER -->
    <div id="preloader">
        <div class="loader-container">
            <div class="progress-br float shadow">
                <div class="progress__item"></div>
            </div>
        </div>
    </div>
    <!-- END LOADER -->

    <br><br><br>
    <div class="container">
        <!-- Display Service Provider Details using Bootstrap Card -->
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-3">

                    <img src=" <?php echo '../userdashboard/uploads/' . $image; ?>" class="" height=350px width=300px alt="Service Provider">
                </div>
                <div class="col-md-9">
                    <div class="card-body">
                        <h2 class="card-title"> <?php echo $fname, $lname ?> 'S DETAILS </h2>
                        <form id="bookingForm" action="handle_booking.php" method="post">

                            <input type="hidden" name="provider_id" value="<?php echo $providerId; ?>">

                            <!-- Hidden input field to store selected dates -->
                            <input type="hidden" id="selectedDatesInput" name="selected_dates" value="">

                            <!-- Display other relevant details in a table -->
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="table-primary">
                                        <th class="label-cell">NAME</th>
                                        <td class="info-cell"><?php echo $fname, $lname; ?></td>
                                    </tr>
                                    <tr class="table-secondary">
                                        <th class="label-cell">GENDER</th>
                                        <td class="info-cell">
                                            <?php
                                            if ($gender == 'M') {
                                                echo 'MALE';
                                            } elseif ($gender == 'F') {
                                                echo 'FEMALE';
                                            } elseif ($gender == 'O') {
                                                echo 'OTHER';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr class="table-primary">
                                        <th class="label-cell">SERVICETYPE</th>
                                        <td class="info-cell"><?php echo $servicetype; ?></td>
                                    </tr>
                                    <tr class="table-secondary">
                                        <th class="label-cell">WORK-EXPERIENCE</th>
                                        <td class="info-cell"><?php echo $experience; ?> YEARS</td>
                                    </tr>
                                    <tr class="table-primary">
                                        <th class="label-cell">EDUCATION</th>
                                        <td class="info-cell"><?php echo $educationlevel; ?></td>
                                    </tr>
                                    <tr class="table-secondary">
                                        <th class="label-cell">RUPPY CHARGES</th>
                                        <td class="info-cell"><?php echo $rupeecharge; ?> Rs</td>
                                    </tr>
                                    <tr class="table-secondary">
                                        <th class="label-cell">DESCRIPTION</th>
                                        <td class="info-cell"><?php echo $description; ?></td>
                                    </tr>

                                </tbody>
                            </table>


                            <center>
                                <h2 class="dates">Select The Dates From The Calender</h2>
                            </center>
                            <div id="calendar"></div>
                            <center><button type="button" class="book book-hover " id="bookButton">Book Now</button></center>
                        </form>
                        <!-- Add more fields as needed -->
                    </div>
                </div>
            </div>
        </div>




        <!-- Additional Details Section -->
        <div class="padding-20 margin-b-30 sf-rouned-box" id="sf-provider-address">
            <h1 class="bg-info text-white">
                <lable class="fa fa-map-marker"> OUR ADDRESS</lable>
            </h1>
            <div class="provider-info-outer">
                <ul class="provider-info clearfix no-margin equal-col-outer">
                    <li class="equal-col">
                        <i class="fa fa-map-marker"></i>
                        <strong>Address:</strong>
                        <span><?php echo $city ?></span>
                    </li>
                    <li class="equal-col">
                        <i class="fa fa-street-view"></i>
                        <strong>GPS:</strong>
                        <span>Your GPS Coordinates</span>
                    </li>
                    <li class="equal-col">
                        <i class="fa fa-phone"></i>
                        <strong>Telephone:</strong>
                        <span><?php echo $phone ?></span>
                    </li>
                    <li class="equal-col">
                        <i class="fa fa-envelope"></i>
                        <strong>Email:</strong>
                        <span><?php echo $email ?></span>
                    </li>
                    <li class="equal-col">
                        <i class="fa fa-fax"></i>
                        <strong>Fax:</strong>
                        <span>Your Fax Number</span>
                    </li>
                    <li class="equal-col">
                        <i class="fa fa-globe"></i>
                        <strong>Web:</strong>
                        <span>Your Website URL</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Add Booking Calendar and Form Here -->
        <br><br><br>
    </div>
    <!-- start footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3 class="about">About US</h3>
                        </div>

                        <p class="hd"> Integer rutrum ligula eu dignissim laoreet. Pellentesque venenatis nibh sed tellus faucibus
                            bibendum. Sed fermentum est vitae rhoncus molestie. Cum sociis natoque penatibus et magnis
                            dis montes harmesh devdhariya.</p>
                        <div class="footer-right">
                            <ul class="footer-links-soi">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-github"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            </ul><!-- end links -->
                        </div>
                    </div><!-- end clearfix -->
                </div><!-- end col -->

                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>Information Link</h3>
                        </div>
                        <ul class="footer-links">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Pricing</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Contact </a></li>
                        </ul><!-- end links -->
                    </div><!-- end clearfix -->
                </div><!-- end col -->

                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>Contact Details</h3>
                        </div>

                        <ul class="footer-links">
                            <li><a href="mailto:#">info@yoursite.com</a></li>
                            <li><a href="#">www.yoursite.com</a></li>
                            <li>PO Box 16122 Collins Street West Victoria 8007 Australia</li>
                            <li>+7863018932
                            </li>
                        </ul><!-- end links -->
                    </div><!-- end clearfix -->
                </div><!-- end col -->

            </div><!-- end row -->
            <hr class="hr3">
        </div><!-- end container -->
    </footer><!-- end footer -->
    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

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
    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    
    
    <!-- ALL JS FILES -->
    <script src="../js/all.js"></script>
    <!-- ALL PLUGINS -->
    <script src="../js/custom.js"></script>
    

</body>

</html>