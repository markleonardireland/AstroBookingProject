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
                    <h1 id="homeHeading">Registration</h1>
                    <?php
                        require('db.php');
                        
                        include_once("db-connect.php");
                        
                        $db = new DB();
                        
                        if (isset($_REQUEST['username'])){
                        	
                        	 $member_id = rand(100000000000, 999999999999);
                             $result    = $db->query('select * from users;');
                        $Ids = array();
                        while ($row = $db->fetch_assoc($result)) {
                                        $Ids[] = $row['member_id'];
                        }
                        
                        while (in_array($member_id, $Ids)) {
                                        $member_id = rand(1000000000, 9999999999);
                        }
                        
                        	$username = stripslashes($_REQUEST['username']);
                        	$username = mysqli_real_escape_string($con,$username); 
                        	$password = stripslashes($_REQUEST['password']);
                        	$password = mysqli_real_escape_string($con,$password);
                        	$firstname = stripslashes($_REQUEST['firstname']);
                        	$firstname = mysqli_real_escape_string($con,$firstname);
                        	$lastname = stripslashes($_REQUEST['lastname']);
                        	$lastname = mysqli_real_escape_string($con,$lastname);
                        	$email = stripslashes($_REQUEST['email']);
                        	$email = mysqli_real_escape_string($con,$email);
                        	$contactno = stripslashes($_REQUEST['contactno']);
                        	$contactno = mysqli_real_escape_string($con,$contactno);
                        	$trn_date = date("Y-m-d H:i:s");
                                $query = "INSERT into `users` (member_id, username, password, firstname, lastname, email, contactno, trn_date, access_level)
                        VALUES ($member_id, '$username', '".md5($password)."', '$firstname', '$lastname',  '$email', '$contactno', '$trn_date','member')";
                                $result = mysqli_query($con,$query);
                                if($result){
                                    echo "<div class='form'>
                        <h3>You are registered successfully.</h3>
                        <br/>Click here to <a href='login.php'>Login</a></div>";
                                }
                            }else{
                        ?>
                    <div class="loginform">
                            <form name="registration" action="" method="post">
                                <div class="form-group">
                                    <label for="inputfirstname">Username</label>
                                    <input type="text" class="form-control" name="username" placeholder="Username" required />
                                </div>
                                <div class="form-group">
                                    <label for="inputfirstname">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password" required />
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
                                    <input type="text" class="form-control" name="contactno" placeholder="Contact Number" required />
                                </div>
                                <input type="submit" class="btn btn-primary btn-lg" name="submit" value="Register" />
                            </form>
                            </div>
                          
                      
                    <?php } ?>
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