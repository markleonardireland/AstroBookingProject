<!-- * Bootstrap Template-->
<!-- * Version Creative v3.3.7-->
<!-- * Date 25/11/2016-->
<!-- * @reference https://github.com/BlackrockDigital/startbootstrap-creative-->
<!-- * @author Mark Leonard x14562027, Kevin O'Rourke x15042782-->

<!-- * Google Maps-->
<!-- * Version 3.27-->
<!-- * Date 06/12/2016-->
<!-- * @reference https://developers.google.com/maps/documentation/javascript/mysql-to-maps-->
<!-- * @author Mark Leonard x14562027-->

<!-- * Footer-->
<!-- * Version Unknown-->
<!-- * Date 04/12/2016-->
<!-- * @reference http://bootsnipp.com/snippets/40DXn-->
<!-- * @author Mark Leonard x14562027-->


<?php
    include_once( $_SERVER['DOCUMENT_ROOT'] . '/db-connect.php' );
       //include_once("db-connect.php");
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
                  $_SESSION["user_id"] = $userdetails['id'];
    }
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
                                <a class="page-scroll" href="members-dashboard.php">Members Area</a>
                            </li>
                            <li>
                                <a class="page-scroll" href="#portfolio">Locations</a>
                            </li>
                            <li>
                                <a class="page-scroll" href="logout.php">Logout</a>
                            </li>
                        </ul>';}else if(isset($_SESSION["username"]) && $accesslevel == "pitch"){
                        
                        print '<ul class="nav navbar-nav navbar-right">
                            <li>
                                <a class="page-scroll" href="pitch-dashboard.php?locationid='.$unique_location_id.'">Pitch Area</a>
                            </li>
                            <li>
                                <a class="page-scroll" href="#portfolio">Locations</a>
                            </li>
                            <li>
                                <a class="page-scroll" href="logout.php">Logout</a>
                            </li>
                        </ul>';}else if(isset($_SESSION["username"]) && $accesslevel == "admin"){
                        
                        print '<ul class="nav navbar-nav navbar-right">
                            <li>
                                <a class="page-scroll" href="admin/admin-dashboard.php">Admin Area</a>
                            </li>
                            <li>
                                <a class="page-scroll" href="#portfolio">Locations</a>
                            </li>
                            <li>
                                <a class="page-scroll" href="logout.php">Logout</a>
                            </li>
                        </ul>';}
                        
                        
                        else {
                            
                             print '<ul class="nav navbar-nav navbar-right">
                            <li>
                                <a class="page-scroll" href="#">Home</a>
                            </li>
                            <li>
                                <a class="page-scroll" href="#portfolio">Locations</a>
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
        <header>
            <div class="header-content">
                <div class="header-content-inner">
                    <h1 id="homeHeading">Astro Booking</h1>
                    <hr>
                    <p>Book Astro Turf football pitches from anywhere around Ireland</p>
                    <p>Choose Location | Pick A Time Slot | Pay and Play</p>
                    <?php
                        include_once("search.php");
                        ?>
                </div>
            </div>
        </header>
        <div class="modal fade text-center" id="theModal">
            <div class="modal-dialog">
                <div class="modal-content">
                </div>
            </div>
        </div>
        <div class="container" id="portfolio">
            <div class="row padding" id="three">
                <div class="col-md-6">
                    <h2 class="text-left">Our Partners in Dublin</h2>
                    <div id="map" style="width:1200px;height:500px"></div>
                    
                    
                    <script>
                        <?php
                        
                        //Get a list of the users favourites
                        
                        if(isset($_SESSION["user_id"]))
                        {
                            $sql = "SELECT location_id from user_favourites WHERE user_id = ".$_SESSION['user_id'];
                            
                            $result = mysql_query($sql) or die(mysql_error());
                            $favourites = array();
                            while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                                $favourites[] = $row[0];
                                
                            }
                        }
                        
                       ?>
                       
                       var listOfFavourites = <?php echo json_encode($favourites); ?>;

                       var clickedLocation;
                        
                       
                            function initMap() {
                            var map = new google.maps.Map(document.getElementById('map'), {
                              center: new google.maps.LatLng(53.3498053, -6.2603097),
                              zoom: 10
                            });
                            var infoWindow = new google.maps.InfoWindow;
                        
                              // Change this depending on the name of your PHP or XML file
                              downloadUrl('google_maps.php', function(data) {
                                  
                                var xml = data.responseXML;
                                
                                var markers = xml.documentElement.getElementsByTagName('marker');
                                
                                Array.prototype.forEach.call(markers, function(markerElem) {
                                  var location_id = markerElem.getAttribute('id');
                                  var name = markerElem.getAttribute('name');
                                  var address = markerElem.getAttribute('address');
                                  var type = markerElem.getAttribute('type');
                                  var point = new google.maps.LatLng(
                                      parseFloat(markerElem.getAttribute('lat')),
                                      parseFloat(markerElem.getAttribute('lng')));
                        
                        //Create the content for the infowindow on the marker
                                
                                
                                
                                  var infowincontent = document.createElement('div');
                                  var strong = document.createElement('strong');
                                  strong.textContent = name
                                  infowincontent.appendChild(strong);
                                  infowincontent.appendChild(document.createElement('br'));
                        
                                  var text = document.createElement('text');
                                  text.textContent = address;
                                  
                                  infowincontent.appendChild(text);
                                  var favlink = document.createElement('a');
                                  favlink.onclick = addToFavourites;
                                  favlink.textContent = "Add to Favourites";
                                  favlink.style.cursor = "pointer";
                                  
                                  <?php 
                                if (isset($_SESSION["username"])){
                                    echo 'infowincontent.appendChild(document.createElement("br"));';
                                    echo 'infowincontent.appendChild(favlink)';
                                }
                                ?>;
                                  
                                  
                                 
                                var mapicon;
                                
                                if (listOfFavourites != null){
                                    if (listOfFavourites.indexOf(location_id.toString()) > -1){
                                    mapicon = "img/soccermarkerfav.png";
                                    }
                                    else{
                                        mapicon = "img/soccermarker.png";
                                    }
                                }
                                
                                else{
                                        mapicon = "img/soccermarker.png";

                                }
                                
                                
                                var markerIcon;
                               
                                  var marker = new google.maps.Marker({
                                    map: map,
                                    position: point,
                                    icon: mapicon
                                    
                                  });
                                  marker.addListener('click', function() {
                                    infoWindow.setContent(infowincontent);
                                    infoWindow.open(map, marker);
                                    clickedLocation = location_id;
                                 
                                  });
                                });
                              });
                            }
                        
                        
                        
                          function downloadUrl(url, callback) {
                            var request = window.ActiveXObject ?
                                new ActiveXObject('Microsoft.XMLHTTP') :
                                new XMLHttpRequest;
                        
                            request.onreadystatechange = function() {
                              if (request.readyState == 4) {
                                
                                callback(request, request.status);
                              }
                            };
                        
                            request.open('GET', url, true);
                            request.send(null);
                          }
                        
                          function addToFavourites() {
                              console.log("<?php echo $_SESSION["user_id"] ?>");
                              var url = "add_favourites.php?location=" + clickedLocation + "&user=" + "<?php echo $_SESSION["user_id"] ?>"; 
                               var request = window.ActiveXObject ?
                                new ActiveXObject('Microsoft.XMLHTTP') :
                                new XMLHttpRequest;
                        
                            request.onreadystatechange = function() {
                              if (request.readyState == 4) {
                              }
                            };
                        
                            request.open('GET', url, true);
                            request.send(null);
                          }
                              
                              
                              
                              
                              
                          
                    </script>
                    <script async defer
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfQerkWnyhv-OHc_DXxknnjzUfo-OPdTc&callback=initMap"></script>
                </div>
            </div>
            <hr />
        </div>
        <section class="no-padding" id="portfolio">
            <div class="container-fluid">
                <div class="row no-gutter popup-gallery">
                    <div class="col-lg-4 col-sm-6">
                        <a href="img/portfolio/fullsize/1.jpg" class="portfolio-box">
                            <img src="img/portfolio/thumbnails/1.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-name">
                                        Laragh Astro Pitch, Co. Cavan
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="img/portfolio/fullsize/2.jpg" class="portfolio-box">
                            <img src="img/portfolio/thumbnails/2.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-name">
                                        South Shore Astro, Rush, Co. Dublin
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="img/portfolio/fullsize/3.jpg" class="portfolio-box">
                            <img src="img/portfolio/thumbnails/3.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-name">
                                        North Shore Astro, Howth, Dublin 13
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="img/portfolio/fullsize/4.jpg" class="portfolio-box">
                            <img src="img/portfolio/thumbnails/4.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-name">
                                        Galway Astro, Galway
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="img/portfolio/fullsize/5.jpg" class="portfolio-box">
                            <img src="img/portfolio/thumbnails/5.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-name">
                                        Astro Park, Cooklock, Dublin 17
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="img/portfolio/fullsize/6.jpg" class="portfolio-box">
                            <img src="img/portfolio/thumbnails/6.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-name">
                                        Cork Astro, Cork
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <footer class="footer-distributed">
            <div class="footer-left">
                <div class="row">
                    <p class="footer-links">
                        <a href="https://teamproject-x14562027.c9users.io/login.php">Log In</a>
                    <p></p>
                    </span>
                </div>
            </div>
            <div class="footer-center">
                <div>
                    <i class="fa fa-phone"></i>
                    <p><span>Astro Booking Dublin HQ : 1850-20-Times</span><br>
                </div>
                <div>
                    <i class="fa fa-phone"></i>
                    <p><span>Astro Booking Cork : 1850-123546</span></br>
                </div>
                <div>
                    <i class="fa fa-phone"></i>
                    <p><span>Astro Booking Cavan : No Phone Available</span></p>
                </div>
            </div>
            <div class="footer-right">
            <p class="footer-company-about">
                </br>
                </br>
                </br>
            <div class="row">
                <span class="hidden-xs">
                    <span>
                        <h3>Astro Booking
                    </span>
                    </h3>
                    <p></p>
                    <h4>
                        <font color="white">
                            Choose Location | Pick A Time Slot | Pay and Play
                            </p>
            </div>
            </span>
            <div class="footer-icons">
            <a href="https://www.facebook.com/astrobooking" target="_blank"><i class="fa fa-facebook"></i></a>
            <a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a>
            <a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i></a>
            <a href="https://www.pinterest.com/" target="_blank"><i class="fa fa-pinterest-square"></i></a>
            <a href="https://www.linkedin.com/" target="_blank"><i class="fa fa-linkedin"></i></a>
            <a href="https://www.youtube.com/" target="_blank" <i class="fa fa-youtube"></i></a>
            </br>
            </br></font>
        </footer>
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