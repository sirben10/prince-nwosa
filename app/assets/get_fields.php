<?php

require_once("../include/config.php");

// FETCH ZONES BY REGION
if(!empty($_POST["region"])) 
{
 $region=intval($_POST['region']);
$query=mysqli_query($con,"SELECT * FROM tblzone WHERE regionID =$region");
?>
<option value="">Select Zone</option>
<?php
 while($row=mysqli_fetch_array($query))
 {
  ?>
  <option value="<?php echo htmlentities($row['zoneID']); ?>">Zone <?php echo htmlentities($row['zoneName']); ?></option>
  <?php
 }
}

// FETCH CLUBS BY ZONES
if(!empty($_POST["zone"])) 
{
 $zone=intval($_POST['zone']);
$query=mysqli_query($con,"SELECT * FROM tblclubs WHERE zoneID =$zone");
?>
<option value="">Select Zone</option>
<?php
 while($row=mysqli_fetch_array($query))
 {
  ?>
  <option value="<?php echo htmlentities($row['clubID']); ?>"> <?php echo htmlentities($row['clubName']); ?></option>
  <?php
 }
}
exit;

?>