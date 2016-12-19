<?php
    include_once( $_SERVER['DOCUMENT_ROOT'] . '/db-connect.php' );

$db = new DB();

// session_start();
//   $username = $_SESSION["username"];
//  $result1 = $db->query("SELECT * FROM `users` WHERE username = '".$username."'  LIMIT 1");
//     if (mysql_num_rows($result1) == 1) {
//                     $adminuser_details = $db->fetch_assoc($result1);
                   
//                   $username  = $adminuser_details['username']; 
                   
//     	}


// //Get the location and user from the URL
$userid = htmlspecialchars($_GET["user"]);
$location = htmlspecialchars($_GET["location"]);

//Add the location to the users favourites
$sql = "INSERT INTO user_favourites VALUES (". $userid . ", " .$location.")";
echo $sql;
$result = mysql_query($sql) or die(mysql_error());


?>