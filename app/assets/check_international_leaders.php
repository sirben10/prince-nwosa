<?php 
require_once("../include/config.php");
if(!empty($_POST["fullname"])) {
	$fullname= $_POST["fullname"];
	
		$sql = 	"SELECT * FROM tblinternationalleaders WHERE fullName='$fullname'";
		$result =mysqli_query($con, $sql);
		if ($result || !empty($result)) {
			$count=mysqli_num_rows($result);
		}
if($count>0)
{
echo "<span style='color:red'> Leader name already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Leader name available for Registration .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}


?>
