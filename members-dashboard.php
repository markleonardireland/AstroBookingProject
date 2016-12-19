 <!--* members-dashboard.php-->
 <!--* Version 1-->
 <!--* Date e.g. 01/11/2016-->
 <!--* @reference http://www.allphptricks.com/simple-user-registration-login-script-in-php-and-mysqli/-->
 <!--* @reference http://www.allphptricks.com/insert-view-edit-and-delete-record-from-database-using-php-and-mysqli/-->
 <!--* @author Mark Hayden x14723661, Kevin O'Rourke x15042782 -->

<?php
    include_once("db-connect.php");
    
    $db = new DB();
    
    include("auth.php");
    
    $username = $_SESSION['username'];
          	$userquery = $db->query("SELECT * FROM `users` WHERE username = '".$username."'  LIMIT 1");
    if (mysql_num_rows($userquery) == 1) {
                    $user_details = $db->fetch_assoc($userquery);
                    $member_id  = $user_details['member_id'];
                    $firstname  = $user_details['firstname'];
                    $lastname  = $user_details['lastname'];
                    $email  = $user_details['email'];
                    $contactnumber  = $user_details['contactno'];
                    $username  = $user_details['username']; 
                    $accesslevel  = $user_details['access_level']; 
        
    }
             
    $current_time = time();
                   
    $upcomingbookingquery = $db->query("SELECT * FROM `bookedslots` WHERE member_id = '".$member_id."' AND SlotTimestamp > '".$current_time."'");
    $numofupcomingbookings = mysql_num_rows($upcomingbookingquery);
    
    $pastbookingquery = $db->query("SELECT * FROM `bookedslots` WHERE member_id = '".$member_id."' AND SlotTimestamp < '".$current_time."'");
    $numofpastbookings = mysql_num_rows($pastbookingquery);
    
    
    
    
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
                    <h1 id="homeHeading">Member's Area</h1>
                    </br></br>
                    <?php
                        include_once("search.php");
                        ?></br></br>
                </div>
            </div>
        </header>
        <header>
            <div class="secondary-header-content">
                <div class="header-content-inner">
                    <div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#myupcomingbookings" aria-controls="myupcomingbookings" role="tab" data-toggle="tab">My Upcoming Bookings</a></li>
                            <li role="presentation"><a href="#mypastbookings" aria-controls="mypastbookings" role="tab" data-toggle="tab">My Past Bookings</a></li>
                            <li role="presentation"><a href="#mydetails" aria-controls="mydetails" role="tab" data-toggle="tab">My Details</a></li>
                            <li role="presentation"><a href="#updatemydetails" aria-controls="updatemydetailss" role="tab" data-toggle="tab">Update My Details</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="myupcomingbookings">
                                <?php
                                    $i = 0;
                                    if($numofupcomingbookings == 0){
                                        
                                      print '<h3>No upcoming bookings</h3>';
                                    }else{
                                        
                                    print '<table class="table">';
                                    print '<tbody><tr><th>Pitch</th><th>Time</th><th>Date</th><th>Price</th><th>Booking Time</th></tr></thead><tbody>';
                                    while($i < $numofupcomingbookings){
                                        $user_bookings = $db->fetch_assoc($upcomingbookingquery);
                                              $location  = $user_bookings['Location'];
                                              $timestamp  = $user_bookings['SlotTimestamp'];
                                              $price  = $user_bookings['price'];
                                              $bookingtime  = $user_bookings['bookingtime'];
                                           
                                              $date = date('d/m/Y', $timestamp);
                                              $time = date('g:i a', $timestamp);
                                              
                                              
                                              print '<tr><td>'.$location.'</td><td>'.$time.'</td><td>'.$date.'</td><td>€'.$price.'</td><td>'.$bookingtime.'</td></tr>';
                                              
                                          
                                          $i++;    
                                    }}
                                          ?>
                                </tbody>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="mypastbookings"> 
                                <?php
                                    $i = 0;
                                    if($numofpastbookings == 0){
                                        
                                      print '<h3>No past bookings</h3>';
                                      
                                    }else{
                                        print '<table class="table">';
                                        print '<thead><tr><th>Pitch</th><th>Time</th><th>Date</th><th>Price</th><th>Booking Time</th></tr></thead><tbody>';
                                    while($i < $numofpastbookings){
                                        $user_pastbookings = $db->fetch_assoc($pastbookingquery);
                                              $pastlocation  = $user_pastbookings['Location'];
                                              $pasttimestamp  = $user_pastbookings['SlotTimestamp'];
                                              $pastprice  = $user_pastbookings['price'];
                                              $pastbookingtime  = $user_pastbookings['bookingtime'];
                                           
                                              $pastdate = date('d/m/Y', $pasttimestamp);
                                              $pasttime = date('g:i a', $pasttimestamp);
                                              
                                              print '<tr><td>'.$pastlocation.'</td><td>'.$pasttime.'</td><td>'.$pastdate.'</td><td>€'.$pastprice.'</td><td>'.$pastbookingtime.'</td></tr>';
                                              
                                          
                                          $i++;    
                                    }}
                                          ?>
                                </tbody>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="mydetails">
                                <?php
                                    print '<table class="table">';
                                    print '<thead><tr><th>Username</th><th>Firstname</th><th>Lastname</th><th>Email</th><th>Contact Number</th></tr></thead><tbody>';
                                    print '<tr><td>'.$username.'</td><td>'.$firstname.'</td><td>'.$lastname.'</td><td>'.$email.'</td><td>'.$contactnumber.'</td></tr>';
                                    print '</tbody></table>';       
                                    
                                    ?>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="updatemydetails">
                                <div class="container">
                                    <div class="col-md-4">
                                    </div>
                                    <div class="col-md-4">
                                        <form name="udatemydetails" action="update-my-details.php" method="post">
                                            <div class="form-group">
                                                <label for="inputfirstname">Firstname</label>
                                                <input type="text" class="form-control" id="inputfirstname" name="firstname" value="<?php echo $firstname;?>" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="inputlastname">Lastname</label>
                                                <input type="text" class="form-control" id="inputlastname" name="lastname" value="<?php echo $lastname;?>" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="inputemail">Email</label>
                                                <input type="email" class="form-control" id="inputemail" name="email" value="<?php echo $email;?>" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="inputcontactnumber">Contact Number</label>
                                                <input type="text" class="form-control" id="inputcontactnumber" name="contactno" value="<?php echo $contactnumber;?>" required />
                                            </div>
                                            <input type="hidden" name="member_id" value="<?php echo $member_id;?>" required />
                                            <input type="submit" class="btn btn-primary btn-lg" name="submit" value="Update" />
                                        </form>
                                    </div>
                                    <div class="col-md-4">
                                    </div>
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

