<!DOCTYPE html>

<div class="row row-centered">
    <div class="form-group">
        <div class="col-sm-2">
     </div>
    
<form method="get" action="/booking/pick-slot.php">
<?php
include_once("db-connect.php");

$db = new DB();
$location = $_GET['searchchosenlocation'];

$result = $db->query('select `name` from `locations`');
$locations = array();
while ($row = $db->fetch_assoc($result)) {
  $locations[] = $row['name'];
}
    print '<div class="col-sm-3"><select name="searchchosenlocation" class="form-control" data-live-search="true">';
  $locations_lenght = count($locations);
  $i = 0;
  while ($i < $locations_lenght){
      if($location == $locations[$i]){
          print '<option value="'.$locations[$i].'" selected>'.$locations[$i]. '</option>';
      }else{
  print '<option value="'.$locations[$i].'">'.$locations[$i]. '</option>';
      }
  $i++;
}
print '</select></div>';

if (!empty($_GET["date"])) {
      $chosen_date = $_GET['date'];    
}else{  
    $chosen_date=date("Y-m-d");
}


$todays_date=date("Y-m-d");
?>
 <div class="col-sm-3">
     <input type="date" class="form-control" name="date" value="<?php echo $chosen_date; ?>" min = "<?php echo  $todays_date; ?>"/>
  </div>
  <div class="col-sm-2">
  <input type="submit" class = "btn btn-primary btn-lg" name="submit" value="Search"/>
  </div>
  <div class="col-sm-2">
     </div>
</form>
</div>
</div>
