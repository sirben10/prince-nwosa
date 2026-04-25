<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

$galleryType = isset($_GET['p']) ? $_GET['p'] : '';
$photos = ($galleryType === 'photos');
$videos = ($galleryType === 'videos');

// Handle Photo Deletion
if (isset($_GET['del']) && $galleryType === 'photos') {
	$sqll = "select * from image_gallery WHERE photoID  = '" . $_GET['id'] . "'";
	$query = mysqli_query($con, $sqll);
	$rows = mysqli_fetch_array($query);
	mysqli_query($con, "delete from image_gallery where photoID  = '" . $_GET['id'] . "'");

	$path = $_SERVER['DOCUMENT_ROOT'] . "/app/gallery/" . $rows['foto'];
	if (file_exists($path)) {
		unlink($path);
	}

	echo "<script>alert('Photo Deleted');</script>";
	echo "<script>window.location.href ='gallery.php?p=photos'</script>";
}

// Handle Video Deletion
if (isset($_GET['del']) && $galleryType === 'videos') {
	$sqll = "select * from video_gallery WHERE videoID  = '" . $_GET['id'] . "'";
	$query = mysqli_query($con, $sqll);
	$rows = mysqli_fetch_array($query);
	mysqli_query($con, "delete from video_gallery where videoID  = '" . $_GET['id'] . "'");

	$path = $_SERVER['DOCUMENT_ROOT'] . "/app/video-gallery/" . $rows['videoName'];
	if (file_exists($path)) {
		unlink($path);
	}
	
	// Delete thumbnail if exists
	$thumbPath = $_SERVER['DOCUMENT_ROOT'] . "/app/video-gallery/thumbnails/" . $rows['thumbnail'];
	if (!empty($rows['thumbnail']) && file_exists($thumbPath)) {
		unlink($thumbPath);
	}

	echo "<script>alert('Video Deleted');</script>";
	echo "<script>window.location.href ='gallery.php?p=videos'</script>";
}

include("assets/topheader.php");
?>
<style>
	.scrollable {
		height: 620px !important;
		overflow-y: scroll !important;
	}
	.video-thumbnail {
		position: relative;
		cursor: pointer;
		border-radius: 8px;
		overflow: hidden;
		background: #333;
		min-height: 150px;
	}
	.video-thumbnail:hover .play-overlay {
		opacity: 1;
	}
	.play-overlay {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: rgba(0,0,0,0.4);
		display: flex;
		align-items: center;
		justify-content: center;
		opacity: 0;
		transition: opacity 0.3s ease;
	}
	.play-overlay i {
		font-size: 50px;
		color: white;
	}
	.video-title {
		font-size: 14px;
		margin-top: 10px;
		font-weight: 600;
	}
	/* Modal Styles */
	.modal-video .modal-dialog {
		max-width: 800px;
		margin: 30px auto;
	}
	.modal-video .modal-content {
		background: #000;
		border: none;
	}
	.modal-video .modal-header {
		border: none;
		padding: 10px;
	}
	.modal-video .close {
		color: #fff;
		opacity: 1;
		font-size: 30px;
	}
	.modal-video video {
		width: 100%;
		max-height: 70vh;
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
	} elseif ($videos) {
		$vsql = mysqli_query($con, "select * from video_gallery");
	}
	?>
	<div class="row scrollable">
		<?php
		if ($photos) { ?>
			<a href="add-gallery?p=photos" class="btn btn-transparent btn-sm" title="Add Photos" tooltip-placement="top" tooltip="Add Photos"> <i class="fa fa-plus"></i> Upload</a>

			<div class="col-md-12">
				<div class="row">
					<?php while ($row = mysqli_fetch_array($sql)) { ?>
						<div class="col-lg-3 col-md-6 col-sm-12  col-xs-12 p-5">
							<div class="tile_count">
								<div class="m-auto text-center">
									<img class="gallery-img img-fluid mb-4" src="gallery/<?php echo $row['foto']; ?>" alt="">

									<a href="?id=<?php echo $row['photoID'] ?>&del=delete&p=photos" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-xs tooltips" tooltip-placement="top" tooltip="Remove" title="Remove photo"><i class="fa fa-times"></i></a>

								</div>
							</div>

						</div>
					<?php } ?>
				</div>
			</div>
		<?php } elseif ($videos) { ?>
			<a href="add-gallery?p=videos" class="btn btn-transparent btn-xs" title="Add Videos" tooltip-placement="top" tooltip="Add Videos"><i class="fa fa-plus"></i> Upload</a>
			<div class="col-md-12">
				<div class="row">
					<?php while ($vrow = mysqli_fetch_array($vsql)) { ?>
						<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 p-5">
							<div class="tile_count">
								<div class="m-auto text-center">
									<!-- Video Thumbnail with Play Button -->
									<div class="video-thumbnail gallery-img" onclick="playVideo('video-gallery/<?php echo $vrow['videoName']; ?>', '<?php echo addslashes($vrow['videoTitle']); ?>')">
										<div class="play-overlay">
											<i class="fa fa-play-circle"></i>
										</div>
									</div>
									
									<p class="video-title"><?php echo $vrow['videoTitle']; ?></p>

									<a href="?id=<?php echo $vrow['videoID'] ?>&del=delete&p=videos" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-xs tooltips" tooltip-placement="top" tooltip="Remove" title="Remove video"><i class="fa fa-times"></i></a>

								</div>
							</div>

						</div>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
	</div>

	<!-- Video Modal -->
	<div class="modal fade modal-video" id="videoModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-white" id="videoTitle"></h4>
				</div>
				<div class="modal-body">
					<video id="videoPlayer" controls>
						<source src="" type="video/mp4">
						Your browser does not support the video tag.
					</video>
				</div>
			</div>
		</div>
	</div>

	<?php include('include/footer.php');
	include('assets/app-footer.php');
	?>

	<script>
		function playVideo(videoSrc, title) {
			document.getElementById('videoTitle').textContent = title;
			document.getElementById('videoPlayer').src = videoSrc;
			$('#videoModal').modal('show');
		}
		
		$('#videoModal').on('hidden.bs.modal', function () {
			document.getElementById('videoPlayer').pause();
			document.getElementById('videoPlayer').currentTime = 0;
		});
	</script>

</body>