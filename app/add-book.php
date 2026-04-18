<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if(!empty($_GET['id'])){
$bookID = $_GET['id'];

$boo_sql= "select * from books where bookID = $bookID";
// echo $boo_sql; exit;
$book_query = mysqli_query($con,$boo_sql);

	$roww=mysqli_fetch_array($book_query);
	if(!empty($roww))
		$articlePhoto = $roww['articlePhoto'];
		$freeBook = $roww['freeBook'];
		// echo $freeBook.' - '.$articlePhoto; exit;
}
$autho_sql=mysqli_query($con,"select * from book_author");
$row=mysqli_fetch_array($autho_sql);
if(!empty($row))
	$authorID = $row['authorID'];

$bookTitle = strip_tags(strtolower($_POST['bookTitle']));
$bookDesc = str_replace(array( '\'', '', "'", "-", "_", ".",
    ';','*' ), '', $_POST['bookDesc']);
$arr = explode(" ", $bookTitle);
$bookURL = implode("-", $arr);
$publishedYear = strip_tags($_POST['publishedYear']);
$coAuthors = strtolower(strip_tags($_POST['coAuthors']));
$pagesNumber = strtolower(strip_tags($_POST['pagesNumber']));
$bookCover =  strtolower($_FILES["bookCover"]["name"]);
$freeBook =  strtolower($_FILES["freeBook"]["name"]);
$fileSize =  strtolower($_FILES["freeBook"]["size"]);
$loggedin = $_SESSION['login'];



if (isset($_POST['submit'])) {
	$find = '.';
     
    // bookCover
	$pos = strrpos($bookCover, $find) + 1;
	// get the image extension
	$extension = '.' . substr($bookCover, $pos);
	// allowed extensions
	$allowed_extensions = array(".jpg", "jpeg", ".jpeg", ".png", ".gif");
	
    // FreeBook
	$poss = strrpos($freeBook, $find) + 1;
	// get the image extension
	$extension1 = '.' . substr($freeBook, $poss);
	// echo $freeBook.'/'.$poss.' '.$extension1; exit;
	// allowed extensions
	$allowed_extensions1 = array(".pdf");

	$unit = 'kb';
	$size_ = round($fileSize / 1000, 1);
	// $size = ceil($size);
	if ($size_ < 1000) {
		$size = $size_;
		$unit = 'kb';
	} else if ($size_ >= 1000) {
		$size = $size_ / 1000;
		$unit = 'mb';
	} else if ($size_ >= 100000) {
		$size = $size_ / 100000;
		$unit = 'gb';
	}
	$actualsize =  $size . ' ' . $unit;
	
	
	if (!empty($bookCover) && !in_array($extension, $allowed_extensions)) {
		// $error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
		echo "<script>alert('Invalid format for Author Photo. Only jpg / jpeg/ png /gif format allowed');</script>";
	}else if(!empty($freeBook) && !in_array($extension1, $allowed_extensions1)){
		echo "<script>alert('Invalid format for Author Photo. Only PDF format allowed');
		history.back(); </script>";
	}else if ($fileSize > 6000000) {
		echo "<script>alert('OOP!. Maximum Size of 6mb Exceeded');
		history.back();</script>";
	}
	else {
		// $random_string = bin2hex(random_bytes(16));
		// $expire = date('Y-m-d H:i:s', strtotime('+60 minutes'));
		$file_path = 'https://'.$_SERVER['HTTP_HOST']."/app/freeBook/";
	

// 		echo $file_path; exit;
		
		//rename the image file
		$newbookCover = strtolower(md5($bookCover).$extension);
		$newfreeBook = strtolower(md5($freeBook).$extension1);
		// echo $bookTitle; exit;
// 		echo $newfreeBook.' AND  '.$newbookCover; exit;

		$book_insert_sql = "INSERT into books values(null,'$bookTitle','$bookDesc','$publishedYear', $authorID,
		 '$coAuthors', '$bookURL', '$newbookCover', '$newfreeBook', '$file_path',
		 $pagesNumber,'$actualsize', now())";
// 		echo ($book_insert_sql);
// 		exit;
		$book_result = mysqli_query($con, $book_insert_sql);
		if ($book_result) {
			$book_select = "SELECT bookID from books order by bookID desc";
			$book_query = mysqli_query($con, $book_select);
			$result = mysqli_fetch_array($book_query);
			if(!empty($result)){
				$bookID = $result['bookID'];
			}
			move_uploaded_file($_FILES["bookCover"]["tmp_name"], "bookCover/" . $newbookCover);
			move_uploaded_file($_FILES["freeBook"]["tmp_name"], "freeBook/" . $newfreeBook);


			echo "<script>alert('Book Added Successfully');</script>";
			echo "<script>window.location.href ='books'</script>";
		}
	}

}
$find = '.';
if (isset($_POST['update'])) {
	// echo $lsy_theme; exit;
	if(!empty($bookCover)) {
	// bookCover
	$pos = strrpos($bookCover, $find) + 1;
	// get the image extension
	$extension = '.' . substr($bookCover, $pos);
	// allowed extensions
	$allowed_extensions = array(".jpg", ".jpeg", "jpeg", ".png", ".gif");
	if (!in_array($extension, $allowed_extensions)) {
		// $error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
		echo "<script>alert('Invalid format for Author Photo. Only jpg / jpeg/ png /gif format allowed');</script>";
	}else{
		//rename the image file
			$newbookCover = strtolower(md5($bookCover).$extension);
			// echo $newbookCover; exit;
		}
	}
	
	if(!empty($freeBook)) {
	// FreeBook
	$poss = strrpos($freeBook, $find) + 1;
	// get the image extension
	$extension1 = '.' . substr($freeBook, $poss);
	// allowed extensions
	$allowed_extensions1 = array(".pdf");
	// echo $freeBook.' - '.$poss.' - '.$extension1; exit;
	if(!in_array($extension1, $allowed_extensions1)){
		echo "<script>alert('Invalid format for Author Photo. Only PDF format allowed');
		history.back(); </script>";
	}
	if ($fileSize > 6000000) {
		echo "<script>alert('OOP!. Maximum Size of 6mb Exceeded');
		history.back();</script>";
	}
	
	$newfreeBook = strtolower(md5($freeBook).$extension1);

	$unit = 'kb';
	$size_ = round($fileSize / 1000, 1);
	// $size = ceil($size);
	if ($size_ < 1000) {
		$size = $size_;
		$unit = 'kb';
	} else if ($size_ >= 1000) {
		$size = $size_ / 1000;
		$unit = 'mb';
	} else if ($size_ >= 100000) {
		$size = $size_ / 100000;
		$unit = 'gb';
	}
	$actualsize =  $size . ' ' . $unit;
	
	}

		$sql = "UPDATE books  SET bookTitle = '$bookTitle', publishedYear = '$publishedYear', 
		coAuthors = '$coAuthors', bookURL = '$bookURL', pagesNumber = '$pagesNumber',
		dateUpdated = now()";
		if(!empty($bookDesc)) {
			$sql .= ", bookDesc = '$bookDesc'";
		}
// 		echo ($sql);
// 		exit;
		if(!empty($bookCover)) {
			$sql .= ", bookCover = '$newbookCover'";
		}
		if(!empty($freeBook)) {
			$sql .= ", freeBook = '$newfreeBook'";
		}
		$sql .= " WHERE bookID = $bookID";
		// echo $sql; exit;
		$result = mysqli_query($con, $sql);
		if ($result) {
			if(!empty($bookCover)) {
			unlink($_SERVER['DOCUMENT_ROOT']."bookCover/".$roww['articlePhoto']);
		
			move_uploaded_file($_FILES["bookCover"]["tmp_name"], "bookCover/" . $newbookCover);
			}
			if(!empty($freeBook)) {
			unlink($_SERVER['DOCUMENT_ROOT']."freeBook/".$roww['freeBook']);
			move_uploaded_file($_FILES["freeBook"]["tmp_name"], "freeBook/" . $newfreeBook);
			}
			echo "<script>alert('Book Updated Successfully');</script>";
			echo "<script>window.location.href ='books'</script>";
		}
	}
	
