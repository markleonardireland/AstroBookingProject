<?php

include_once("db-connect.php");

$db = new DB();


$first_name = $db->escape($_POST['firstname']);
$last_name = $db->escape($_POST['lastname']);
$email_address = $db->escape($_POST['email']);
$member_id = $db->escape($_POST['member_id']);
$contact_number = $db->escape($_POST['contactno']);

 
$sql="UPDATE users SET `firstname`='".$first_name."', `lastname`='".$last_name."', `email`='".$email_address."', `contactno`= '".$contact_number."' WHERE `member_id` =$member_id";
 
if (!$db->query($sql))
  {
  die('Error: ' . $db->error());
  }
else{
 
$db->close();
header("Location: members-dashboard.php");
exit(); }
?>