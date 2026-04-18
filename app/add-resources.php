<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$rID = $_GET['id'];

$sql = mysqli_query($con, "SELECT * from tblserviceyr ORDER BY serviceYrID DESC LIMIT 1");
$lsyrow = mysqli_fetch_array($sql);


$trainingTitle = str_replace(array( '\'', '"', "'",
    ';','*' ), '', strip_tags($_POST['trainingTitle']));
// echo $serviceYrID; exit;
$resourceFile =  strip_tags($_FILES["fileName"]["name"]);
$resourceFileSize =  strip_tags($_FILES["fileName"]["size"]);
$loggedin = $_SESSION['login'];
if (isset($_POST['submit'])) {

	$find = '.';
	$pos = strrpos($resourceFile, $find) + 1;
	$extension = '.' . substr($resourceFile, $pos);
	$allowed_extensions = array(".pptx", ".ppt", ".pdf");


	$unit = 'kb';
	$size = round($resourceFileSize / 1000, 1);
	// $size = ceil($size);
	if ($size < 1000) {
		$size = $size;
		$unit = 'kb';
	} else if ($size >= 1000) {
		$size = $size / 1000;
		$unit = 'mb';
	} else if ($size >= 100000) {
		$size = $size / 100000;
		$unit = 'gb';
	}
	$actualsize =  $size . ' ' . $unit;

	// $stringlength = strlen($resourceFileSize);
	// if ($stringlength >= 1 && $stringlength <= 3) {
	// 	$sizeIN = 'byte';
	// } else if ($stringlength >= 4 && $stringlength <= 6) {
	// 	$sizeIN = 'kb';
	// } else if ($stringlength >= 7 && $stringlength <= 9) {
	// 	$sizeIN = 'mb';
	// }
	// echo $sizeIN; exit;

	// allowed extensions
	// echo $resourceFileSize; exit;

	if (!in_array($extension, $allowed_extensions)) {
		echo "<script>alert('Invalid format. Only PPTX / PDF format allowed');</script>";
	} else if ($resourceFileSize > 2000000) {
		echo "<script>alert('OOP!. Maximum Size of 2mb Exceeded');</script>";
	} else {
		//rename the image file
		$extension = str_replace(array('.'), '', $extension);

		$newresourceFile = date('d-m-Y') . '_' . $resourceFile;

		$resource_insert_sql = "INSERT into tblresources values(null, '$trainingTitle', '$newresourceFile', '$extension', '$actualsize', now(), '$loggedin')";
// 		echo ($resource_insert_sql);
// 		exit;
		$resource_result = mysqli_query($con, $resource_insert_sql);
		if ($resource_result) {
			move_uploaded_file($_FILES["fileName"]["tmp_name"], "../resources/" . $newresourceFile);
			echo "<script>alert('Resource Added Successfully');</script>";
			echo "<script>window.location.href ='resources-centre'</script>";
		}
	}
}
if (isset($_POST['update'])) {
	// echo $lsy_theme; exit;
	if (!empty($resourceFile)) {
		$find = '.';
		$pos = strrpos($resourceFile, $find) + 1;
		$extension = '.' . substr($resourceFile, $pos);
		$allowed_extensions = array(".pptx", ".ppt", ".pdf");


		$unit = 'kb';
		$size = round($resourceFileSize / 1000, 1);
		// $size = ceil($size);
		if ($size < 1000) {
			$size = $size;
			$unit = 'kb';
		} else if ($size >= 1000) {
			$size = $size / 1000;
			$unit = 'mb';
		} else if ($size >= 100000) {
			$size = $size / 100000;
			$unit = 'gb';
		}
		$actualsize =  $size . ' ' . $unit;
		if (!in_array($extension, $allowed_extensions)) {
			echo "<script>alert('Invalid format. Only PPTX / PDF format allowed');</script>";
		} else if ($resourceFileSize > 2000000) {
			echo "<script>alert('OOP!. Maximum Size of 2mb Exceeded');</script>";
		} else {
			//rename the image file

			$newresourceFile = date('d-m-Y') . '_' . $resourceFile;
		}
	}

			$sql = "UPDATE tblresources  SET trainingTitle = '$trainingTitle',  dateUpdated = now(), updatedBy = '$loggedin'";
			// echo ($sql);
			// exit;
			if (!empty($resourceFile)) {
				$sql .= " fileName = '$newresourceFile', fileType = '$extension', 
		fileSize =' $actualsize', ";
			}
			$sql .= " WHERE resourceID = $rID";
			// echo $sql; exit;
			$result = mysqli_query($con, $sql);
			if ($result) {
				if (!empty($resourceFile)) {
					move_uploaded_file($_FILES["fileName"]["tmp_name"], "../resources/" . $newresourceFile);
				}
				echo "<script>alert('Resource Updated Successfully');</script>";
				echo "<script>window.location.href ='resources-centre'</script>";
			}
		}
	

include("assets/topheader.php");
?>
<title>Admin | Resource Centre</title>
<script>
	function checkTitleAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			url: "assets/check_all_others.php",
			data: 'trainingTitle=' + $("#trainingTitle").val(),
			type: "POST",
			success: function(data) {
				$("#title-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}
</script>
</head>

<body class="nav-md">
	<?php

	$page_title = 'Add Resources';
	$x_content = true;
	?>
	<?php include('include/header.php');


	// For Editing
	if (!empty($rID)) {
		$query = "SELECT * from tblresources where resourceID = $rID";
		// echo $query; exit;
		$resource_sql = mysqli_query($con, $query);
		$row = mysqli_fetch_array($resource_sql);
	}
	?>

	<div class="row">
		<div class="col-md-12">

			<div class="row margin-top-30">
				<div class="col-lg-6 col-md-12 ">
					<div class="panel panel-white">
						<div class="panel-body">

							<form role="form" name="addresources" action="" enctype="multipart/form-data" method="post" onSubmit="return valid();">


								<div class="form-group">
									<label for="trainingTitle">
										Training Title
									</label>
									<input type="text" name="trainingTitle" id="trainingTitle" class="form-control" <?php if (!empty($rID) || $rID) { ?>value="<?php echo $row['trainingTitle']; ?>" <?php } else { ?> placeholder="Enter training title" <?php } ?> required="true"
										onBlur="checkTitleAvailability()">
									<span id="title-availability-status"></span>
								</div>
								<div class="form-group">
									<label for="fileName">
										Select Resource File <em>(.pptx and .pdf only, not more than 2 mb)</em>
									</label>
									<input type="file" name="fileName" class="d-inline form-control" <?php if (empty($rID) || !$rID) { ?>required="true" <?php } ?>>
								</div>


								<button type="submit" <?php if (!empty($rID) || $rID) { ?> name="update" id="update" <?php } else { ?> name="submit" id="submit" <?php } ?> class="btn btn-o btn-primary">
									<?php if (!empty($rID) || $rID) { ?>Update <?php } else { ?> Submit <?php } ?>
								</button>
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
		<div class="col-lg-12 col-md-12">
			<div class="panel panel-white">


			</div>
		</div>
	</div>
	<!-- start: FOOTER -->
	<?php include('include/footer.php');
	include('assets/app-footer.php');
	?>

</body>

</html>