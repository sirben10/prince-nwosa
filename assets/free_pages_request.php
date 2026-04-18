<?php

  include_once('../app/include/config.php');
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  use PHPMailer\PHPMailer\SMTP;

  if (isset($_POST['request_pages'])) {
      
	$name = htmlspecialchars(strip_tags(stripslashes($_POST['name'])));
	$from = htmlspecialchars(strip_tags(stripslashes($_POST['email'])));
	$book_title = htmlspecialchars(strip_tags(stripslashes($_POST['book_title'])));
	$random_string = bin2hex(random_bytes(16));
 
	$newbooksql = "SELECT *  FROM books Where bookTitle = '$book_title'";
// 	echo $newbooksql; exit;
	$newbookquery = mysqli_query($con, $newbooksql);
	if ($result = mysqli_fetch_array($newbookquery)) {
	  $bookID = $result['bookID'];
	  $dateUpdated =  $result['dateUpdated'];
	  date_default_timezone_set("Africa/Lagos");
	$expire = date('Y-m-d H:i', time() + 1800);
// 	  echo $expire; exit;
	  $link_sql = "INSERT into filelink values(null,$bookID, '$random_string','$expire')";
	  $link_result = mysqli_query($con, $link_sql);
	  if ($link_result) {
		$filelink= "https://".$_SERVER['HTTP_HOST']."/book_download?id=" . $random_string;
// 		"https://princenwosa.com/book_download?id=" . $random_string;
// 		echo $filelink.' ANDD '.$from; exit;
	  }
	}
// 	echo $filelink; exit;
  
	require '../vendor/autoload.php';
	$mail = new PHPMailer(true);
  
	try {
	  $mail->SMTPDebug = 0;
	  $mail->isSMTP();                                            //Send using SMTP
	  $mail->Host       = 'mail.princenwosa.com';                     //Set the SMTP server to send through
	  $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	  $mail->Username   = 'author@princenwosa.com';                     //SMTP username
	  $mail->Password   = 'Prince.nwosa1';                               //SMTP password
	  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
	  $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

	  //Recipients
	  $mail->setFrom($from, $name);
	  $mail->addAddress('author@princenwosa.com');
  
  
	  //Content
	  $mail->isHTML(true);                                  //Set email format to HTML
	  $mail->Subject = 'Free Book Page Request';
	  $mail->Body    = '<html><body>
					  <table style="width: 100%;">
						  <thead style="text-align: center;"><tr><td style="border:none;" colspan="2"> 
						  </td></tr></thead>
						  <tbody>
							  <tr><b> Free Bok Pages Request </b></tr><<br>
								  <tr><td style="border:none;"><strong>Name:</strong> ' . $name . '</td> 
				  </tr><br>
								  <tr><td style="border:none;"><strong>Email:</strong> ' . $from . '</td></tr>
							  <tr><td style="border:none;"><strong>Book Title</strong> ' . $book_title . '</td></tr>
						  </tbody>
					  </table>
					  </html> </body>
  
						  '; 
	} catch (Exception $e) {
	  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
  
  
	$copymail = new PHPMailer(true);
  
	try {
	  //Server settings
	  $copymail->SMTPDebug = 0;
	  $copymail->isSMTP();
	  $copymail->Host       = 'mail.princenwosa.com';
	  $copymail->SMTPAuth   = true;
	  $copymail->Username   = 'author@princenwosa.com';                     //SMTP username
	  $copymail->Password   = 'Prince.nwosa1';
	  $copymail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
	  $copymail->Port       = 465;
	  $copymail->setFrom('author@princenwosa.com', 'Dr Price N. Nwosa');
	  $copymail->addAddress($from);
	  $copymail->isHTML(true);                                  //Set ecopymail format to HTML
	  $copymail->Subject = 'Free Book Pages Request Received';
	  $copymail->Body    = '<html>
  <body style="justify-content: center; text-align: center; border: 1px solid rgb(95, 93, 93); max-width:400px; margin:auto; padding: 30px">
 		 <img class="img-fluid" src="assets/img/logo/favicon.png" >
  		<br><h2>Dear ' . $name . '</h2><br>
 
				 <h4>Your Free Book Pages Request was Received for <br>
				  <p><b>' . strtoupper($book_title) . '</b></h4>
					  <br>
					   <p>Here is your download Link </p><br/>
	  
					  <hr style="border:0;border-bottom:1px solid #e9e9e9"><br>
	  
					  <p><a href="' . $filelink . '" style="color: #fff; text-decoration:none; background-color: #ff3500; padding: 10px;">Download free Pages</a></p> <br>
					 
					  <br>
					  <strong>Note: Link Expires in 30 minutes</strong>
		
  </body>
  </html>'; 
//   echo $_SERVER['HTTP_REFERER']; exit;
 
//   echo $filelink; exit;
	} catch (Exception $e) {
	  echo "Message could not be sent. Mailer Error: {$copymail->ErrorInfo}";
	}
  
  
	echo "<script>alert('Request Sent Successfully');
	window.location.replace('".$_SERVER['HTTP_REFERER']."')
  </script>"; 
   
//   window.open('/articles')</script>";
	$mail->send();
	$copymail->send();
  }
//   header("Location: {$_SERVER['HTTP_REFERER']}");