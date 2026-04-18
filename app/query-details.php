<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

check_login();


if (isset($_POST['message_reply'])) {
	// echo 'You are right first';
	$replyemail = $_POST['replyemail'];
	$replysubject = $_POST['replysubject'];
	$replymessage = $_POST['replymessage'];
	// exit;
	$replyname = strtok($_POST['fullname'], ' ');

	// echo $replyname;
	// exit;
	
	
	require '../vendor/autoload.php';
	$mail = new PHPMailer(true);

	try {
		$mail->SMTPDebug = 0;
		$mail->isSMTP();
		$mail->Host       = 'mail.lionsdistrict404a2.com';
		$mail->SMTPAuth   = true;
		$mail->Username   = 'info@lionsdistrict404a2.com';
		$mail->Password   = 'lionsD404a2@';
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
		$mail->Port       = 465;

		$mail->setFrom('info@lionsdistrict404a2.com', 'Lions District 404A2');
		$mail->addAddress($replyemail);

		$mail->isHTML(true);
		$mail->Subject = $replysubject;
		$mail->Body    = '<html>
		<body>
		<table style="border-collapse:collapse;max-width:300px; ">
		<tbody>
			<tr>
				<td class="pt-3"><b>Hello, '.$replyname.'</b><br>
					<br>
					<p>' . $replymessage . '</p> <br><br/>
	
	
					<p><a href="https://lionsdistrict404a2.com/events" style="color: #000; text-decoration:none; background-color: #ffb600; padding: 10px;">Explore our Various Activities</a></p> <br>
				   
					Kind Regards,<br>
					<strong>Lions District 404A2</strong>
				</td>
			</tr>
		</tbody>
	</table>
		</body>
		</html>';
		
		$mail->send();
		header ("location:  ");
		$_SESSION['msg'] = "Reply Sent !!";
		
	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
	
		// echo "<script>alert('Message Sent');</script>";

}
//updating Admin Remark
if (isset($_POST['update'])) {
	$qid = intval($_GET['id']);
	mysqli_query($con, "UPDATE tblcontactus set IsRead = 1, readDate = now() where id = '$qid'");
	header("location: read-query?id=$qid&action=markread");
	$_SESSION['msg'] = "Message Read !!";
	// if($query){
	// 	echo "<script>alert('Admin Remark updated successfully.');</script>";
	// 	echo "<script>window.location.href ='read-query.php'</script>";
	// }
}
include("assets/topheader.php");
?>

<title>Admin | Query Details</title>
</head>


<body class="nav-md new-overflow">
	<?php
	$page_title = 'Admin | Query Details';
	$x_content = true;
	?>
	<?php include('include/header.php'); ?>
	<div class="row">
		<div class="col-md-12">
			<h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Query Details</span></h5>
			<table class="table table-hover" id="sample-table-1">

				<tbody>
					<?php
					$qid = intval($_GET['id']);
					$sql = mysqli_query($con, "select * from tblcontactus where id='$qid'");
					$cnt = 1;
					while ($row = mysqli_fetch_array($sql)) {
					?>

						<tr>
							<th>Full Name</th>
							<td><?php echo $row['fullname']; ?></td>
						</tr>

						<tr>
							<th>Email Id</th>
							<td><?php echo $row['email']; ?></td>
						</tr>
						<tr>
							<th>Subject</th>
							<td><?php echo $row['messageSubject']; ?></td>
						</tr>
						<tr>
							<th>Message</th>
							<td><?php echo $row['message']; ?></td>
						</tr>

						<tr>
							<th>Time Received</th>
							<td><?php echo $row['contactDate']; ?></td>
						</tr>
						<?php if ($row['Isread'] == 0) { ?>
							<form name="query" method="post">
								<tr>
									<td>&nbsp;</td>
									<td>
										<!-- <a href="read-query?id=<?php echo $row['id'] ?>&action=markread" onClick="return confirm('Mark this Message as read?')" class="btn btn-primary btn-sm tooltips" tooltip-placement="top" tooltip="Mark as read">Mark read <i class="fa fa-eye fa fa-white"></i></a>	 -->

										<a data-toggle="modal"
											data-target="#exampleModalCenter" class="btn btn-primary pull-left text-white" name="reply" tooltip-placement="top" tooltip="Reply">
											<i class="fa fa-reply"></i> Reply
										</a>

									</td>
								</tr>

							</form>
					<?php }
					} ?>

				</tbody>
			</table>
		</div>
	</div>
	<?php include('include/footer.php');
	include('assets/app-footer.php');


	$sql = mysqli_query($con, "select * from tblcontactus where id='$qid'");
	$nrow = mysqli_fetch_array($sql);
	?>
	<!-- REPLY MESSAGE -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
		aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title text-primary" id="exampleModalLongTitle">Reply to <?php echo $nrow['messageSubject']; ?></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>


				<form name="reply_message" id="reply_message" method="post" action="" enctype="multipart/form-data">
					<div class="modal-body">

						<div class="col-md-12">
							<div class="form-group m-b-20">
								<label for="email">Email</label>
								<input type="email" class="form-control" name="replyemail" id="replyemail" value="<?php echo $nrow['email']; ?>" readonly>
							</div>
							<div class="form-group m-b-20">
								<input type="hidden" class="form-control" name="fullname" id="fullname" value="<?php echo $nrow['fullname']; ?>">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group m-b-20">
								<label for="subject">Subject</label>
								<input type="text" class="form-control" name="replysubject" id="replysubject" value="Re: <?php echo $nrow['messageSubject']; ?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="message">
								Message
							</label>
							<textarea type="text" name="replymessage" placeholder="Describe detailed profile" class="summernote"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" name="message_reply" class="btn btn-primary">Send</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</body>

</html>