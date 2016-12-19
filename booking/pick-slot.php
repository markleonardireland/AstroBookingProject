<?php
include_once( $_SERVER['DOCUMENT_ROOT'] . '/db-connect.php' );

$db = new DB();

session_start();
if(isset($_SESSION["username"])){
    $username = $_SESSION["username"];
    
    $result = $db->query("SELECT * FROM `users` WHERE username = '".$username."'  LIMIT 1");
if (mysql_num_rows($result) == 1) {
                $userdetails = $db->fetch_assoc($result);
                $unique_location_id  = $userdetails['unique_location_id'];
                $accesslevel = $userdetails['access_level'];
                $username = $userdetails['username'];
                
                
             
}
}


if (!empty($_GET["date"])) {
                
                $day = $_GET['date'];
                $day = date("D", strtotime($_GET['date']));
                
} else {
                $day = date("D");
}

$day = strtolower($day);

$search_chosen_location = $_GET['searchchosenlocation'];

$result1 = $db->query("SELECT * FROM `locations` WHERE name = '".$search_chosen_location."'  LIMIT 1");
if (mysql_num_rows($result1) == 1) {
                $locationId = $db->fetch_assoc($result1);
                $unique_location_id  = $locationId['unique_location_id'];
                $price = $locationId['price'];
                
}

$result = $db->query("SELECT * FROM `opening_times` WHERE unique_location_id = '".$unique_location_id."' AND day = '" . $day . "' LIMIT 1");

if (mysql_num_rows($result) == 1) {
                $openingTimes = $db->fetch_assoc($result);
                $start        = $openingTimes['opening'];
                $start_arr    = explode(":", $start);
                $end          = $openingTimes['closing'];
                $end_arr      = explode(":", $end);
}
// opening and closing times


/*Create an array of timeslots.*/

$arrayLength = ($end_arr[0] - $start_arr[0]);
/*Set the local timezone*/
date_default_timezone_set('GMT');
/*The while loop populates the array with half hour times*/
$i         = 0; //the counter
$timeArray = array(); //declare the array
while ($i < $arrayLength) {
                if (($i % 2) == 0) { //if the time is even
                                $time = $start_arr[0] + ($i); //since each slot is a half hour, multiply by 1/2 to find the hour we're adding
                                if ($time < 12) { //figure out if it's morning
                                                $suffix = ' am';
                                } else {
                                                if ($time > 12) {
                                                                $time -= 12; //remove 12 hours to fit the 12 hour clock
                                                }
                                                $suffix = ' pm';
                                }
                                $count = strval($time); //convert to string
                                $count .= ':00' . $suffix; //add the :00 and am/pm
                                $timeArray[$i] = $count;
                } else { //if the time is odd
                                $time = $start_arr[0] + ($i);
                                if ($time < 12) {
                                                $suffix = ' am';
                                } else {
                                                if ($time > 12.5) { //use 12.5 or 12:30 pm will with display as 0:30pm
                                                                $time -= 12;
                                                }
                                                $suffix = ' pm';
                                }
                                $count = $time; //take off the half hour
                                $count = strval($count); //convert to string
                                $count .= ':00' . $suffix; //add the :00 and am/pm
                                $timeArray[$i] = $count; //add the timeslot to the array
                }
                $i++;
}

if (!empty($_GET["date"])) {
                $chosen_date = $_GET['date'];
} else {
                $chosen_date = date("Y-m-d");
}

$location = $_GET['searchchosenlocation'];


$todays_date = date("Y-m-d");

$todays_timestamp    = strtotime($chosen_date);
$tomorrows_timestamp = strtotime($chosen_date . " +1 day");

$result      = $db->query('select * from bookedslots WHERE SlotTimestamp >= ' . $todays_timestamp . ' AND SlotTimestamp < ' . $tomorrows_timestamp . ' AND unique_location_id = '.$unique_location_id.';');
$bookedSlots = array();
while ($row = $db->fetch_assoc($result)) {
                $bookedSlots[] = $row['SlotTimestamp'];
}

$tableheader_date = date("l jS F", strtotime($chosen_date));


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
                <ul class="nav navbar-nav navbar-right">
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
                        <a class="page-scroll" href="login.php">Login</a>
                    </li>
                </ul>';
                }
                
                
                ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
   <header class="secondary-header">
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading"><?php echo $location; ?></h1></br></br>
               
			<?php
			include_once( $_SERVER['DOCUMENT_ROOT'] . '/search.php' );
				
				?></br></br>
	
               </div>
            </div>
        
    </header>
    <header>
        <div class="secondary-header-content">
            <div class="header-content-inner">
            
                
               
		<form method="get" action="booking/confirm-your-details.php">
			<table class="table">
				<tr> 
					<?php
						print '<td class="dayheader">' . $tableheader_date . '</td>';
						
						
						print '<td class="dayheader">Price</td>';
						
						print '<td class="dayheader">Choose your slot</td>';
						
						?> 
				</tr>
				<?php
					/*This while loop will print each row until we have one for each half hour as defined above*/
					$i = 0;
					while ($i < $arrayLength) {
					                /*The first cell contains the time*/
					                print '<tr><td class="timecol">' . $timeArray[$i] . '</td>';
					                
					                
					                
					                
					                print '<td class="timeslot">€'.$price.'</td>';
					                print '<td class="timeslot">';
					                /*Insert a function here to fill your table with data*/
					                $slot         = strtotime($chosen_date . ' ' . $timeArray[$i]);
					                $current_time = time();
					                
					                if ($current_time > $slot) {
					                                print 'unavailable';
					                } else if (!in_array($slot, $bookedSlots)) {
					                                print '<input type="radio" name="time" value="' . $slot . '" required/>';
					                }
					                
					                else {
					                                print 'Booked';
					                }
					                
					                print '</td></tr>';
					                
					                
					                
					                $i++;
					}
					?> 
			</table>
			<input type="hidden" name="uniquelocationid" value="<?php echo $unique_location_id; ?>"/>
			<input type="submit" class="btn btn-primary btn-lg" value="Book now"/>
		</form>
               

  
          
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