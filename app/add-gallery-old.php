<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

// ============================================
// VIDEO PROCESSING CONFIGURATION
// ============================================

// Try to find FFmpeg - check common locations
$ffmpegPaths = array(
    'C:\\ffmpeg\\bin\\ffmpeg.exe',
    'C:\\xampp\\ffmpeg\\bin\\ffmpeg.exe',
    'C:\\Program Files\\ffmpeg\\bin\\ffmpeg.exe',
    'C:\\Program Files (x86)\\ffmpeg\\bin\\ffmpeg.exe',
    '/usr/bin/ffmpeg',
    '/usr/local/bin/ffmpeg'
);

$ffprobePaths = array(
    'C:\\ffmpeg\\bin\\ffprobe.exe',
    'C:\\xampp\\ffmpeg\\bin\\ffprobe.exe',
    'C:\\Program Files\\ffmpeg\\bin\\ffprobe.exe',
    'C:\\Program Files (x86)\\ffmpeg\\bin\\ffprobe.exe',
    '/usr/bin/ffprobe',
    '/usr/local/bin/ffprobe'
);

$ffmpegPath = '';
$ffprobePath = '';

// Find FFmpeg
foreach ($ffmpegPaths as $path) {
    if (file_exists($path)) {
        $ffmpegPath = $path;
        break;
    }
}

foreach ($ffprobePaths as $path) {
    if (file_exists($path)) {
        $ffprobePath = $path;
        break;
    }
}

