<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if (!empty($_GET['p'])) {
	if ($_GET['p'] = 'photos') {
		$photos = $_GET['p'];
	} else if ($_GET['p'] = 'videos') {
		$videos = $_GET['p'];
	}
}

if ($photos) {


	$eventTitle = strip_tags($_POST['eventTitle']);
	$galleryPhotos =  str_replace(array("JPG"), 'jpg', $_FILES["foto"]["name"]);
	$galleryPhotos =  str_replace(array(
		'\'',
		'"',
		'(',
		')',
		';',
		'*',
		' '
	), '_', $galleryPhotos);
	$galleryPhotossize =  $_FILES["foto"]["size"];


	$loggedin = $_SESSION['login'];
	if (isset($_POST['submit'])) {

		$countFiles = count($galleryPhotos);

		for ($i = 0; $i < $countFiles; $i++) {
			$arraygalleryPhotos = $galleryPhotos[$i];

			$find = '.';

			// foto
			$pos = strrpos($arraygalleryPhotos, $find) + 1;
			// get the image extension
			$extension = '.' . substr($arraygalleryPhotos, $pos);

			// allowed extensions
			$allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");

			if ($galleryPhotossize[$i] > 5000000) {
				echo "<script>alert('OOP!. Maximum Array Size of 5mb Exceeded');</script>";
			}elseif (!in_array($extension, $allowed_extensions)) {
				// $error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
				echo "<script>alert('Invalid format for Author Photo. Only jpg / jpeg/ png /gif format allowed');</script>";
			} else {

				//rename the image file
				$newfoto = strtolower(md5($arraygalleryPhotos) . $extension);
				// echo $newfoto; exit;

				$photo_insert_sql = "INSERT into image_gallery values(null,'$eventTitle','$newfoto', now())";
				// echo ($photo_insert_sql);
				// exit;
				$photo_result = mysqli_query($con, $photo_insert_sql);
				if ($photo_result) {
					move_uploaded_file($_FILES["foto"]["tmp_name"][$i], "gallery/" . $newfoto);
					echo "<script>alert('Photos Added Successfully');</script>";
					echo "<script>window.location.href ='gallery.php?p=photos'</script>";
				}
			}
		}
	}
}
include("assets/topheader.php");
?>
<title>Admin | Add Gallery</title>
</head>

<body class="nav-md">
	<?php

	$page_title = 'Add Gallery ';
	$x_content = true;
	?>
	<?php include('include/header.php');

	?>

	<div class="row">
		<div class="col-md-12">

			<div class="row margin-top-30">
				<div class="col-lg-6 col-md-12 ">
					<div class="panel panel-white">
						<div class="panel-body">

							<form role="form" name="addauthor" action="" enctype="multipart/form-data" method="post" onSubmit="return valid(); enc">


								<div class="form-group">
									<label for="eventTitle">
										Event Title
									</label>
									<input type="text" name="eventTitle" id="eventTitle" class="form-control" placeholder="Optional">
								</div>
								<div class="form-group">
									<label for="foto">
										Select Photos
									</label>
									<input type="file" name="foto[]" class="form-control" accept="image/*" multiple>
								</div>


								<button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">
									Submit
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