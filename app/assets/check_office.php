<?php 
require_once("../include/config.php");
if(!empty($_POST["office"])) {
	$office= $_POST["office"];
	
		$sql = 	"SELECT * FROM tbloffices WHERE position='$office'";
		// echo ($sql); exit;
		$result =mysqli_query($con, $sql);
		if ($result || !empty($result)) {
			$count=mysqli_num_rows($result);
		}
if($count>0)
{
echo "<span style='color:red'> Office already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Office available for Registration .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}


?>
