<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$lunchID = $_GET['id'];


$bookTitle = strip_tags($_POST['bookTitle']);
$bookDesc = str_replace(array( '\'', '', "'", "-", "_", ".",
    ';','*' ), '', strip_tags($_POST['bookDesc']));
$luncDate = strip_tags($_POST['luncDate']);
$lunchVenue = strtolower(strip_tags($_POST['lunchVenue']));
$bookCover =  strtolower($_FILES["bookCover"]["name"]);
$flyerDesign =  strtolower($_FILES["flyerDesign"]["name"]);
$loggedin = $_SESSION['login'];
if (isset($_POST['submit'])) {
	$find = '.';
     
	// echo $authorID; exit;
    // bookCover
	$pos = strrpos($bookCover, $find) + 1;
	// get the image extension
	$extension = '.' . substr($bookCover, $pos);
	// allowed extensions
	$allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");

    // flyerDesign
	$poss = strrpos($flyerDesign, $find) + 1;
	// get the image extension
	$extension1 = '.' . substr($flyerDesign, $poss);

	
	if (!empty($bookCover) && !in_array($extension, $allowed_extensions)) {
		// $error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
		echo "<script>alert('Invalid format for Author Photo. Only jpg / jpeg/ png /gif format allowed');</script>";
	}else if(!empty($flyerDesign) && !in_array($extension1, $allowed_extensions)){
		echo "<script>alert('Invalid format for Author Photo. Only PDF format allowed');
		history.back(); </script>";
	}
	else {
		
		//rename the image file
		$newbookCover = strtolower(md5($bookCover).$extension);
		$newflyerDesign = strtolower(md5($flyerDesign).$extension1);
		// echo $newbookCover; exit;
		// echo $newflyerDesign.'  '.$actualsize; exit;

		$lunch_insert_sql = "INSERT into book_lunching values(null,'$bookTitle','$bookDesc','$luncDate',
		 '$lunchVenue','$newbookCover', '$newflyerDesign', now())";
		// echo ($lunch_insert_sql);
		// exit;
		$lunch_result = mysqli_query($con, $lunch_insert_sql);
		if ($lunch_result) {
			move_uploaded_file($_FILES["bookCover"]["tmp_name"], "lunchingFiles/" . $newbookCover);
			move_uploaded_file($_FILES["flyerDesign"]["tmp_name"], "lunchingFiles/" . $newflyerDesign);
			echo "<script>alert('Lunch Event Added Successfully');</script>";
			echo "<script>window.location.href ='book-lunch'</script>";
		}
	}
}
if (isset($_POST['update'])) {
	// echo $lsy_theme; exit;
	$allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
	if(!empty($bookCover)) {
	// bookCover
	$pos = strrpos($bookCover, $find) + 1;
	// get the image extension
	$extension = '.' . substr($bookCover, $pos);
	// allowed extensions
	if (!in_array($extension, $allowed_extensions)) {
		// $error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
		echo "<script>alert('Invalid format for Author Photo. Only jpg / jpeg/ png /gif format allowed');</script>";
	}else{
			//rename the image file
			$newbookCover = strtolower(md5($bookCover).$extension);
			// echo $newbookCover; exit;
	}
	}

	if(!empty($flyerDesign)) {
	// flyerDesign
	$poss = strrpos($flyerDesign, $find) + 1;
	// get the image extension
	$extension1 = '.' . substr($flyerDesign, $poss);
	// allowed extensions
	if(!in_array($extension1, $allowed_extensions)){
		echo "<script>alert('Invalid format for Author Photo. Only PDF format allowed');
		history.back(); </script>";
	}
	
	$newflyerDesign = strtolower(md5($flyerDesign).$extension1);

	
	}

		$sql = "UPDATE book_lunching  SET bookTitle = '$bookTitle', bookDesc = '$bookDesc', luncDate = '$luncDate', 
		lunchVenue = '$lunchVenue',  dateUpdated = now()";
		// echo ($sql);
		// exit;
		if(!empty($bookCover)) {
			$sql .= ", bookCover = '$newbookCover'";
		}
		if(!empty($flyerDesign)) {
			$sql .= ", flyerDesign = '$newflyerDesign'";
		}
		$sql .= " WHERE lunchID = $lunchID";
		// echo $sql; exit;
		$result = mysqli_query($con, $sql);
		if ($result) {
			if(!empty($bookCover)) {
			move_uploaded_file($_FILES["bookCover"]["tmp_name"], "lunchingFiles/" . $newbookCover);
			}
			if(!empty($flyerDesign)) {
			move_uploaded_file($_FILES["flyerDesign"]["tmp_name"], "lunchingFiles/" . $newflyerDesign);
			}
			echo "<script>alert('Lunch Event Updated Successfully');</script>";
			echo "<script>window.location.href ='book-lunch'</script>";
		}
	}
	
