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
if (isset($_GET['del'])) {
	$sqll = "select * from image_gallery WhERE photoID  = '" . $_GET['id'] . "'";
	// echo $sqll; exit;
	 $query = mysqli_query($con, $sqll);
	$rows = mysqli_fetch_array($query);
	mysqli_query($con, "delete from image_gallery where photoID  = '" . $_GET['id'] . "'");

	$path = $_SERVER['DOCUMENT_ROOT'] . "/app/gallery/" . $rows['foto'];
	unlink($path);

	echo "<script>alert('Photo Deleted');</script>";
	echo "<script>window.location.href ='gallery.php?p=photos'</script>";
	
}
include("assets/topheader.php");
?>
<style>
	.scrollable {
		height: 620px !important;
		overflow-y: scroll !important;
	}
</style>
<title>Admin | Gallery</title>
</head>

<body class="nav-md">
	<?php
	$page_title = 'Admin | Gallery';
	$x_content = true;
	?>
	<?php include('include/header.php');

	if ($photos) {

		$sql = mysqli_query($con, "select * from image_gallery");
		// $rows=mysqli_fetch_array($sql);
	} elseif ($videos) {
		$vsql = mysqli_query($con, "select * from video_gallery");
	}
	?>
	<div class="row scrollable">
		<?php
		if ($photos) { ?>
			<a href="add-gallery?p=photos" class="btn btn-transparent btn-xs" title="Add Photos" tooltip-placement="top" tooltip="Add Photos"><i class="fa fa-plus"></i></a>

			<div class="col-md-12">
				<div class="row">
					<?php while ($row = mysqli_fetch_array($sql)) { ?>
						<div class="col-lg-3 col-md-6 col-sm-12  col-xs-12 p-5">
							<div class="tile_count">
								<div class="m-auto text-center">
									<img class="gallery-img img-fluid mb-4" src="gallery/<?php echo $row['foto']; ?>" alt="">

									<a href="?id=<?php echo $row['photoID'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-xs tooltips" tooltip-placement="top" tooltip="Remove" title="Remove photo"><i class="fa fa-times"></i></a>

								</div>
							</div>

						</div>
					<?php } ?>
				</div>
			</div>
		<?php } elseif ($videos) { ?>
			<a href="add-gallery?p=videos" class="btn btn-transparent btn-xs" title="Add Videos" tooltip-placement="top" tooltip="Add Videos"><i class="fa fa-plus"></i></a>
			<div class="col-md-12">
				<div class="row">
					<?php while ($vrow = mysqli_fetch_array($vsql)) { ?>
						<div class="col-lg-3 col-md-6 col-sm-12  col-xs-12 p-5">
							<div class="tile_count">
								<div class="m-auto text-center">
									<img class="img-fluid mb-4" src="gallery/<?php echo $vrow['video']; ?>" alt="">

									<a href="?id=<?php echo $vrow['photoID'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-xs tooltips" tooltip-placement="top" tooltip="Remove" title="Remove photo"><i class="fa fa-times"></i></a>

								</div>
							</div>

						</div>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
	</div>
	<?php include('include/footer.php');
	include('assets/app-footer.php');
	?>

</body>