 <!--* pitch-dashboard.php-->
 <!--* Version 1-->
 <!--* Date e.g. 01/11/2016-->
 <!--* @reference http://www.allphptricks.com/simple-user-registration-login-script-in-php-and-mysqli/-->
 <!--* @reference http://www.allphptricks.com/insert-view-edit-and-delete-record-from-database-using-php-and-mysqli/-->
 <!--* @author Kevin O'Rourke x15042782 -->
<?php
    include_once( $_SERVER['DOCUMENT_ROOT'] . '/db-connect.php' );
    //include_once("db-connect.php");
    $db = new DB();
    
    include("auth.php");
    
    $username = $_SESSION["username"];
    
    
      $result = $db->query("SELECT * FROM `users` WHERE username = '".$username."'  LIMIT 1");
    if (mysql_num_rows($result) == 1) {
                    $userdetails = $db->fetch_assoc($result);
                    $unique_location_id  = $userdetails['unique_location_id'];
                    $accesslevel = $userdetails['access_level'];
                    $username = $userdetails['username'];
                    
                
    $locationid = $_GET['locationid']; 
    
     $all_pitches = $db->query("SELECT * FROM `locations` WHERE unique_location_id = '".$locationid."' LIMIT 1");
    if( mysql_num_rows($all_pitches) ==1){
    
        /** Get the table row */
        $row = $db->fetch_assoc($all_pitches);
        $pitch_name = $row['name'];
        $address = $row['address'];
        $owner = $row['owner'];
        $contact_number = $row['contact_number'];
        $email = $row['email'];
        $longitude = $row['longitude'];
        $latitude = $row['latitude'];
        $price = $row['price'];
        $unique_location_id = $row['unique_location_id'];
    }
    $current_time = time();
    
    $upcomingbookingquery = $db->query("SELECT * FROM `bookedslots` WHERE unique_location_id = '".$locationid."' AND SlotTimestamp > '".$current_time."' ORDER BY `SlotTimestamp`");
    $numofupcomingbookings = mysql_num_rows($upcomingbookingquery);
    
    $pastbookingquery = $db->query("SELECT * FROM `bookedslots` WHERE unique_location_id = '".$locationid."' AND SlotTimestamp < '".$current_time."' ORDER BY `SlotTimestamp` DESC");
    $numofpastbookings = mysql_num_rows($pastbookingquery);
                    
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>
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
                    <a class="navbar-brand page-scroll" href="https://teamproject-x14562027.c9users.io/">Astro Booking</a>
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
                                <a class="page-scroll" href="login.php">Login</a>
                            </li>
                        </ul>';
                        }
                        
                        
                        ?>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
        <header class="secondary-header">
            <div class="header-content">
                <div class="header-content-inner">
                    <h1 id="homeHeading">Pitch Dashboard</h1>
                    </br></br>
                </div>
            </div>
        </header>
        <header>
            <div class="secondary-header-content">
            <div class="header-content-inner">
                <div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#pitchdetails" aria-controls="pitchdetails" role="tab" data-toggle="tab">Pitch Details</a></li>
                        <li role="presentation"><a href="#myupcomingbookings" aria-controls="myupcomingbookings" role="tab" data-toggle="tab">Upcoming Bookings</a></li>
                        <li role="presentation"><a href="#mypastbookings" aria-controls="mypastbookings" role="tab" data-toggle="tab">Past Bookings</a></li>
                        <li role="presentation"><a href="#openinghours" aria-controls="openinghours" role="tab" data-toggle="tab">Opening Hours</a></li>
                        <li role="presentation"><a href="#editopeningtimes" aria-controls="editopeningtimes" role="tab" data-toggle="tab">Edit Opening Hours</a></li>
                        <li role="presentation"><a href="#editpitchdetails" aria-controls="editpitchdetails" role="tab" data-toggle="tab">Edit Pitch Details</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="pitchdetails">
                            <table class="table">
                                <tr>
                                    <td class="dayheader"> Pitch Name</td>
                                    <td class="dayheader"> Address</td>
                                    <td class="dayheader"> Owner</td>
                                    <td class="dayheader"> Contact Number</td>
                                    <td class="dayheader"> Email</td>
                                    <td class="dayheader"> Price</td>
                                    <td class="dayheader"> Dashboard</td>
                                </tr>
                                <?php
                                    /** Output table row */
                                    echo '<tr>';
                                    echo '<td class="timecol">'.$pitch_name.'</td>';
                                    echo '<td class="timecol">'.$address.'</td>';
                                    echo '<td class="timecol">'.$owner.'</td>';
                                    echo '<td class="timecol">'.$contact_number.'</td>';
                                    echo '<td class="timecol">'.$email.'</td>';
                                    echo '<td class="timecol">€'.$price.'</td>';
                                    echo '<td class="timecol"><a href = "https://teamproject-x14562027.c9users.io/pitch-dashboard.php?locationid='.$unique_location_id.'">View</a></td>';
                                     
                                    
                                    echo'</table>';
                                    
                                    
                                    ?>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="myupcomingbookings">
                        <?php
                            $i = 0;
                            if($numofupcomingbookings == 0){
                                
                              print '<h3>No upcoming bookings</h3>';
                            }else{
                                
                              print '<table class="table">';
                                print '<thead><tr><th>Name</th><th>Email</th><th>Contact Number</th><th>Time</th><th>Date</th><th>Price</th><th>Booking Time</th></tr></thead><tbody>';
                            while($i < $numofupcomingbookings){
                                $user_upcomingbookings = $db->fetch_assoc($upcomingbookingquery);
                                      $upcomingfirstname  = $user_upcomingbookings['FirstName'];
                                      $upcominglastname  = $user_upcomingbookings['LastName'];
                                      $upcomingemail  = $user_upcomingbookings['Email'];
                                      $upcomingcontactnumber  = $user_upcomingbookings['contact_number'];
                                      $upcomingtimestamp  = $user_upcomingbookings['SlotTimestamp'];
                                      $upcomingprice  = $user_upcomingbookings['price'];
                                      $upcomingbookingtime  = $user_upcomingbookings['bookingtime'];
                            
                                      $upcomingdate = date('d/m/Y', $upcomingtimestamp);
                                      $upcomingtime = date('g:i a', $upcomingtimestamp);
                            
                                      print '<tr><td>'.$upcomingfirstname.' '.$upcominglastname.'</td><td>'.$upcomingemail.'</td><td>'.$upcomingcontactnumber.'</td><td>'.$upcomingtime.'</td><td>'.$upcomingdate.'</td><td>€'.$upcomingprice.'</td><td>'.$upcomingbookingtime.'</td></tr>';
                                      
                                  
                                  $i++;    
                            }}
                                  ?>
                        </tbody>
                        </table></div>
                        <div role="tabpanel" class="tab-pane" id="mypastbookings"> 
                            <?php
                                $i = 0;
                                if($numofpastbookings == 0){
                                    
                                  print '<h3>No past bookings</h3>';
                                  
                                }else{
                                    print '<table class="table">';
                                    print '<thead><tr><th>Name</th><th>Email</th><th>Contact Number</th><th>Time</th><th>Date</th><th>Price</th><th>Booking Time</th></tr></thead><tbody>';
                                while($i < $numofpastbookings){
                                    $user_pastbookings = $db->fetch_assoc($pastbookingquery);
                                          $pastfirstname  = $user_pastbookings['FirstName'];
                                          $pastlastname  = $user_pastbookings['LastName'];
                                          $pastemail  = $user_pastbookings['Email'];
                                          $pastcontactnumber  = $user_pastbookings['contact_number'];
                                          $pasttimestamp  = $user_pastbookings['SlotTimestamp'];
                                          $pastprice  = $user_pastbookings['price'];
                                          $pastbookingtime  = $user_pastbookings['bookingtime'];
                                       
                                          $pastdate = date('d/m/Y', $pasttimestamp);
                                          $pasttime = date('g:i a', $pasttimestamp);
                                          
                                          print '<tr><td>'.$pastfirstname.' '.$pastlastname.'</td><td>'.$pastemail.'</td><td>'.$pastcontactnumber.'</td><td>'.$pasttime.'</td><td>'.$pastdate.'</td><td>€'.$pastprice.'</td><td>'.$pastbookingtime.'</td></tr>';
                                          
                                      
                                      $i++;    
                                }}
                                      ?>
                            </tbody>
                            </table>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="openinghours">
                            <table class="table">
                                <tr>
                                    <td class="dayheader"> Day </td>
                                    <td class="dayheader"> Opening </td>
                                    <td class="dayheader"> Closing </td>
                                </tr>
                                <?php 
                                    $opening_hours = $db->query("SELECT * FROM `opening_times` WHERE unique_location_id = '".$locationid."'");
                                    $dayCount = mysql_num_rows($opening_hours);
                                    $i = 0; 
                                    while($i < $dayCount) { 
                                     /** Get the table row */
                                     $row = $db->fetch_assoc($opening_hours);
                                     $day = $row['day'];
                                     $opening = $row['opening'];
                                     $closing = $row['closing'];
                                     
                                     $longday = date("l", strtotime($day) );
                                     $opening_arr = explode(":", $opening);
                                     $closing_arr = explode(":", $closing);
                                     
                                     $opening = $opening_arr[0].":".$opening_arr[1];
                                     $closing = $closing_arr[0].":".$closing_arr[1];
                                     /** Output table row */
                                     echo sprintf('<tr><td class="timecol">%s</td><td class="timeslot">%s</td><td class="timeslot">%s</td></tr>', $longday, $opening, $closing);
                                     $i++; 
                                    } 
                                    ?> 
                            </table>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="editopeningtimes">
                            <form action='editopeningtimes.php' method='post'>
                                <table class="table">
                                <tr>
                                    <td class="dayheader"> Day </td>
                                    <td class="dayheader"> Opening </td>
                                    <td class="dayheader"> Closing </td>
                                </tr>
                                <?php 
                                    $opening_hours = $db->query("SELECT * FROM `opening_times` WHERE unique_location_id = '".$locationid."'");
                                    $dayCount = mysql_num_rows($opening_hours);
                                    $i = 0; 
                                    while($i < $dayCount) { 
                                     /** Get the table row */
                                     $row = $db->fetch_assoc($opening_hours);
                                     $day = $row['day'];
                                     $opening = $row['opening'];
                                     $closing = $row['closing'];
                                     $opening_arr = explode(":", $opening);
                                     $closing_arr = explode(":", $closing);
                                     
                                     $longday = date("l", strtotime($day) );
                                     
                                     /** Output table row */
                                     echo '<tr>';
                                     echo '<td class="timecol">'.$longday.'</td>';
                                     echo '<td class="timeslot"><div class="input-group"><input type="number" class="form-control" name="opening['.$day.']" value="'.$opening_arr[0].'" min="0" max="23"><span class="input-group-addon" id="basic-addon2">:00</span></div></td>';
                                     echo '<td class="timeslot"><div class="input-group"><input type="number" class="form-control" name="closing['.$day.']" value="'.$closing_arr[0].'" min="0" max="23"><span class="input-group-addon" id="basic-addon2">:00</span></div></td>';
                                     echo '</tr>';
                                     echo '<input type="hidden" name="day[]" value="'.$day.'">';
                                      echo '<input type="hidden" name="unique_location_id" value="'.$locationid.'">';
                                     $i++; 
                                    } 
                                     echo'</table>';
                                     echo "<input type='submit' class ='btn btn-primary btn-lg' name='update' value='UPDATE' />";
                                    ?> 
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="editpitchdetails">
                            <div class="container">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4">
                                    <form name="form" method="post" action="edit-pitch-details.php">
                                        <input type="hidden" name="new" value="1" />
                                        <div class="form-group">
                                            <label for="username">Pitch Name</label>
                                            <input type="text" class="form-control" name="pitchname" value="<?php echo $pitch_name;?>" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Address</label>
                                            <input type="text" class="form-control"  name="address" value="<?php echo $address;?>" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Owner</label>
                                            <input type="text" class="form-control"  name="owner"  value="<?php echo $owner;?>" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Contact Number</label>
                                            <input type="text" class="form-control"  name="contactnumber" value="<?php echo $contact_number;?>" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Email</label>
                                            <input type="email" class="form-control"  name="email"  value="<?php echo $email;?>" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Latitude</label>
                                            <input type="text" class="form-control"  name="latitude"  value="<?php echo $latitude;?>" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Longitude</label>
                                            <input type="text" class="form-control"  name="longitude"  value="<?php echo $longitude;?>" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Price</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">€</span>
                                                <input type="number" class="form-control"  name="price"  value="<?php echo $price;?>" required /></p>
                                            </div>
                                        </div>
                                        <input type="hidden" class="form-control"  name="unique_location_id"  value="<?php echo $unique_location_id;?>" required /></p>
                                        <input type='submit' class ='btn btn-primary btn-lg' name='update' value='UPDATE' />
                                    </form>
                                </div>
                                <div class="col-md-4">
                                </div>
                            </div>
                        </div>
                    </div>
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