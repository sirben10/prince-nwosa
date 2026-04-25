<?php
session_start();
ini_set('display_errors',1);
error_reporting(E_ALL);

include('include/config.php');
include('include/checklogin.php');
check_login();

// ============================================
// VIDEO PROCESSING CONFIGURATION
// ============================================

// =============================
// FFMPEG PATH (TRUEHOST)
// =============================

$ffmpegPath = '/usr/bin/ffmpeg';
$ffprobePath = '/usr/bin/ffprobe';

if (!file_exists($ffmpegPath)) {
    $ffmpegPath = 'ffmpeg';
}

if (!file_exists($ffprobePath)) {
    $ffprobePath = 'ffprobe';
}

/**
 * Extract video duration using FFprobe
 */
function getVideoDuration($videoPath, $ffprobePath = 'ffprobe') {
    $duration = 0;
    
    // Try FFprobe first
    $output = array();
    $returnVar = 0;
    $command = "$ffprobePath -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 \"" . escapeshellarg($videoPath) . "\"";
    @exec($command, $output, $returnVar);
    
    if (!empty($output[0]) && is_numeric($output[0])) {
        $duration = floatval($output[0]);
    }
    
    return $duration;
}

/**
 * Generate thumbnail from video at specified timestamp
 */
function generateVideoThumbnail($videoPath, $outputPath, $timestamp = '00:00:01', $ffmpegPath = 'ffmpeg', $width = 320, $height = 180) {
    $command = "$ffmpegPath -i \"" . escapeshellarg($videoPath) . "\" -ss " . escapeshellarg($timestamp) . " -vframes 1 -vf \"scale=min($width\,iw):min($height\,ih):force_original_aspect_ratio=decrease,pad=$width:$height:(ow-iw)/2:(oh-ih)/2\" -y \"" . escapeshellarg($outputPath) . "\" 2>&1";
    
    $output = array();
    $returnVar = 0;
    @exec($command, $output, $returnVar);
    
    return file_exists($outputPath) && filesize($outputPath) > 0;
}

function compressVideoSmart($inputPath, $outputPath, $ffmpegPath = '/usr/bin/ffmpeg') {

    if (!file_exists($inputPath)) {
        return false;
    }

    $originalSize = filesize($inputPath);

    // Compress ONLY if >10MB
    if ($originalSize < 10485760) {
        return false;
    }

    // 75% compression target
    $command =
        $ffmpegPath .
        " -i " . escapeshellarg($inputPath) .
        " -vcodec libx264 " .
        " -crf 28 " .
        " -preset veryfast " .
        " -acodec aac " .
        " -b:a 96k " .
        " -vf scale='min(1280,iw)':-2 " .
        " -movflags +faststart " .
        " -y " . escapeshellarg($outputPath) .
        " 2>&1";

    exec($command, $output, $returnCode);

    if ($returnCode === 0 && file_exists($outputPath)) {

        $compressedSize = filesize($outputPath);

        if ($compressedSize < $originalSize) {

            unlink($inputPath);

            return true;

        } else {

            unlink($outputPath);
            return false;
        }
    }

    return false;
}

/**
 * Format duration in seconds to HH:MM:SS
 */
function formatDuration($seconds) {
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds % 3600) / 60);
    $secs = floor($seconds % 60);
    
    return sprintf('%02d:%02d:%02d', $hours, $minutes, $secs);
}

// ============================================
// END VIDEO PROCESSING CONFIGURATION
// ============================================

// Determine gallery type from URL parameter
$galleryType = isset($_GET['p']) ? $_GET['p'] : '';
$isPhotos = ($galleryType === 'photos');
$isVideos = ($galleryType === 'videos');

// Handle Photo Upload
if ($isPhotos) {
	$eventTitle = strip_tags($_POST['eventTitle']);
	$galleryPhotos = isset($_FILES["foto"]["name"]) ? $_FILES["foto"]["name"] : array();
	$galleryPhotos = is_array($galleryPhotos) ? $galleryPhotos : array($galleryPhotos);
	$galleryPhotossize = isset($_FILES["foto"]["size"]) ? $_FILES["foto"]["size"] : array();
	$galleryPhotossize = is_array($galleryPhotossize) ? $galleryPhotossize : array($galleryPhotossize);

	$loggedin = $_SESSION['login'];
	if (isset($_POST['submit'])) {

		$countFiles = count(array_filter($galleryPhotos));

		for ($i = 0; $i < $countFiles; $i++) {
			if (empty($galleryPhotos[$i])) continue;
			
			$arraygalleryPhotos = preg_replace('/[^\w\.\-]/', '_', $galleryPhotos[$i]);

			$find = '.';
			$pos = strrpos($arraygalleryPhotos, $find);
			if ($pos === false) continue;
			
			$extension = strtolower(substr($arraygalleryPhotos, $pos));
			$allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif");

			// Total size check (100MB = 104857600 bytes)
			$totalSize = array_sum($galleryPhotossize);
			if ($totalSize > 104857600) {
				echo "<script>alert('OOP! Maximum total upload size of 100MB exceeded');</script>";
				break;
			} elseif ($galleryPhotossize[$i] > 5000000) {
				echo "<script>alert('OOP! Maximum file size of 5MB per image exceeded');</script>";
			} elseif (!in_array($extension, $allowed_extensions)) {
				echo "<script>alert('Invalid format. Only jpg / jpeg / png / gif format allowed');</script>";
			} else {
				$newfoto = strtolower(md5(time() . $arraygalleryPhotos . $i) . $extension);
				
				$photo_insert_sql = "INSERT into image_gallery values(null,?,?, now())";
				$stmt = mysqli_prepare($con, $photo_insert_sql);
				mysqli_stmt_bind_param($stmt, "ss", $eventTitle, $newfoto);
				$photo_result = mysqli_stmt_execute($stmt);
				
				if ($photo_result) {
					$uploadDir = "gallery/";
					if (!is_dir($uploadDir)) {
						mkdir($uploadDir, 0755, true);
					}
					move_uploaded_file($_FILES["foto"]["tmp_name"][$i], $uploadDir . $newfoto);
					echo "<script>alert('Photos Added Successfully');</script>";
					echo "<script>window.location.href ='gallery.php?p=photos'</script>";
				}
			}
		}
	}
}

	// Handle Video Upload
