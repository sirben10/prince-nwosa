<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$articleID = $_GET['id'];

$articleTitle = strtolower(strip_tags($_POST['articleTitle']));
$articleDesc = str_replace(array( '\'', '', "'", "-", "_", ".",
    ';','*' ), '', strip_tags($_POST['articleDesc']));
$arr = explode(" ", $articleTitle);
$articleURL = implode("-", $arr);
$previewPhoto =  strtolower($_FILES["previewPhoto"]["name"]);
$photos = $_FILES["otherPhotos"]["name"];
$otherPhoto =  str_replace(array("JPG", "PNG"), 'jpg', $photos);
$otherPhotos =  str_replace(array( '\'', '"',  '(',')',
    ';','*',' ' ), '_', $photos );
	
$loggedin = $_SESSION['login'];
if (isset($_POST['submit'])) {
	$find = '.';
     
	
	// var_dump($otherPhoto); exit;
    // previewPhoto
	$pos = strrpos($previewPhoto, $find) + 1;
	// get the image extension
	$extension = '.' . substr($previewPhoto, $pos);
	// allowed extensions
	

	$allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");

    
	
	if (!empty($previewPhoto) && !in_array($extension, $allowed_extensions)) {
		// $error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
		echo "<script>alert('Invalid format for Preview Photo. Only jpg / jpeg/ png /gif format allowed');</script>";
	}
	else {
		
		//rename the image file
		$newpreviewPhoto = strtolower(md5($previewPhoto).$extension);

		// echo $newpreviewPhoto; exit;
		// echo $newotherPhotos.'  '.$actualsize; exit;

		$article_insert_sql = "INSERT into articles values(null,'$articleTitle','$articleDesc',
		 '$articleURL','$newpreviewPhoto', now())";
		// echo ($article_insert_sql);
		// exit;
		$article_result = mysqli_query($con, $article_insert_sql);

			// otherPhotos
		


		if ($article_result) {
			// $countFiles = count($otherPhotos);
		

		$countFiles = count($otherPhotos);
		// echo $countFiles; exit;
		for ($i = 0; $i < $countFiles; $i++) {
			$arrayotherPhotos = $otherPhotos[$i];

		$poss = strrpos($arrayotherPhotos, $find) + 1;
		// get the image extension
		$extension1 = '.' . substr($arrayotherPhotos, $poss);
		if (!in_array($extension1, $allowed_extensions)) {
			// $error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
			echo "<script>alert('Invalid format for other Photo. Only jpg / jpeg/ png /gif format allowed');</script>";
		}

		else if($arrayotherPhotos[$i] > 5000000){
			echo "<script>alert('OOP!. Maximum Array Size of 5mb Exceeded');</script>"; 
		}else{
			$newotherPhotos = strtolower(md5($arrayotherPhotos).$extension1);

			// Select Just inserted Article ID
			$articleID_sql= "select articleID from articles order by articleID desc";
			// echo $articleID_sql; exit;
			$articleID_query = mysqli_query($con,$articleID_sql);
			$articleID_row=mysqli_fetch_array($articleID_query);
			if (!empty($articleID_row)) {
				$articleID = $articleID_row['articleID'];
			}
			$other_photos_insert_sql = "INSERT into article_photos values(null,$articleID,'$newotherPhotos', now())";
			// echo ($other_photos_insert_sql);
			// exit;
			$other_photos_result = mysqli_query($con, $other_photos_insert_sql);
			move_uploaded_file($_FILES["otherPhotos"]["tmp_name"][$i], "articlePhotos/" . $newotherPhotos);
		}
		}
			move_uploaded_file($_FILES["previewPhoto"]["tmp_name"], "articlePhotos/" . $newpreviewPhoto);
			echo "<script>alert('Articles Added Successfully');</script>";
			echo "<script>window.location.href ='articles'</script>";
		}
	}
}
if (isset($_POST['update'])) {
	// echo $lsy_theme; exit;
	if(!empty($previewPhoto)) {
	// previewPhoto
	$pos = strrpos($previewPhoto, $find) + 1;
	// get the image extension
	$extension = '.' . substr($previewPhoto, $pos);
	// allowed extensions
	$allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
	if (!in_array($extension, $allowed_extensions)) {
		// $error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
		echo "<script>alert('Invalid format for Preview Photo. Only jpg / jpeg/ png /gif format allowed');</script>";
	}else{
			//rename the image file
			$newpreviewPhoto = strtolower(md5($previewPhoto).$extension);
			// echo $newpreviewPhoto; exit;
	}
	}

	if(!empty($otherPhotos)) {
	// otherPhotos
	$poss = strrpos($otherPhotos, $find) + 1;
	// get the image extension
	$extension1 = '.' . substr($otherPhotos, $poss);
	if(!in_array($extension1, $allowed_extensions1)){
		echo "<script>alert('Invalid format for Other Photos. Only PDF format allowed');
		history.back(); </script>";
	}
	
	$newotherPhotos = strtolower(md5($otherPhotos).$extension1);

	$sql = "UPDATE articles  SET articleTitle = '$articleTitle', articleDesc = '$articleDesc', articleURL = '$articleURL',
	dateUpdated = now()";
	// echo ($sql);
	// exit;
	if(!empty($previewPhoto)) {
		$sql .= ", previewPhoto = '$newpreviewPhoto'";
	}
	if(!empty($otherPhotos)) {
		$sql .= ", otherPhotos = '$newotherPhotos'";
	}
	$sql .= " WHERE articleID = $articleID";
	// echo $sql; exit;
	$result = mysqli_query($con, $sql);
	if ($result) {
		if(!empty($previewPhoto)) {
		move_uploaded_file($_FILES["previewPhoto"]["tmp_name"], "articlePhotos/" . $newpreviewPhoto);
		}
		if(!empty($otherPhotos)) {
		move_uploaded_file($_FILES["otherPhotos"]["tmp_name"], "articlePhotos/" . $newotherPhotos);
		}
		echo "<script>alert('Articles Updated Successfully');</script>";
		echo "<script>window.location.href ='articles'</script>";
	}
	}
}
	
