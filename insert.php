<?php

include_once("db-connect.php");

$db = new DB();

require('db.php');
include("auth.php");
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
    $submittedby = $_SESSION["username"];
    $ins_query="insert into locations
    (`unique_location_id`,`name`,`address`,`owner`, `contact_number`,`email`,`latitude`,`longitude`,`trn_date`,`submittedby`)values
    ('$unique_location_id','$name','$address','$owner','$contactnumber','$email','$latitude','$longitude','$trn_date','$submittedby')";
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
    $status = "New Record Inserted Successfully.
    </br></br><a href='/view.php'>View Inserted Record</a>";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Insert New Record</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<p><a href="dashboard.php">Dashboard</a> 
| <a href="view.php">View Records</a> 
| <a href="logout.php">Logout</a></p>
<div>
<h1>Add a new pitch</h1>
<form name="form" method="post" action=""> 
<input type="hidden" name="new" value="1" />
<p><input type="text" name="name" placeholder="Enter Name" required /></p>
<p><input type="text" name="address" placeholder="Enter Address" required /></p>
<p><input type="text" name="owner" placeholder="Enter Owner" required /></p>
<p><input type="text" name="contactnumber" placeholder="Enter Contact Number" required /></p>
<p><input type="email" name="email" placeholder="Enter Email" required /></p>
<p><input type="text" name="latitude" placeholder="Enter Latitude" required /></p>
<p><input type="text" name="longitude" placeholder="Enter Longitude" required /></p>
 <table class="timetable"> 
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
    echo '<td class="timeslot"><input type="number" name="opening['.$day.']" value="9" min="0" max="23">:00</td>';
    echo '<td class="timeslot"><input type="number" name="closing['.$day.']" value="23" min="0" max="23">:00</td>';
    echo '</tr>';
    echo '<input type="hidden" name="day[]" value="'.$day.'">';
    $i++; 
} 
    echo'</table>';
  
?> 
              
<p><input name="submit" type="submit" value="Submit" /></p>
</form>
<p style="color:#FF0000;"><?php echo $status; ?></p>
</div>
</div>
</body>
</html>