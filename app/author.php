<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

include("assets/topheader.php");
?>
<style>
	.scrollable{
		height: 620px !important;
		overflow-y: scroll !important;
	}
</style>
	<title>Admin | Author</title>
</head>
<body class="nav-md">
	<?php
	$page_title = 'Admin | Manage Author';
	$x_content = true;
	?>
	<?php include('include/header.php');
		$sql=mysqli_query($con,"select * from book_author");
		$row=mysqli_fetch_array($sql);
		?>
	<div class="row scrollable">
		<div class="col-md-12">
			<?php if(empty($row)){	?><a href="add-author" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Add Leader"><i class="fa fa-plus"></i></a> <?php } ?>
			
					<?php
				
					if(!empty($row)){	?>
						 <div class="tile_count">
						<div class="row">
						<div class="m-auto text-center">
						<img class="img-guard img-fluid" src="authorPhoto/<?php echo $row['authorPhoto'];?>" alt="">
						<a href="add-author?id=<?php echo $row['authorID']; ?>" class="btn btn-primary btn-xs" tooltip-placement="top" tooltip="Edit Author"><i class="fa fa-pencil"></i></a> 
						
						<h3><b><?php echo ucwords($row['academicTitle'].' '. $row['authorName']);?></b></h3>
						<h5><b>Researcher, Speaker, Motivator, Scholar & Writer</b></h5>
						<div class="dash-profile">
						<?php echo $row['authorBio'];?>
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