include("assets/topheader.php");
?>
<title>Admin | Add Article</title>
</head>

<body class="nav-md">
	<?php

	$page_title = 'Add Article ';
	$x_content = true;
	?>
	<?php include('include/header.php'); 

	// For Editing
	if(!empty($articleID)) {
	$boo_sql=mysqli_query($con,"select * from articles where articleID = $articleID");
	$row=mysqli_fetch_array($boo_sql);
	}
	?>

	<div class="row">
		<div class="col-md-12">

			<div class="row margin-top-30">
				<div class="col-lg-6 col-md-12 ">
					<div class="panel panel-white">
						<div class="panel-body">

							<form role="form" name="addauthor" action="" enctype="multipart/form-data" method="post" onSubmit="return valid(); enc">

								<div class="form-group">
									<label for="title">
										Article Title
									</label>
									<input type="text" name="articleTitle" id="articleTitle" class="form-control" <?php if(!empty($articleID) || $articleID)
									{?>value ="<?php echo $row['articleTitle']; ?>"<?php } else{?> placeholder="Enter Title"<?php } ?> required="true"
									 >
								</div>

								<div class="form-group">
									<label for="articleDesc">
										Article Description
									</label>
									
									 <textarea type="text" name="articleDesc" placeholder="Max 100 charracters"  class="summernote"  <?php if(!empty($articleID) || $articleID)
									{?>value ="<?php echo $row['articleDesc']; ?>"<?php } ?>
									></textarea>
								</div>
								
								
								<div class="mt-3 col-md-6 form-group">
									<label for="previewPhoto">
										Select Preview Photo
									</label>
									<input type="file" name="previewPhoto" class="form-control" accept="image/*" <?php if(empty($articleID) || !$articleID)
									{?>required="true"<?php } ?>> <?php if(!empty($articleID) || $articleID)
									{?><div class="d-inline user-profile img-fluid"><img  src="previewPhoto/<?php echo $row['previewPhoto'];?>" alt=""></div><?php } ?>
								</div>

								<div class="mt-3 col-md-6 form-group">
									<label for="otherPhotos">
										Upload Other blog photos (max 3)
									</label>
									<input type="file" name="otherPhotos[]" class="form-control" accept="pdf" <?php if(empty($articleID) || !$articleID)
									{?>required="true"<?php } ?> multiple> <?php if(!empty($articleID) || $articleID)
									{?><div class="d-inline user-profile img-fluid"><img src="otherPhotos/pdf.png" alt=""></div><?php } ?>
								</div>


								<button type="submit"  <?php if(!empty($articleID) || $articleID)
								{?> name="update" id="update" <?php } else {?> name="submit" id="submit" <?php } ?> class="mt-3 btn btn-o btn-primary">
								<?php if(!empty($articleID) || $articleID)
								{?>Update <?php } else {?> Submit <?php } ?>
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