<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if (isset($_GET['del'])) {
    $sqll = mysqli_query($con, "select * from books");
    $rows=mysqli_fetch_array($sqll);
	mysqli_query($con, "delete from books where bookID = '" . $_GET['id'] . "'");
	
	$coverpath = $_SERVER['DOCUMENT_ROOT']."/app/bookCover/".$rows['bookCover'];
	$bookpath = $_SERVER['DOCUMENT_ROOT']."/app/freeBook/".$rows['freeBook'];
	unlink($coverpath);
	unlink($bookpath);
	
	$_SESSION['msg'] = "data deleted !!";
}
include("assets/topheader.php");
?>
<style>
	.scrollable {
		height: 620px !important;
		overflow-y: scroll !important;
	}
</style>
<title>Admin | Books</title>
</head>

<body class="nav-md">
	<?php
	$page_title = 'Admin | Manage Books';
	$x_content = true;
	?>
	<?php include('include/header.php');
	$sql = mysqli_query($con, "select * from books");
	// $rows=mysqli_fetch_array($sql);
	?>
	<div class="row scrollable">
		<a href="add-book" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Add book"><i class="fa fa-plus"></i></a>
		<div class="col-md-12">
			<div class="row">
				<?php while ($row = mysqli_fetch_array($sql)) { ?>
					<div class="col-lg-4 col-md-12 col-sm-12  col-xs-12 p-5">
						<div class="tile_count">
							<div class="m-auto text-center">
								<img class="img-guard img-fluid mb-4" src="bookCover/<?php echo $row['bookCover']; ?>" alt="">
								<a href="add-book?id=<?php echo $row['bookID']; ?>" class="btn btn-primary btn-xs" tooltip-placement="top" tooltip="Edit book"><i class="fa fa-pencil"></i></a>
								
								<a href="?id=<?php echo $row['bookID']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"class="btn btn-danger btn-xs tooltips" tooltip-placement="top" tooltip="Remove" title="Remove Book"><i class="fa fa-times"></i></a>
								
								<h3><b><?php echo ucwords($row['bookTitle']); ?></b></h3>
								<!-- <h5><b>Researcher, Speaker, Motivator, Scholar & Writer</b></h5> -->
								<div class="book-desc">
									<?php echo substr(strip_tags(stripcslashes($row['bookDesc'])), 0, 200); ?>...

								</div>
							</div>
						</div>

					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php include('include/footer.php');
	include('assets/app-footer.php');
	?>

</body>