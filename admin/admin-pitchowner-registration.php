 <!--* Version 1-->
 <!--* Date e.g. 01/11/2016-->
 <!--* @reference http://www.w3schools.com/sql/-->
 <!--* @author Kevin O'Rourke x15042782 -->
 
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/db.php');

include_once($_SERVER['DOCUMENT_ROOT'] . '/db-connect.php');

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
	$uniquelocationid = stripslashes($_REQUEST['unique_location_id']);
	$email = mysqli_real_escape_string($con,$email);
	$contactno = stripslashes($_REQUEST['contactno']);
	$contactno = mysqli_real_escape_string($con,$contactno);
	$trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` ( username, password, firstname, lastname, email, contactno, access_level, trn_date, unique_location_id, member_id)
VALUES ( '$username', '".md5($password)."', '$firstname', '$lastname',  '$email', '$contactno','pitch', '$trn_date', '$uniquelocationid', '$member_id')";
       
        if (!$db->query($query))
  {
  die('Error: ' . $db->error());
  }
else{
 
$db->close();
header("Location: admin-dashboard.php");
exit(); }
}
?>