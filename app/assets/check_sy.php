<?php 
require_once("../include/config.php");
if(!empty($_POST["lsy"])) {
	$lsy= $_POST["lsy"];
	
		$sql = 	"SELECT * FROM tblserviceyr WHERE serviceYr='$lsy'";
		$result =mysqli_query($con, $sql);
		if ($result || !empty($result)) {
			$count=mysqli_num_rows($result);
		}
if($count>0)
{
echo "<span style='color:red'> Service Year already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Service Year available for Registration .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}


?>