// If not found, try to get from system PATH
if (empty($ffmpegPath)) {
    $ffmpegPath = 'ffmpeg';
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

/**
 * Smart video compression - reduces file size by up to 75% while maintaining quality
 */
// function compressVideoSmart($inputPath, $outputPath, $ffmpegPath = 'ffmpeg', $quality = 'medium') {
//     // Aggressive compression presets for 75% size reduction
//     $presets = array(
//         'high' => array('crf' => 26, 'preset' => 'veryfast', 'videoBitrate' => '800k', 'audioBitrate' => '96k'),
//         'medium' => array('crf' => 28, 'preset' => 'veryfast', 'videoBitrate' => '500k', 'audioBitrate' => '96k'),
//         'low' => array('crf' => 32, 'preset' => 'superfast', 'videoBitrate' => '300k', 'audioBitrate' => '64k')
//     );
    
//     $preset = isset($presets[$quality]) ? $presets[$quality] : $presets['medium'];
    
//     // Get original video info
//     $originalSize = filesize($inputPath);
    
//     // Only compress if file is larger than 5MB (smaller threshold for more aggressive compression)
//     if ($originalSize < 5242880) {
//         return false; // Don't compress small files
//     }
    
//     // Build FFmpeg command for aggressive compression
//     // Using: higher CRF + faster preset + bitrate limiting + efficient encoding
//     $command = "$ffmpegPath -i \"" . escapeshellarg($inputPath) . "\" " .
//                "-c:v libx264 -preset " . $preset['preset'] . " -crf " . $preset['crf'] . " " .
//                "-maxrate " . $preset['videoBitrate'] . " -bufsize 2000k " .
//                "-c:a aac -b:a " . $preset['audioBitrate'] . " -movflags +faststart " .
//                "-vf \"scale=min(iw\\,1280):min(ih\\,720):force_original_aspect_ratio=decrease\" " .
//                "-y \"" . escapeshellarg($outputPath) . "\" 2>&1";
    
//     $output = array();
//     $returnVar = 0;
//     @exec($command, $output, $returnVar);
    
//     // Check if compressed file is valid
//     if (file_exists($outputPath) && filesize($outputPath) > 0) {
//         $compressedSize = filesize($outputPath);
        
//         // Only use compressed version if it's smaller
//         if ($compressedSize < $originalSize) {
//             return true;
//         } else {
//             // Compression didn't help, use original
//             @unlink($outputPath);
//             return false;
//         }
//     }
    
//     return false;
// }

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
		$videoTitle = strip_tags($_POST['videoTitle']);
		$videoCaption = strip_tags($_POST['videoCaption']);
		$videos = isset($_FILES["video"]["name"]) ? $_FILES["video"]["name"] : array();
		$videos = is_array($videos) ? $videos : array($videos);
		$videosize = isset($_FILES["video"]["size"]) ? $_FILES["video"]["size"] : array();
		$videosize = is_array($videosize) ? $videosize : array($videosize);

		$loggedin = $_SESSION['login'];
		if (isset($_POST['submit'])) {
			
			// Check total upload size (100MB = 104857600 bytes)
			$totalSize = array_sum($videosize);
			if ($totalSize > 104857600) {
				echo "<script>alert('OOP! Maximum total upload size of 100MB exceeded. Current total: " . round($totalSize / 1048576, 2) . "MB');</script>";
			} else {
				$countFiles = count(array_filter($videos));
				$uploadedCount = 0;
				
				for ($i = 0; $i < $countFiles; $i++) {
					if (empty($videos[$i])) continue;
					
					$arrayVideos = preg_replace('/[^\w\.\-]/', '_', $videos[$i]);
					
					$find = '.';
					$pos = strrpos($arrayVideos, $find);
					if ($pos === false) continue;
					
					$extension = strtolower(substr($arrayVideos, $pos));
					// Allowed video extensions
					$allowed_extensions = array(".mp4", ".mov", ".avi", ".mkv", ".webm", ".wmv", ".flv", ".m4v");
					
					// Max individual video size (50MB for high quality videos)
					$maxIndividualSize = 52428800;
					
					if ($videosize[$i] > $maxIndividualSize) {
						echo "<script>alert('File " . ($i+1) . " exceeds maximum individual size of 50MB');</script>";
					} elseif (!in_array($extension, $allowed_extensions)) {
						echo "<script>alert('Invalid video format. Only mp4, mov, avi, mkv, webm, wmv, flv, m4v allowed');</script>";
					} else {
						// Generate unique filename
						$newVideo = strtolower(md5(time() . $arrayVideos . $i) . $extension);
						
						// Temporary upload path
						$uploadDir = "video-gallery/";
						$thumbDir = "video-gallery/thumbnails/";
						
						if (!is_dir($uploadDir)) {
							mkdir($uploadDir, 0755, true);
						}
						if (!is_dir($thumbDir)) {
							mkdir($thumbDir, 0755, true);
						}
						
						$tempPath = $uploadDir . 'temp_' . $newVideo;
						$targetPath = $uploadDir . $newVideo;
						$thumbnailPath = $thumbDir . 'thumb_' . str_replace($extension, '.jpg', $newVideo);
						
						// Move uploaded file to temp location
						if (move_uploaded_file($_FILES["video"]["tmp_name"][$i], $tempPath)) {
							
							// Smart compression (only for files > 5MB) - targets 75% size reduction
							$useCompression = false;
							$originalSize = filesize($tempPath);
							
							if ($originalSize > 5242880) { // > 5MB
								$useCompression = compressVideoSmart($tempPath, $targetPath, $ffmpegPath, 'medium');
							}
							
							// If compression didn't help or wasn't needed, use original
							if (!$useCompression) {
								if ($tempPath !== $targetPath) {
									rename($tempPath, $targetPath);
								}
							}
							
							// Extract video duration
							$videoDuration = getVideoDuration($targetPath, $ffprobePath);
							$formattedDuration = formatDuration($videoDuration);
							
							// Generate thumbnail
							$thumbnailGenerated = generateVideoThumbnail($targetPath, $thumbnailPath, '00:00:01', $ffmpegPath);
							$thumbnailName = $thumbnailGenerated ? basename($thumbnailPath) : '';
							
							// Get final file size for database
							$finalSize = filesize($targetPath);
							
							// Insert into database with thumbnail and duration
							$video_insert_sql = "INSERT into video_gallery values(null,?,?,?,?,?, now())";
							$stmt = mysqli_prepare($con, $video_insert_sql);
							mysqli_stmt_bind_param($stmt, "sssss", $videoTitle, $newVideo, $videoCaption, $formattedDuration, $thumbnailName);
							$video_result = mysqli_stmt_execute($stmt);
							
							if ($video_result) {
								$uploadedCount++;
							}
						}
					}
				}
				
				if ($uploadedCount > 0) {
					echo "<script>alert('$uploadedCount Video(s) Added Successfully');</script>";
					echo "<script>window.location.href ='gallery.php?p=videos'</script>";
				}
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