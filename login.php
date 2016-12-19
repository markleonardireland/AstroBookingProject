 <!--* members-dashboard.php-->
 <!--* Version 1-->
 <!--* Date e.g. 01/11/2016-->
 <!--* @reference http://www.allphptricks.com/simple-user-registration-login-script-in-php-and-mysqli/-->
 <!--* @reference http://www.allphptricks.com/insert-view-edit-and-delete-record-from-database-using-php-and-mysqli/-->
 <!--* @author Mark Hayden x14723661, Kevin O'Rourke x15042782 -->
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
                        <li>
                            <a class="page-scroll" href="https://teamproject-x14562027.c9users.io/">Home</a>
                        </li>
                    
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
        <header>
            <div class="header-content">
                <div class="header-content-inner">
                    <h1 id="homeHeading">Login</h1>
                    <?php
                        require('db.php');
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
                        	    header("Location: https://teamproject-x14562027.c9users.io/");
                        	    
                                 }else{
                        	echo "<div class='form'>
                        <h3>Username/password is incorrect.</h3>
                        <br/>Click here to <a href='login.php'>Login</a></div>";
                        	}
                            }else{
                        ?>
                    
                            <div class="loginform">
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