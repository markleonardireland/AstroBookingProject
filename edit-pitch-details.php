<?php

include_once("db-connect.php");

$db = new DB();


$pitchname = $db->escape($_POST['pitchname']);
$address = $db->escape($_POST['address']);
$email_address = $db->escape($_POST['email']);
$unique_location_id = $db->escape($_POST['unique_location_id']);
$contact_number = $db->escape($_POST['contactnumber']);
$owner = $db->escape($_POST['owner']);
$latitude = $db->escape($_POST['latitude']);
$longitude = $db->escape($_POST['longitude']);
$price = $db->escape($_POST['price']);
 
$sql="UPDATE locations SET `name`='".$pitchname."', `address`='".$address."', `email`='".$email_address."', `contact_number`= '".$contact_number."',`owner`='".$owner."', 
`latitude`='".$latitude."', `longitude`='".$longitude."',`price`='".$price."' WHERE `unique_location_id` =$unique_location_id";
 
if (!$db->query($sql))
  {
  die('Error: ' . $db->error());
  }
else{
 
$db->close();
header("Location: pitch-dashboard.php?locationid=$unique_location_id");
exit(); }
?>