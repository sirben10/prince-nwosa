<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require 'vendor/autoload.php';

if (isset($_POST['submit_form'])) {
	
    $from = htmlspecialchars(strip_tags(stripslashes($_REQUEST['email'])));
    $name = htmlspecialchars(strip_tags(stripslashes($_REQUEST['name'])));
    $subject = htmlspecialchars(strip_tags(stripslashes($_REQUEST['subject'])));
    // $number = $_REQUEST['number'];
    $cmessage = htmlspecialchars(strip_tags(stripslashes($_REQUEST['message'])));
	// echo $from ; exit;

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
    $mail->Subject = 'New Contact Email';
    $mail->Body = '
	<html><body>
					  <table style="width: 100%;">
						  <thead style="text-align: center;"><tr><td style="border:none;" colspan="2"> 
						  </td></tr></thead>
						  <tbody>
							  <tr><b> Contact Email Received from ' . $name . '</b></tr><<br><br>
								  <tr><td style="border:none;"><strong>Message Subject:</strong> ' . $subject . '</td> 
				  </tr><br>
								  <tr><td style="border:none;"><strong>Email:</strong> ' . $from . '</td></tr>
							  <tr><td colspan="2" style="border:none;">'.$cmessage.'</td></tr>
						  </tbody>
					  </table>
					  </html> </body>';

	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
	echo "<script>alert('Mail Sent, Thanks for Contacting me');
window.location.replace('".$_SERVER['HTTP_REFERER']."')
</script>";
$mail->send();
}

?>