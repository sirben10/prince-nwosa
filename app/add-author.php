<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if(!empty($_GET['id'])){
$authorID = $_GET['id'];
}
$title = strip_tags($_POST['title']);
$authorname = strip_tags($_POST['authorname']);
$fb = strtolower(strip_tags($_POST['fb']));
$ln = strtolower(strip_tags($_POST['ln']));
$tw = strtolower(strip_tags($_POST['tw']));
$others = strtolower(strip_tags($_POST['others']));
$authorbio = str_replace(array( '\'', '"',
    ';','*' ), ' ', $_POST['authorbio']);
$authorphoto =  strtolower($_FILES["authorphoto"]["name"]);
$loggedin = $_SESSION['login'];


if (isset($_POST['submit'])) {
	$find = '.';
     
    // authorphoto
	$pos = strrpos($authorphoto, $find) + 1;
	// get the image extension
	$extension = '.' . substr($authorphoto, $pos);

	// allowed extensions
	$allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
	
	if (!empty($authorphoto) && !in_array($extension, $allowed_extensions)) {
		// $error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
		echo "<script>alert('Invalid format for Author Photo. Only jpg / jpeg/ png /gif format allowed');</script>";
	} else {
		
		//rename the image file
		$newauthorphoto = strtolower(md5($authorphoto).$extension);
		// echo $newauthorphoto; exit;

		$author_insert_sql = "INSERT into book_author values(null,'$title','$authorname','$authorbio','$newauthorphoto','$ln', '$fb','$tw','$others',now())";
		// echo ($author_insert_sql);
		// exit;
		$author_result = mysqli_query($con, $author_insert_sql);
		if ($author_result) {
			move_uploaded_file($_FILES["authorphoto"]["tmp_name"], "authorPhoto/" . $newauthorphoto);
			echo "<script>alert('Author Added Successfully');</script>";
			echo "<script>window.location.href ='author'</script>";
		}
	}
}
if (isset($_POST['update'])) {
	// echo $lsy_theme; exit;
	if(!empty($authorphoto)) {
	// authorphoto
	$pos = strrpos($authorphoto, $find) + 1;
	// get the image extension
	$extension = '.' . substr($authorphoto, $pos);

	// allowed extensions
	$allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");

	if (!in_array($extension, $allowed_extensions)) {
		$error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
		// echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
	
	} else {
		//rename the image file
		$newauthorphoto = md5($authorphoto);
	}
}

		$sql = "UPDATE book_author  SET academicTitle = '$title', authorName = '$authorname', fb = '$fb', ln = '$ln', tw = '$tw', authorBio = '$authorbio', 	dateUpdated = now()";
		
		if(!empty($authorphoto)) {
			$sql .= ", authorPhoto = '$newauthorphoto'";
		}
		$sql .= " WHERE authorID = $authorID";
		// echo $sql; exit;
		$result = mysqli_query($con, $sql);
		if ($result) {
			if(!empty($authorphoto)) {
			move_uploaded_file($_FILES["authorphoto"]["tmp_name"], "authorPhoto/" . $newauthorphoto);
			}
			echo "<script>alert('Author Updated Successfully');</script>";
			echo "<script>window.location.href ='author'</script>";
		}
	}
	
// echo  $authorID; exit;
include("assets/topheader.php");
?>
<title>Admin | Add Author</title>
</head>

<body class="nav-md">
	<?php

	$page_title = 'Add Author ';
	$x_content = true;
	?>
	<?php include('include/header.php'); 

	// For Editing
	if(!empty($authorID)) {
	$autho_sql=mysqli_query($con,"select * from book_author where authorID = $authorID");
	$row=mysqli_fetch_array($autho_sql);
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
										Title
									</label>
									<select name="title" id="title" class="form-control">
										<option value="mr">Mr</option>
										<option value="dr">Dr</option>
										<option value="prof">Prof</option>
									</select>
								</div>

								<div class="form-group">
									<label for="authorname">
										Full Name
									</label>
									<input type="text" name="authorname" id="authorname" class="form-control" <?php if(!empty($authorID) || $authorID)
									{?>value ="<?php echo $row['authorName']; ?>"<?php } else{?> placeholder="Enter Full name"<?php } ?> required="true"
									 >
								</div>
								<div class="row mt-4"><div class="col-12">Social Media Handles</div>
									
									<div class="col-4">
										<div class="form-group">
											<label for="ln">
												LinkedIn
											</label>
											<input name="ln" id="ln" class="form-control"<?php if(!empty($authorID) || $authorID)
											{?>value ="<?php echo $row['ln']; ?>"<?php } else{?>
											 placeholder="" <?php } ?>>
										</div>
									</div>
									<div class="col-4">
										<div class="form-group">
											<label for="fb">
												Facebook
											</label>
											<input name="fb" id="fb" class="form-control"<?php if(!empty($authorID) || $authorID)
											{?>value ="<?php echo $row['fb']; ?>"<?php } else{?>
											 placeholder="" <?php } ?>>
										</div>
									</div>
									<div class="col-4">
										<div class="form-group">
											<label for="tw">
												Twitter
											</label>
											<input name="tw" id="tw" class="form-control"<?php if(!empty($authorID) || $authorID)
											{?>value ="<?php echo $row['tw']; ?>"<?php } else{?>
											 placeholder="" <?php } ?>>
										</div>
									</div>
								</div>



								<div class="form-group">
									<label for="authorbio">
										Detailed Profile
									</label>
									<textarea type="text" name="authorbio" placeholder="Describe detailed profile" class="summernote"  <?php if(!empty($authorID) || $authorID)
									{?>value ="<?php echo $row['authorbio']; ?>"<?php } ?>
									></textarea>
								</div>
								
								<div class="form-group">
									<label for="authorphoto">
										Select Photo
									</label>
									<input type="file" name="authorphoto" class="form-control" <?php if(empty($authorID) || !$authorID)
									{?>required="true"<?php } ?>> <?php if(!empty($authorID) || $authorID)
									{?><div class="d-inline user-profile img-fluid"><img  src="authorPhoto/<?php echo $row['authorPhoto'];?>" alt=""></div><?php } ?>
								</div>


								<button type="submit"  <?php if(!empty($authorID) || $authorID)
								{?> name="update" id="update" <?php } else {?> name="submit" id="submit" <?php } ?> class="btn btn-o btn-primary">
								<?php if(!empty($authorID) || $authorID)
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