if ($isVideos) {
	
	if (isset($_POST['submit'])) {
	$videoTitle = strip_tags($_POST['videoTitle']);
	$videoCaption = strip_tags($_POST['videoCaption']);
	
	$videos = $_FILES["video"]["name"];
	$videosize = $_FILES["video"]["size"];

    $allowed_extensions = [
        ".mp4",".mov",".avi",".mkv",
        ".webm",".wmv",".flv",".m4v"
    ];

    $maxIndividualSize = 52428800; // 50MB
    $maxTotalSize = 104857600; // 100MB

    $totalSize = array_sum($videosize);

    if ($totalSize > $maxTotalSize) {

        echo "<script>alert('Total upload exceeds 100MB');</script>";
        exit;
    }

    $uploadDir = "video-gallery/";
    $thumbDir = "video-gallery/thumbnails/";

    if (!is_dir($uploadDir)) mkdir($uploadDir,0755,true);
    if (!is_dir($thumbDir)) mkdir($thumbDir,0755,true);

    $uploadedCount = 0;

    foreach ($videos as $i => $videoName) {

        if (empty($videoName)) continue;

        $extension = strtolower(strrchr($videoName,'.'));

        if (!in_array($extension,$allowed_extensions)) {
            continue;
        }

        if ($videosize[$i] > $maxIndividualSize) {
            continue;
        }

        $safeName =
            md5(time().$videoName.$i)
            .$extension;

        $tempPath =
            $uploadDir."temp_".$safeName;

        $finalPath =
            $uploadDir.$safeName;

        $thumbnailPath =
            $thumbDir."thumb_".pathinfo($safeName,PATHINFO_FILENAME).".jpg";

        if (move_uploaded_file(
            $_FILES["video"]["tmp_name"][$i],
            $tempPath
        )) {

            // Compress if >10MB
            if (filesize($tempPath) > 10485760) {

                $compressed =
                    compressVideoSmart(
                        $tempPath,
                        $finalPath,
                        $ffmpegPath
                    );

                if (!$compressed) {
                    rename($tempPath,$finalPath);
                }

            } else {

                rename($tempPath,$finalPath);
            }

            // Duration
            $duration =
                getVideoDuration(
                    $finalPath,
                    $ffprobePath
                );

            $formattedDuration =
                formatDuration($duration);

            // Thumbnail
            generateVideoThumbnail(
                $finalPath,
                $thumbnailPath,
                '00:00:01',
                $ffmpegPath
            );

            $thumbnailName =
                basename($thumbnailPath);

            // Save DB
            $sql =
            "INSERT INTO video_gallery
            VALUES (null,?,?,?,?,?,now())";

            $stmt =
            mysqli_prepare($con,$sql);

            mysqli_stmt_bind_param(
                $stmt,
                "sssss",
                $videoTitle,
                $safeName,
                $videoCaption,
                $formattedDuration,
                $thumbnailName
            );

            if (mysqli_stmt_execute($stmt)) {

                $uploadedCount++;
            }
        }
    }

    if ($uploadedCount > 0) {

        echo "<script>
        alert('$uploadedCount Video(s) Uploaded Successfully');
        window.location='gallery.php?p=videos';
        </script>";

    } else {

        echo "<script>
        alert('Upload failed. Check FFmpeg.');
        </script>";
    }
}
}

include("assets/topheader.php");
?>
<title>Admin | Add <?php echo ucfirst($galleryType); ?> Gallery</title>
</head>

<body class="nav-md">
	<?php

	$page_title = 'Add ' . ucfirst($galleryType) . ' Gallery';
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

							<form role="form" name="addgallery" action="" enctype="multipart/form-data" method="post" onSubmit="return valid();">

								<?php if ($isPhotos): ?>
								<div class="form-group">
									<label for="eventTitle">
										Event
									</label>
									<input type="text" name="eventTitle" id="eventTitle" class="form-control" placeholder="Optional">
								</div>
								<div class="form-group">
									<label for="foto">
										Select Photos
									</label>
									<input type="file" name="foto[]" class="form-control" accept="image/*" multiple>
									<small class="text-muted">Allowed: jpg, jpeg, png, gif | Max 5MB per file | Total max 100MB</small>
								</div>
								<?php elseif ($isVideos): ?>
								<div class="form-group">
									<label for="videoTitle">
										Event
									</label>
									<input type="text" name="videoTitle" id="videoTitle" class="form-control" placeholder="Enter video title">
								</div>
								<div class="form-group">
									<label for="videoCaption">
										Video Caption (Optional)
									</label>
									<input type="text" name="videoCaption" id="videoCaption" class="form-control" placeholder="Enter video caption">
								</div>
								<div class="form-group">
									<label for="video">
										Select Videos
									</label>
									<input type="file" name="video[]" class="form-control" accept="video/*" multiple>
									<small class="text-muted">Allowed: mp4, mov, avi, mkv, webm, wmv, flv, m4v | Max 500MB per file | Total max 100MB</small>
								</div>
								<?php endif; ?>

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