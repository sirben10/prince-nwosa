<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if(isset($_GET['del']))
{
	$reviewID = $_GET['id'];


	$del_review = "DELETE from book_review where reviewID = $reviewID";
	$del_review_query = mysqli_query($con,$del_review);
	if ($del_review_query) {
		// echo 'success'; exit;
		
			echo "<script>alert('Deleted Seccessfully');</script>";
		
	}
}
include("assets/topheader.php");
?>

	<title>Admin | Book Reviews</title>

</head>
<body class="nav-md">
	<?php
	$page_title = 'Admin | Manage Reviews';
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
			<h5 class="over-title margin-bottom-15 d-inline">Book Reviews</h5> 
			<a href="add-review" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Add Event"><i class="fa fa-plus"></i></a>
			<table class="table table-hover" id="sample-table-1">
				<thead>
					<tr>
						<th class="center">#</th>
						<th>Book</th>
						<th >Review Text</th>
						<th>Reviewd By </th>
						<th>Organization </th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql=mysqli_query($con,"SELECT * from book_review r
					JOIN books b ON b.bookID = r.bookID ORDER BY reviewID DESC");
					$cnt=1;
					while($row=mysqli_fetch_array($sql))
					{
						?>
						<tr>
							<td class="center"><?php echo $cnt;?>.</td>
							<td><?php echo $row['bookTitle'];?></td>
							<td><?php echo $row['reviewText'];?></td>
							<td><?php echo $row['reviewedBy'];?></td>
							<td><?php echo $row['organization'];?></td>
						</td>
						<td >
							<div class="visible-md visible-lg">
								<!-- <a href="add-article?id=<?php echo $row['reviewID'];?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i></a> -->
								<a href="?id=<?php echo $row['reviewID']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-trash fa fa-white"></i></a>
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