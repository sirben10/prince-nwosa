<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if(isset($_POST['submit']))
{
	$oldpassword = md5($_POST['cpass']);
	// echo $oldpassword; exit;
	$newpassword = strip_tags($_POST['npass']);
	$sql= "SELECT loginpwd FROM  admin where loginpwd='".$oldpassword."' && loginname='".$_SESSION['login']."'";
	// echo $sql; exit;
	$query = mysqli_query($con, $sql);
	$num=mysqli_fetch_array($query);
	if($num>0)
	{
		$insert = "UPDATE admin set loginpwd='".md5($newpassword)."', dateUpdated= now() where loginname='".$_SESSION['login']."'";
		$con=mysqli_query($con,$insert);
		header("location: change-password");
		$_SESSION['msg1']="Password Changed Successfully !!";
	}
	else
	{
		$_SESSION['msg1']="Old Password not match !!";
	}
}
include("assets/topheader.php");

?>
<title>Admin | Change Password</title>
</head>

	<script type="text/javascript">
		function valid()
		{
			if(document.chngpwd.cpass.value=="")
			{
				alert("Current Password Filed is Empty !!");
				document.chngpwd.cpass.focus();
				return false;
			}
			else if(document.chngpwd.npass.value=="")
			{
				alert("New Password Filed is Empty !!");
				document.chngpwd.npass.focus();
				return false;
			}
			else if(document.chngpwd.cfpass.value=="")
			{
				alert("Confirm Password Filed is Empty !!");
				document.chngpwd.cfpass.focus();
				return false;
			}
			else if(document.chngpwd.npass.value!= document.chngpwd.cfpass.value)
			{
				alert("Password and Confirm Password Field do not match  !!");
				document.chngpwd.cfpass.focus();
				return false;
			}
			return true;
		}
	</script>
<body class="nav-md">
	<?php
	$page_title = 'Admin | Change Password';
	$x_content = true;
	?>
	<?php include('include/header.php');?>
	<div class="row">
		<div class="col-md-12">
			<div class="row margin-top-30">
				<div class="col-lg-8 col-md-12">
					<div class="panel panel-white">
						<div class="panel-heading">
							<h5 class="panel-title">Change Password</h5>
						</div>
						<div class="panel-body">
							<p style="color:green;"><?php echo htmlentities($_SESSION['msg1']);?>
							<?php echo htmlentities($_SESSION['msg1']="");?></p>
							<form role="form" name="chngpwd" method="post" onSubmit="return valid();">
								<div class="form-group">
									<label for="currentPWD">
										Current Password
									</label>
									<input type="password" name="cpass" class="form-control"  placeholder="Enter Current Password">
								</div>
								<div class="form-group">
									<label for="newPWD">
										New Password
									</label>
									<input type="password" name="npass" class="form-control"  placeholder="New Password">
								</div>
								<div class="form-group">
									<label for="newPWD">
										Confirm Password
									</label>
									<input type="password" name="cfpass" class="form-control"  placeholder="Confirm Password">
								</div>
								<button type="submit" name="submit" class="btn btn-o btn-primary">
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