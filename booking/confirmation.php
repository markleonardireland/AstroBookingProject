<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/db-connect.php');

$db = new DB();

 $result1 = $db->query("SELECT * FROM `users` WHERE username = '".$username."' AND access_level = 'admin'  LIMIT 1");
    if (mysql_num_rows($result1) == 1) {
                    $adminuser_details = $db->fetch_assoc($result1);
                    $firstname  = $adminuser_details['firstname'];
                    $adminusername  = $adminuser_details['username']; 
                    $accesslevel  = $adminuser_details['access_level'];   
    	
}

$timestamp = $_POST['time'];


$date = date('d/m/Y', $timestamp);
$time = date('g:i a', $timestamp);

$todays_timestamp = time();

$result      = $db->query('select * from bookedslots WHERE SlotTimestamp >= ' . $todays_timestamp . ';');
$bookedSlots = array();
while ($row = $db->fetch_assoc($result)) {
                $bookedSlots[] = $row['SlotTimestamp'];
}

if ($todays_timestamp > $timestamp) {
					                                print 'unavailable';
					                } else if (in_array($timestamp, $bookedSlots)) {
					                                print 'unavailable';
					                }
					                
					                else {

$first_name = $db->escape($_POST['fname']);
$last_name = $db->escape($_POST['lname']);
$email_address = $db->escape($_POST['email']);
$time = $db->escape($_POST['time']);
$member_id = $db->escape($_POST['memberid']);
$contact_number = $db->escape($_POST['contactnumber']);
$location = $db->escape($_POST['location']);
$price = $db->escape($_POST['price']);
$booking_time = date("Y-m-d H:i:s");
$uniquelocationid = $db->escape($_POST['uniquelocationid']);
 
$sql="INSERT INTO bookedslots (unique_location_id, member_id, FirstName, LastName, Email, contact_number, SlotTimestamp, Location, price, bookingtime)
VALUES ('$uniquelocationid','$member_id','$first_name','$last_name','$email_address','$contact_number', '$time', '$location', '$price', '$booking_time')";
 
if (!$db->query($sql))
  {
  die('Error: ' . $db->error());
  }

 
$db->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Astro Booking</title>

    <base href="https://teamproject-x14562027.c9users.io/" />
    <!-- Bootstrap Core CSS -->
    
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/creative.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Astro Booking</a>
              
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php 
                
                if(isset($_SESSION["username"]) && $accesslevel == "member"){
                
                print '<ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="https://teamproject-x14562027.c9users.io/">Home</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="members-dashboard.php">Members Area</a>
                    </li>
                    
                    <li>
                        <a class="page-scroll" href="logout.php">Logout</a>
                    </li>
                </ul>';}else if(isset($_SESSION["username"]) && $accesslevel == "pitch"){
                
                print '<ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="https://teamproject-x14562027.c9users.io/">Home</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="pitch-dashboard.php?locationid='.$unique_location_id.'">Pitch Area</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="logout.php">Logout</a>
                    </li>
                </ul>';}else if(isset($_SESSION["username"]) && $accesslevel == "admin"){
                
                print '<ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="https://teamproject-x14562027.c9users.io/">Home</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="admin/admin-dashboard.php">Admin Area</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="logout.php">Logout</a>
                    </li>
                </ul>';}
                
                
                else {
                    
                     print '<ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="https://teamproject-x14562027.c9users.io/">Home</a>
                    </li>
                    
                    <li>
                        <a class="page-scroll" href="login.php">Logout</a>
                    </li>
                </ul>';
                }
                
                
                ?>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
     <header>
    <div class="header-content">
            <div class="header-content-inner">
                <h3>Your booking has been confirmed</h3>
                <p>To view all your booking go to the members area</p>
                <p><a href="members-dashboard.php"class="btn btn-primary btn-lg">Member's Area</a></p>
    
    
    	</div>
		    
        </div>
        </header>
    
    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/creative.min.js"></script>

</body>

</html>