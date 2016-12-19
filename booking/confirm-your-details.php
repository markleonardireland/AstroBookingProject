<!-- * Stripe Checkout-->
<!-- * Version 4.3.0-->
<!-- * Date 05/12/2016-->
<!-- * @reference https://stripe.com/docs/checkout-->
<?php
   include_once( $_SERVER['DOCUMENT_ROOT'] . '/db-connect.php' );
   
   $db = new DB();
   session_start();
   
   $timestamp = $_GET['time'];
   $unique_location_id = $_GET['uniquelocationid'];
   
  if(isset($_SESSION["username"])){
    $username = $_SESSION["username"];
    
    $result = $db->query("SELECT * FROM `users` WHERE username = '".$username."'  LIMIT 1");
if (mysql_num_rows($result) == 1) {
                $userdetails = $db->fetch_assoc($result);
           
                $accesslevel = $userdetails['access_level'];
                $username = $userdetails['username'];
                
                
             
}
}
   
   
   $date = date('d/m/Y', $timestamp);
   $time = date('g:i a', $timestamp);
   
   $todays_timestamp = time();
   
   $result      = $db->query('select * from bookedslots WHERE SlotTimestamp >= ' . $todays_timestamp . ';');
   $bookedSlots = array();
   while ($row = $db->fetch_assoc($result)) {
                   $bookedSlots[] = $row['SlotTimestamp'];
   }
   
$all_pitches = $db->query("SELECT * FROM `locations` WHERE unique_location_id = '".$unique_location_id."'");
$total_pitches = mysql_num_rows($all_pitches);
$i = 0; 
while($i < $total_pitches) { 
    /** Get the table row */
    $row = $db->fetch_assoc($all_pitches);
    $pitch_name = $row['name'];
    $address = $row['address'];
    $owner = $row['owner'];
    $contact_number = $row['contact_number'];
    $email = $row['email'];
    $price = $row['price'];
    $unique_location_id = $row['unique_location_id'];
    $stripe_price = $price * 100;
   $i++; 
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
    <header>
    <div class="header-content">
            <div class="header-content-inner">
                
                
    
               
<?php
               //Not logged in body
                  if(!isset($_SESSION['username'])){
                 
             print'  <body>
                  <center>
                  <h1>Please login to confirm your booking</h1>
                  <center>';
               
                     require($_SERVER['DOCUMENT_ROOT'] . '/db.php');
                     session_start();
                     // If form submitted, insert values into the database.
                     if (isset($_POST['username'])){
                             // removes backslashes
                     	$username = stripslashes($_REQUEST['username']);
                             //escapes special characters in a string
                     	$username = mysqli_real_escape_string($con,$username);
                     	$password = stripslashes($_REQUEST['password']);
                     	$password = mysqli_real_escape_string($con,$password);
                     	//Checking is user existing in the database or not
                             $query = "SELECT * FROM `users` WHERE username='$username'
                     and password='".md5($password)."'";
                     	$result = mysqli_query($con,$query) or die(mysql_error());
                     	$rows = mysqli_num_rows($result);
                             if($rows==1){
                     	    $_SESSION['username'] = $username;
                                 // Redirect user to index.php
                     	    header("Location: https://teamproject-x14562027.c9users.io/booking/confirm-your-details.php?time=$timestamp&uniquelocationid=$unique_location_id");
                     	    
                              }else{
                     	echo "<div class='form'>
                     <h3>Username/password is incorrect.</h3>
                     <br/>Click here to <a href='login.php'>Login</a></div>";
                     	}
                         }else{
                     ?>
                  
                     
                     <form action="" method="post" name="login">
                        <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" name="username" placeholder="Username" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Password" required />
                                    </div>
                                    <input name="submit" class="btn btn-primary btn-lg" type="submit" value="Login" />
                     </form>
                     <p>Not registered yet? <a href='registration.php'>Register Here</a></p>
                  
            </div>
         </div>
         <?php } ?>
      </body>
      <?php } 
      
      else {
      	// code...
      	$username = $_SESSION['username'];
      	$userquery = $db->query("SELECT * FROM `users` WHERE username = '".$username."'  LIMIT 1");
if (mysql_num_rows($userquery) == 1) {
                $user_details = $db->fetch_assoc($userquery);
                $member_id  = $user_details['member_id'];
                $firstname  = $user_details['firstname'];
                $lastname  = $user_details['lastname'];
                $email  = $user_details['email'];
                $contactnumber  = $user_details['contactno'];
               }
   
   print'
   <h2>Please review your details</h2>
  
  
  <div class="table-responsive">          
  <table class="table">
    <tbody>
      <tr>
        <td>Firstname:</td><td>'.$firstname.'</td></tr>
       <tr><td>Lastname:</td><td>'.$lastname.'</td></tr>
        <tr><td>Email:</td><td>'.$email.'</td></tr>
       <tr><td>Contact:</td> <td>'.$contactnumber.'</td>
       
      </tr>
  
      <tr>
        <td>Pitch:</td><td>'.$pitch_name.'</td></tr>
       <tr><td>Time:</td><td>'.$time.'</td></tr>
        <tr><td>Date:</td><td>'.$date.'</td></tr>
       <tr><td>Price:</td> <td>€'.$price.'</td>
       
      </tr>
    </tbody>
  </table>
  </div>
  
   
   
   
';

 
   
      print ' <form action="booking/confirmation.php" method="post">
         <input type="hidden" name="fname" value="'.$firstname.'" />
         <input type="hidden" name="lname" value="'.$lastname.'" />
         <input type="hidden" name="email" value="'.$email.'" />
         <input type="hidden" name="time" value="'.$timestamp.'"/>
         <input type="hidden" name="memberid" value="'.$member_id.'" />
         <input type="hidden" name="contactnumber" value="'.$contactnumber.'" />
         <input type="hidden" name="location" value="'.$pitch_name.'"/>
         <input type="hidden" name="price" value="'.$price.'"/>
         <input type="hidden" name="uniquelocationid" value="'.$unique_location_id.'"/>
         
         <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_6pRNASCoBOKtIshFeQd4XMUh"
    data-amount="'.$stripe_price.'"
    data-name="Stripe.com"
    data-description="Widget"
    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
    data-locale="auto"
    data-currency="eur"
  </script>
      </form>' ;        
               
      }
      ?>
  
          
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