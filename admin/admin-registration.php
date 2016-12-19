
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
	$contactno = stripslashes($_REQUEST['contactno']);
	$contactno = mysqli_real_escape_string($con,$contactno);
	$trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` ( username, member_id, password, firstname, lastname, email, contactno,access_level, trn_date)
VALUES ( '$username','$member_id', '".md5($password)."', '$firstname', '$lastname',  '$email', '$contactno','admin', '$trn_date')";
        $result = mysqli_query($con,$query);
        if($result){
           header("location: admin-dashboard.php");
    exit;
        }
}
 ?>
