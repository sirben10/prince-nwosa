<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if(isset($_GET['del']))
{
	$articleID = $_GET['id'];

	// SELECT PHOTOS FROM article Photos
	$select_previous_file = "SELECT * FROM article_photos WHERE articleID = $articleID";
	$previous_file_query = mysqli_query($con, $select_previous_file);

// Select the privie photo
	$select_previous_foto= "SELECT previewPhoto FROM articles WHERE articleID = $articleID";
	$previous_foto_query = mysqli_query($con, $select_previous_foto);
	$previous_foto_result = mysqli_fetch_array($previous_foto_query);

	$path = $_SERVER['DOCUMENT_ROOT']."/app/articlePhotos/".$previous_foto_result['previewPhoto'];
	// var_dump($previous_file_result); exit;
	while ($previous_file_result = mysqli_fetch_array($previous_file_query)) {
		unlink($_SERVER['DOCUMENT_ROOT']."/app/articlePhotos/".$previous_file_result['photoName']);
		// echo $path; exit;
	}
	// exit;
	$del_article_photos = "DELETE from article_photos where articleID = $articleID";
	// echo $del_article_photos; exit;
	$del_article_photos_query = mysqli_query($con,$del_article_photos);

	$del_articles = "DELETE from articles where articleID = $articleID";
	$del_articles_query = mysqli_query($con,$del_articles);
	if ($del_articles_query) {
		// echo 'success'; exit;
		
		if ($del_article_photos_query) {
			echo "<script>alert('Deleted Seccessfully');</script>";
			unlink($path);
		}
	}
}
include("assets/topheader.php");
?>

	<title>Admin | Articles</title>

</head>
<body class="nav-md">
	<?php
	$page_title = 'Admin | Manage Atricles';
	$x_content = true;
	?>
	<?php include('include/header.php');?>
	<style>
	   
	    .tbloverflow{
  overflow-y: scroll !important; 
  height: 50em !important;
  overflow-x: hidden !important;
}
.tbloverflow::-webkit-scrollbar {
  display: none !important;
}


	</style>
	<div class="row">
		<div class="col-md-12 tbloverflow">
			<h5 class="over-title margin-bottom-15 d-inline">Articles</h5> 
			<a href="add-article" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Add Event"><i class="fa fa-plus"></i></a>
			<table class="table table-hover" id="sample-table-1">
				<thead>
					<tr>
						<th class="center">#</th>
						<th>Title</th>
						<th >Description</th>
						<th>Preview Photo </th>
						<th>Date </th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql=mysqli_query($con,"SELECT * from articles ORDER BY articleID DESC");
					$cnt=1;
					while($row=mysqli_fetch_array($sql))
					{
						?>
						<tr>
							<td class="center"><?php echo $cnt;?>.</td>
							<td><?php echo $row['articleTitle'];?></td>
							<td><?php echo $row['articleDesc'];?></td>
							<td class="user-profile img-fluid"><a href="articlePhotos/<?php echo $row['previewPhoto'];?>"><img src="articlePhotos/<?php echo $row['previewPhoto'];?>" alt=""></a></td>
							<td><?php echo date('d-m-Y', strtotime($row['dateUpdated']));?></td>
						
						</td>
						<td >
							<div class="visible-md visible-lg">
								<!-- <a href="add-article?id=<?php echo $row['articleID'];?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i></a> -->
								<a href="?id=<?php echo $row['articleID']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-trash fa fa-white"></i></a>
							</div>
						</td>
					</tr>
					<?php
					$cnt=$cnt+1;
				}?>
			</tbody>
		</table>
	</div>
</div>
<?php include('include/footer.php');
	include('assets/app-footer.php');
?>

</body>