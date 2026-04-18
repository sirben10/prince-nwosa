<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$reviewID = $_GET['id'];


$bookID = strtolower(strip_tags($_POST['bookID']));
$reviewText = str_replace(array( '\'', '', "'", "-", "_", ".",
';','*' ), '', strip_tags($_POST['reviewText']));
$reviewedBy = strtolower(strip_tags($_POST['reviewedBy']));
$otherDetails = strtolower(strip_tags($_POST['otherDetails']));
	// echo $reviewedBy; exit;
$loggedin = $_SESSION['login'];
if (isset($_POST['submit'])) {
	

		$review_insert_sql = "INSERT into book_review values(null, '$bookID', '$reviewedBy', '$otherDetails','$reviewText',
		  now())";
		// echo ($review_insert_sql);
		// exit;
		$review_result = mysqli_query($con, $review_insert_sql);
		if($review_result)
			echo "<script>alert('Review Submitted');</script>";
			echo "<script>window.location.href ='book-reviews'</script>";
	}	
include("assets/topheader.php");
?>
<title>Admin | Add Review</title>
</head>

<body class="nav-md">
	<?php

	$page_title = 'Add Review ';
	$x_content = true;
	?>
	<?php include('include/header.php'); 

	$book_sql=mysqli_query($con,"select * from books ");
	
	
	?>

	<div class="row">
		<div class="col-md-12">

			<div class="row margin-top-30">
				<div class="col-lg-6 col-md-12 ">
					<div class="panel panel-white">
						<div class="panel-body">

							<form role="form" name="addauthor" action="" enctype="multipart/form-data" method="post" onSubmit="return valid(); enc">

								<div class="form-group">
									<label for="bookID">
										Select Book
									</label>
									<select name="bookID" id="bookID" class="form-control">
										<!-- <option value="" selected aria-disabled="true" >Select Book</option> -->
										<?php while ($row=mysqli_fetch_array($book_sql)) {?>
										<option value="<?php echo  $row['bookID'] ?>"><?php echo  $row['bookTitle'] ?></option>	
										<?php }
										?>
									</select>
									
								</div>

								<div class="form-group">
									<label for="reviewedBy">
										Reviewed By
									</label>
									<input type="text" name="reviewedBy" id="reviewedBy" class="form-control"  placeholder="Reviewed By"  required="true"
									 >
								</div>

								<div class="form-group">
									<label for="otherDetails">
										Other Details
									</label>
									<input type="text" name="otherDetails" id="otherDetails" class="form-control"  placeholder="Optional" 
									 >
								</div>

								<div class="form-group">
									<label for="reviewText">
										Review Description
									</label>
									
									 <textarea type="text" name="reviewText" placeholder="Max 100 charracters"  class="summernote"
									></textarea>
								</div>

								<button type="submit"  name="submit" id="submit" class="mt-3 btn btn-o btn-primary">
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