<?php 

// CHECK REGION AVAILABILITY

require_once("../include/config.php");
if(!empty($_POST["region"])) {
	$region= $_POST["region"];
	
		$sql = 	"SELECT * FROM tblregion WHERE region='$region'";
		$result =mysqli_query($con, $sql);
		if ($result || !empty($result)) {
			$count=mysqli_num_rows($result);
		}
if($count>0)
{
echo "<span style='color:red'> Region already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Region available for Registration .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}


// CHECK REGION CHAIR AVAILABILITY
if(!empty($_POST["rcname"])) {
	$rcname= $_POST["rcname"];
	
		$sql = 	"SELECT * FROM tblregionchairperson WHERE fullName='$rcname'";
		$result =mysqli_query($con, $sql);
		if ($result || !empty($result)) {
			$count=mysqli_num_rows($result);
		}
if($count>0)
{
echo "<span style='color:red'> Region Chairperson already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Region Chairperson available for Registration .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}



// ZONE CHAIR AVAILABILITY
if(!empty($_POST["zcname"])) {
	$zcname= $_POST["zcname"];
	
		$sql = 	"SELECT * FROM tblzonechairperson WHERE fullName='$zcname'";
		$result =mysqli_query($con, $sql);
		if ($result || !empty($result)) {
			$count=mysqli_num_rows($result);
		}
if($count>0)
{
echo "<span style='color:red'> Zone Chairperson already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Zone Chairperson available for Registration .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}


// CHECK CLUBS AVAILABILITY
if(!empty($_POST["club"])) {
	$club= $_POST["club"];
	
		$sql = 	"SELECT * FROM tblclubs WHERE clubName	='$club'";
		$result =mysqli_query($con, $sql);
		if ($result || !empty($result)) {
			$count=mysqli_num_rows($result);
		}
if($count>0)
{
echo "<span style='color:red'> Club already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Club available for Registration .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}



// CHECK CLUB PRESIDENTS AVAILABILITY
if(!empty($_POST["cpname"])) {
	$cpname= $_POST["cpname"];
	
		$sql = 	"SELECT * FROM tblclubpresidents WHERE fullName	='$cpname'";
		$result =mysqli_query($con, $sql);
		if ($result || !empty($result)) {
			$count=mysqli_num_rows($result);
		}
if($count>0)
{
echo "<span style='color:red'> Club President already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Name available for Registration .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
// CHECK CLUBS AVAILABILITY
if(!empty($_POST["club"])) {
	$club= $_POST["club"];
	
		$sql = 	"SELECT * FROM tblclubs WHERE clubName	='$club'";
		$result =mysqli_query($con, $sql);
		if ($result || !empty($result)) {
			$count=mysqli_num_rows($result);
		}
if($count>0)
{
echo "<span style='color:red'> Club already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Club available for Registration .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}


// CHECK CATEGORY AVAILABILITY
if(!empty($_POST["category"])) {
	$category= $_POST["category"];
	
		$sql = 	"SELECT * FROM tblcategory WHERE categoryName='$category'";
		$result =mysqli_query($con, $sql);
		if ($result || !empty($result)) {
			$count=mysqli_num_rows($result);
		}
if($count>0)
{
echo "<span style='color:red'> category already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> category available for Registration .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}

// CHECK DG TEAM AVAILABILITY
if(!empty($_POST["dgteam"])) {
	$dgteam= $_POST["dgteam"];
	
		$sql = 	"SELECT * FROM tbldgteam WHERE fullName='$dgteam'";
		$result =mysqli_query($con, $sql);
		if ($result || !empty($result)) {
			$count=mysqli_num_rows($result);
		}
if($count>0)
{
echo "<span style='color:red'> Team Member already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Team Member available for Registration .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}


}
// CHECK EVENTS AVAILABILITY
if(!empty($_POST["eventTitle"])) {
	$eventTitle= $_POST["eventTitle"];
	
		$sql = 	"SELECT * FROM  tblevents WHERE eventTitle='$eventTitle'";
		$eventTitleresult =mysqli_query($con, $sql);
		if ($eventTitleresult || !empty($eventTitleresult)) {
			$eventTitlecount=mysqli_num_rows($eventTitleresult);
		}
if($eventTitlecount>0)
{
echo "<span style='color:red'> Event already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Event available for Registration .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}


// CHECK ACCEPTANCE SPEECH AVAILABILITY
if(!empty($_POST["docName"])) {
	$docName= $_POST["docName"];
	
		$sql = 	"SELECT * FROM  tblacceptancespeech WHERE docName='$docName'";
		$docNameresult =mysqli_query($con, $sql);
		if ($docNameresult || !empty($docNameresult)) {
			$docNamecount=mysqli_num_rows($docNameresult);
		}
if($docNamecount>0)
{
echo "<span style='color:red'> Document already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Document available for Registration .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}


// CHECK CORE OFFICER AVAILABILITY
if(!empty($_POST["coreofficers"])) {
	$coreofficers= $_POST["coreofficers"];
	
		$sql = 	"SELECT * FROM  tblcoreofficers WHERE fullName='$coreofficers'";
		$coreofficersresult =mysqli_query($con, $sql);
		if ($coreofficersresult || !empty($coreofficersresult)) {
			$coreofficerscount=mysqli_num_rows($coreofficersresult);
		}
if($coreofficerscount>0)
{
echo "<span style='color:red'> Core officer already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Core officer available for Registration .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}


?>
