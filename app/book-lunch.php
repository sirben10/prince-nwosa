<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if(isset($_GET['del']))
{
	mysqli_query($con,"delete from tblinternationalleaders where leadersID = '".$_GET['id']."'");
	$_SESSION['msg']="data deleted !!";
}
include("assets/topheader.php");
?>
<style>
	.scrollable{
		height: 620px !important;
		overflow-y: scroll !important;
	}
</style>
	<title>Admin | Lunch Events</title>
</head>
<body class="nav-md">
	<?php
	$page_title = 'Admin | Lunch Events';
	$x_content = true;
	?>
	<?php include('include/header.php');
		$sql=mysqli_query($con,"select * from book_lunching");
		// $rows=mysqli_fetch_array($sql);
		?>
	<div class="row scrollable">
		<a  href="add-lunch-event" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Add lunch evet"><i class="fa fa-plus"></i></a>
		<div class="col-md-12">
			
			<div class="tile_count justify-content-center">
				<div class="row">
					<?php
				
				
					while ($row = mysqli_fetch_array($sql)) {?>
						<div class="col-lg-4 col-md-12 col-sm-12 p-5 justify-content-center">
								<div class="m-auto text-center">
									<img class="img-guard img-fluid mb-3" src="lunchingFiles/<?php echo $row['flyerDesign'];?>" alt="">
									<a href="add-lunch-event?id=<?php echo $row['lunchID']; ?>" class="btn btn-primary btn-xs" tooltip-placement="top" tooltip="Edit book"><i class="fa fa-pencil"></i></a>
									<h3><b><?php echo ucwords($row['bookTitle']);?></b></h3>
									<!-- <h5><b>Researcher, Speaker, Motivator, Scholar & Writer</b></h5> -->
									<div class="book-desc">
									<p><?php echo substr(strip_tags(stripcslashes($row['bookDesc'])), 0, 200); ?>...</p>
									<p><span>Lunch Date:</span><?php echo $row['luncDate'];?></p>
								</div>
							</div>
						</div>
				</div>		
			</div>
					<?php } ?>
	</div>
</div>
<?php include('include/footer.php');
	include('assets/app-footer.php');
?>

</body>