 <!--* admin-dashboard.php-->
 <!--* Version 1-->
 <!--* Date e.g. 01/11/2016-->
 <!--* @reference http://www.allphptricks.com/simple-user-registration-login-script-in-php-and-mysqli/-->
 <!--* @reference http://www.allphptricks.com/insert-view-edit-and-delete-record-from-database-using-php-and-mysqli/-->
 <!--* @author Mark Hayden x14723661, Kevin O'Rourke x15042782 -->
<?php
    include_once( $_SERVER['DOCUMENT_ROOT'] . '/db-connect.php' );
    //include_once("db-connect.php");
    $db = new DB();
    
    include($_SERVER['DOCUMENT_ROOT'] . '/auth.php');
    
  
    $username = $_SESSION["username"];
    
    
    $result1 = $db->query("SELECT * FROM `users` WHERE username = '".$username."'  LIMIT 1");
    if (mysql_num_rows($result1) == 1) {
                    $adminuser_details = $db->fetch_assoc($result1);
                    $firstname  = $adminuser_details['firstname'];
                    $adminusername  = $adminuser_details['username']; 
                    $accesslevel  = $adminuser_details['access_level'];   
    	

               
                
                    
                    
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
        <header class="secondary-header">
            <div class="header-content">
                <div class="header-content-inner">
                    <h1 id="homeHeading">Admin Dashboard</h1>
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
                            <li role="presentation"><a href="#addnewpitch" aria-controls="addnewpitch" role="tab" data-toggle="tab">Add new pitch</a></li>
                            <li role="presentation"><a href="#addnewadmin" aria-controls="addnewadmin" role="tab" data-toggle="tab">Add new admin</a></li>
                            <li role="presentation"><a href="#admindetails" aria-controls="admindetails" role="tab" data-toggle="tab">Admins</a></li>
                            <li role="presentation"><a href="#addnewpitchowner" aria-controls="addnewpitchowner" role="tab" data-toggle="tab">Add Pitch Owner</a></li>
                            <li role="presentation"><a href="#pitchownerdetails" aria-controls="pitchownerdetails" role="tab" data-toggle="tab">Pitch Owners</a></li>
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
                                    $all_pitches = $db->query("SELECT * FROM `locations`");
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
                                      
                                      
                                      /** Output table row */
                                      echo '<tr>';
                                      echo '<td class="timecol">'.$pitch_name.'</td>';
                                      echo '<td class="timecol">'.$address.'</td>';
                                      echo '<td class="timecol">'.$owner.'</td>';
                                      echo '<td class="timecol">'.$contact_number.'</td>';
                                      echo '<td class="timecol">'.$email.'</td>';
                                      echo '<td class="timecol">€'.$price.'</td>';
                                      echo '<td class="timecol"><a href = "https://teamproject-x14562027.c9users.io/pitch-dashboard.php?locationid='.$unique_location_id.'">View</a></td>';
                                      $i++; 
                                    } 
                                      echo'</table>';
                                      
                                    
                                    ?>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="addnewpitch">
                                <div class="container">
                                    <div class="col-md-6">
                                        <form name="form" method="post" action="admin/add-pitch.php">
                                            <input type="hidden" name="new" value="1" />
                                            <div class="form-group">
                                                <label for="inputfirstname">Enter Name</label>
                                                <input type="text" class="form-control" name="name" placeholder="Enter Name" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="inputfirstname">Enter Address</label>
                                                <input type="text" class="form-control"  name="address" placeholder="Enter Address" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="inputfirstname">Enter Owner</label>
                                                <input type="text" class="form-control"  name="owner" placeholder="Enter Owner" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="inputfirstname">Enter Contact Number</label>
                                                <input type="text" class="form-control"  name="contactnumber" placeholder="Enter Contact Number" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="inputfirstname">Enter Email</label>
                                                <input type="email" class="form-control"  name="email" placeholder="Enter Email" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="inputfirstname">Enter Latitude</label>
                                                <input type="text" class="form-control"  name="latitude" placeholder="Enter Latitude" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="inputfirstname">Enter Longitude</label>
                                                <input type="text" class="form-control"  name="longitude" placeholder="Enter Longitude" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="inputfirstname">Enter Price</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">€</span>
                                                    <input type="number" class="form-control"  name="price" placeholder="Price" required /></p>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-md-6">
                                    <table class="table"> 
                                    <tr> 
                                    <td class="dayheader"> Day </td>
                                    <td class="dayheader"> Opening </td>
                                    <td class="dayheader"> Closing </td>
                                    </tr> 
                                    <?php 
                                        $day_array = array("mon", "tue", "wed","thu","fri","sat","sun");
                                        $array_lenght = count($day_array);
                                        $i = 0; 
                                        while($i < $array_lenght) { 
                                         /** Get the table row */
                                         
                                         $day = $day_array[$i];
                                         
                                         $longday = date("l", strtotime($day) );
                                         
                                         /** Output table row */
                                         echo '<tr>';
                                         echo '<td class="timecol">'.$longday.'</td>';
                                         echo '<td class="timeslot"><div class="input-group"><input type="number" class="form-control"  name="opening['.$day.']" value="9" min="0" max="23"><span class="input-group-addon" id="basic-addon2">:00</span></div></td>';
                                         echo '<td class="timeslot"><div class="input-group"><input type="number" class="form-control"  name="closing['.$day.']" value="23" min="0" max="23"><span class="input-group-addon" id="basic-addon2">:00</span></div></td>';
                                         echo '</tr>';
                                         echo '<input type="hidden" name="day[]" value="'.$day.'">';
                                         $i++; 
                                        } 
                                         echo'</table>';
                                        
                                        ?> </div>
                                </div>
                                <p><input name="submit" class="btn btn-primary btn-lg" type="submit" value="Submit" /></p>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="addnewadmin">
                                <div class="container">
                                    <div class="col-md-4">
                                    </div>
                                    <div class="col-md-4">
                                    
                                        <div class="form">
                                            <h1>Registration</h1>
                                            <form name="registration" action="admin/admin-registration.php" method="post">
                                                <div class="form-group">
                                                    <label for="username">Username</label>
                                                    <input type="text" id="username" class="form-control" name="username" placeholder="Username" required />
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" id="password" class="form-control" name="password" placeholder="Password" required />
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputfirstname">Firstname</label>
                                                    <input type="text" class="form-control" name="firstname" placeholder="Firstname" required />
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputfirstname">Lastname</label>
                                                    <input type="text" class="form-control" name="lastname" placeholder="Lastname" required />
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputfirstname">Email</label>
                                                    <input type="email" class="form-control" name="email" placeholder="Email" required />
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputfirstname">Contact Number</label>
                                                    <input type="text" class="form-control" name="contactno" placeholder="Contactno" required />
                                                </div>
                                                <input type="submit" class="btn btn-primary btn-lg" name="submit" value="Register" />
                                            </form>
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                    </div>
                            </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="admindetails">
                                <table class="table">
                                <tr>
                                    <td class="dayheader"> Username</td>
                                    <td class="dayheader"> Firstname</td>
                                    <td class="dayheader"> Lastname</td>
                                    <td class="dayheader"> Email</td>
                                    <td class="dayheader"> Contact Number</td>
                                </tr>
                                <?php
                                    $admins = $db->query("SELECT * FROM `users` WHERE access_level = 'admin'");
                                    $total_admins = mysql_num_rows($admins);
                                    $i = 0; 
                                    while($i < $total_admins) { 
                                      /** Get the table row */
                                      $row = $db->fetch_assoc($admins);
                                      $username = $row['username'];
                                      $firstname = $row['firstname'];
                                      $lastname = $row['lastname'];
                                      $contact_number = $row['contactno'];
                                      $email = $row['email'];
                                      
                                      
                                      
                                      
                                      /** Output table row */
                                      echo '<tr>';
                                      echo '<td class="timecol">'.$username.'</td>';
                                      echo '<td class="timecol">'.$firstname.'</td>';
                                      echo '<td class="timecol">'.$lastname.'</td>';
                                      echo '<td class="timecol">'.$email.'</td>';
                                      echo '<td class="timecol">'.$contact_number.'</td>';
                                    
                                     $i++; 
                                    } 
                                      echo'</table>';
                                      
                                    
                                    ?>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="addnewpitchowner">
                                <div class="container">
                                    <div class="col-md-4">
                                    </div>
                                    <div class="col-md-4">
                                <div class="form">
                                  
                                    <form name="registration" action="admin/admin-pitchowner-registration.php" method="post">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                        <input type="text" class="form-control" name="username" placeholder="Username" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Password" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Firstname</label>
                                        <input type="text" class="form-control" name="firstname" placeholder="Firstname" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Lastname</label>
                                        <input type="text" class="form-control" name="lastname" placeholder="Lastname" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Email" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Contact No.</label>
                                        <input type="text" class="form-control" name="contactno" placeholder="Contactno" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Unique Location ID</label>
                                        <input type="text" class="form-control" name="unique_location_id" placeholder="Unique Location ID" required />
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-lg" name="submit" value="Register" />
                                    </form>
                                </div>
                                </div>
                                    <div class="col-md-4">
                                    </div>
                                    </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="pitchownerdetails">
                                <table class="table">
                                <tr>
                                    <td class="dayheader"> Username</td>
                                    <td class="dayheader"> Firstname</td>
                                    <td class="dayheader"> Lastname</td>
                                    <td class="dayheader"> Email</td>
                                    <td class="dayheader"> Contact Number</td>
                                </tr>
                                <?php
                                    $admins = $db->query("SELECT * FROM `users` WHERE access_level = 'pitch'");
                                    $total_admins = mysql_num_rows($admins);
                                    $i = 0; 
                                    while($i < $total_admins) { 
                                      /** Get the table row */
                                      $row = $db->fetch_assoc($admins);
                                      $username = $row['username'];
                                      $firstname = $row['firstname'];
                                      $lastname = $row['lastname'];
                                      $contact_number = $row['contactno'];
                                      $email = $row['email'];
                                      
                                      
                                      
                                      
                                      /** Output table row */
                                      echo '<tr>';
                                      echo '<td class="timecol">'.$username.'</td>';
                                      echo '<td class="timecol">'.$firstname.'</td>';
                                      echo '<td class="timecol">'.$lastname.'</td>';
                                      echo '<td class="timecol">'.$email.'</td>';
                                      echo '<td class="timecol">'.$contact_number.'</td>';
                                    
                                     $i++; 
                                    } 
                                      echo'</table>';
                                      
                                    
                                    ?>
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