include("assets/topheader.php");
?>
<title>Admin | Add Book</title>
</head>

<body class="nav-md">
	<?php

	$page_title = 'Add Book ';
	$x_content = true;
	?>
	<?php include('include/header.php'); 

	// For Editing
	if(!empty($bookID)) {
	$boo_sql=mysqli_query($con,"select * from books where bookID = $bookID");
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
									<input type="text" name="bookTitle" id="bookTitle" class="form-control" <?php if(!empty($bookID) || $bookID)
									{?>value ="<?php echo $row['bookTitle']; ?>"<?php } else{?> placeholder="Enter Book Title"<?php } ?> required="true"
									 >
								</div>

								<div class="form-group">
									<label for="bookDesc">
										Book Description
									</label>
									
									 <textarea type="text" name="bookDesc" placeholder="Max 100 charracters" maxlength="100" class="summernote"  <?php if(!empty($bookID) || $bookID)
									{?>value ="<?php echo $row['bookDesc']; ?>"<?php } ?>
									></textarea>
								</div>
								<div class="col-md-4 form-group">
									<label for="publishedYear">
									Published Year
									</label>
									<input name="publishedYear" id="publishedYear" class="form-control"<?php if(!empty($bookID) || $bookID)
									{?>value ="<?php echo $row['publishedYear']; ?>"<?php } else{?>
										placeholder="" <?php } ?>>
								</div>
								
								<div class="col-md-8 form-group">
									<label for="coAuthors">
									co Authors (Optional)
									</label>
									<input name="coAuthors" id="coAuthors" class="form-control"<?php if(!empty($bookID) || $bookID)
									{?>value ="<?php echo $row['coAuthors']; ?>"<?php } else{?>
										placeholder="" <?php } ?>>
								</div>
								
								<div class="col-md-4 form-group">
									<label for="pagesNumber">
									 Number of pages
									</label>
									<input name="pagesNumber" id="pagesNumber" class="form-control"<?php if(!empty($bookID) || $bookID)
									{?>value ="<?php echo $row['pagesNumber']; ?>"<?php } else{?>
										placeholder="" <?php } ?>>
								</div>


								<div class="col-md-4 form-group">
									<label for="bookCover">
										Select Cover
									</label>
									<input type="file" name="bookCover" class="form-control" accept="image/*" <?php if(empty($bookID) || !$bookID)
									{?>required="true"<?php } ?>> <?php if(!empty($bookID) || $bookID)
									{?><div class="d-inline user-profile img-fluid"><img  src="bookCover/<?php echo $row['bookCover'];?>" alt=""></div><?php } ?>
								</div>

								<div class=" col-md-4 form-group">
									<label for="freeBook">
										Upload Free Book
									</label>
									<input type="file" name="freeBook" class="form-control" accept="pdf" <?php if(empty($bookID) || !$bookID)
									{?>required="true"<?php } ?>> <?php if(!empty($bookID) || $bookID)
									{?><div class="d-inline user-profile img-fluid"><img src="freeBook/pdf.png" alt=""></div><?php } ?>
								</div>


								<button type="submit"  <?php if(!empty($bookID) || $bookID)
								{?> name="update" id="update" <?php } else {?> name="submit" id="submit" <?php } ?> class="btn btn-o btn-primary">
								<?php if(!empty($bookID) || $bookID)
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