include("assets/topheader.php");
?>
<title>Admin | Add Lunch Event</title>
</head>

<body class="nav-md">
	<?php

	$page_title = 'Add Lunch Event ';
	$x_content = true;
	?>
	<?php include('include/header.php'); 

	// For Editing
	if(!empty($lunchID)) {
	$boo_sql=mysqli_query($con,"select * from book_lunching where lunchID = $lunchID");
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
										Book Title
									</label>
									<input type="text" name="bookTitle" id="bookTitle" class="form-control" <?php if(!empty($lunchID) || $lunchID)
									{?>value ="<?php echo $row['bookTitle']; ?>"<?php } else{?> placeholder="Enter Book Title"<?php } ?> required="true"
									 >
								</div>

								<div class="form-group">
									<label for="bookDesc">
										Brief Description
									</label>
									
									 <textarea type="text" name="bookDesc" placeholder="Max 100 charracters" maxlength="100" class="summernote"  <?php if(!empty($lunchID) || $lunchID)
									{?>value ="<?php echo $row['bookDesc']; ?>"<?php } ?>
									></textarea>
								</div>
								<div class="col-md-4 form-group">
									<label for="luncDate">
									Lunch Date
									</label>
									<input  type="date" name="luncDate" id="luncDate" class="form-control"<?php if(!empty($lunchID) || $lunchID)
									{?>value ="<?php echo $row['luncDate']; ?>"<?php } else{?>
										<?php } ?>>
								</div>
								
								<div class="col-md-8 form-group">
									<label for="lunchVenue">
									Venue
									</label>
									<input name="lunchVenue" id="lunchVenue" class="form-control"<?php if(!empty($lunchID) || $lunchID)
									{?>value ="<?php echo $row['lunchVenue']; ?>"<?php } else{?>
										placeholder="" <?php } ?>>
								</div>
								
								<div class="col-md-6 form-group">
									<label for="bookCover">
										Select Cover
									</label>
									<input type="file" name="bookCover" class="form-control" accept="image/*" <?php if(empty($lunchID) || !$lunchID)
									{?>required="true"<?php } ?>> <?php if(!empty($lunchID) || $lunchID)
									{?><div class="d-inline user-profile img-fluid"><img  src="bookCover/<?php echo $row['bookCover'];?>" alt=""></div><?php } ?>
								</div>

								<div class=" col-md-6 form-group">
									<label for="flyerDesign">
										Flyer Design
									</label>
									<input type="file" name="flyerDesign" class="form-control" accept="pdf" <?php if(empty($lunchID) || !$lunchID)
									{?>required="true"<?php } ?>> <?php if(!empty($lunchID) || $lunchID)
									{?><div class="d-inline user-profile img-fluid"><img src="flyerDesign/pdf.png" alt=""></div><?php } ?>
								</div>


								<button type="submit"  <?php if(!empty($lunchID) || $lunchID)
								{?> name="update" id="update" <?php } else {?> name="submit" id="submit" <?php } ?> class="btn btn-o btn-primary">
								<?php if(!empty($lunchID) || $lunchID)
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