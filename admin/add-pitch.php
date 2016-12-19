 <!--* add-pitch.php-->
 <!--* Version 1-->
 <!--* Date e.g. 01/11/2016-->
 <!--* @reference http://www.w3schools.com/sql/-->
 <!--* @author Kevin O'Rourke x15042782 -->

<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/db-connect.php');

$db = new DB();

require($_SERVER['DOCUMENT_ROOT'] . '/db.php');
include("admin-auth.php");
$status = "";

if(isset($_POST['new']) && $_POST['new']==1){
    
    $unique_location_id = rand(1000000000, 9999999999);
    $result      = $db->query('select * from locations;');
$locationIds = array();
while ($row = $db->fetch_assoc($result)) {
                $locationIds[] = $row['unique_location_id'];
}

while (in_array($unique_location_id, $locationIds)) {
                $unique_location_id = rand(1000000000, 9999999999);
}

    $trn_date = date("Y-m-d H:i:s");
    $name =$_REQUEST['name'];
    $address = $_REQUEST['address'];
    $owner = $_REQUEST['owner'];
    $contactnumber =$_REQUEST['contactnumber'];
    $email = $_REQUEST['email'];
    $latitude = $_REQUEST['latitude'];
    $longitude = $_REQUEST['longitude'];
    $price = $_REQUEST['price'];
    $submittedby = $_SESSION["username"];
    $ins_query="insert into locations
    (`unique_location_id`,`name`,`address`,`owner`, `contact_number`,`email`,`latitude`,`longitude`,`trn_date`,`submittedby`,`price`)values
    ('$unique_location_id','$name','$address','$owner','$contactnumber','$email','$latitude','$longitude','$trn_date','$submittedby','$price')";
    mysqli_query($con,$ins_query)
    or die(mysql_error());
    
    foreach($_POST['day'] as $day){
                
                
                $opening = $_POST['opening'][$day];
                $closing = $_POST['closing'][$day];
              
                //$opening_arr = explode(":", $opening);
                //$closing_arr = explode(":", $closing);
                
                $opening = $opening.'0000';
                $closing = $closing.'0000';
            
                $sql = "insert into opening_times
                                    (`unique_location_id`, `day`, `opening`, `closing`) 
                                    values('$unique_location_id', '$day', '$opening','$closing')";
                if (!$db->query($sql))
                            {
                                 die('Error: ' . $db->error());
                             }                    
    }
    header("Location: https://teamproject-x14562027.c9users.io/admin/admin-dashboard.php");
exit();
}
?>