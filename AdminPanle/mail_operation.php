
<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer/PHPMailer.php';
require 'PHPMailer/PHPMailer/SMTP.php';
$mail = new PHPMailer(true);



// booking confirm Email

if(isset($_POST['btnBConfirm'])){
	
	
	
	$Subject = "Online Reservation Confirmed";
	
	$msg ="";
	

	
	
try {
    //Server settings
    $mail->SMTPDebug =0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'cutecutssaloon@gmail.com';                     // SMTP username
    $mail->Password   = 'cuteJK2407';                               // SMTP password
   // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('cutecutssaloon@gmail.com', 'Salon Cute Cuts');
	
		
    $mail->addAddress($_POST['txtb_user_id']);     // Add a recipient
	
		
	
	
   // $mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('cutecutssaloon@gmail.com', 'Information');
  //  $mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');

    // Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $Subject;
    $mail->Body    = ' 

					
	<div class="container">

	<div class="row">
    
    
    	<table class="table table-borderless" style="border:double 4px #333; background-color:#ECECEC;color:#333">
        
        	<tr>
            	<td>
                <h5>Dear Customer,</h5>
                
                </td>
                <td></td>
                <td align="right">
                	<p style="font-size:10px;font-weight:700">
                    Contact Us : 0766221738<br />
                    Website : www.saloncutecuts.lk<br/>
                    Location : No 25, Lake Road Boralasgamuwa
                    </p>
                    
                
                
                </td>
            	
            </tr>
            
            <tr align="center">
            	<td colspan="3">
                <h6 style="color:#000">Your Booking Has Confirmed !</h6>
                <h6>Date : '.$_POST['txtb_date'].'</h6>
                <h6>Time : '.$_POST['txtb_time'].'</h6>
                <h4 style="margin-top:20px;">Booking Corde: '.$_POST['txtb_id'].'</h4>
                
                </td>
            
            
            </tr>
            
            
            <tr align="center">
            	<td colspan="3">
                <div style="height:100px; width:400px; background-color:#900;">
                
                	<h1 style="padding-top:29px; color:#FFF; font-weight:700">Total : Rs.'.$_POST['txtb_total'].'.0</h1>
                </div>
                
                <h5 style="margin-top:10px;">Thank You!</h5>
                
                </td>
            	
            </tr>
            <tr align="left">
            	
            	<td colspan="3"><p style="font-size:12px">More Details to Visit www.saloncutecuts.lk</p></td>
            	
            </tr>
		
        </table>
    
    </div>


</div>

	
	
	';
	
    $mail->AltBody = 
    $mail->send();
   	$MSG ='Message has been sent';
}

 catch (Exception $e) {
   $MSG = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}






// booking cancele email


if(isset($_POST['btnReject'])){
	
	
	
	$Subject = "Online Reservation Rejected";
	
	$msg ="";
	

	
	
try {
    //Server settings
    $mail->SMTPDebug =0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'cutecutssaloon@gmail.com';                     // SMTP username
    $mail->Password   = 'cuteJK2407';                               // SMTP password
   // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('cutecutssaloon@gmail.com', 'Salon Cute Cuts');
	
		
    $mail->addAddress($_POST['txtb_user_id']);     // Add a recipient
	
		
	
	
   // $mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('cutecutssaloon@gmail.com', 'Information');
  //  $mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');

    // Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $Subject;
    $mail->Body    = ' 

					
	<div class="container">

	<div class="row">
    
    
    	<table class="table table-borderless" style="border:double 4px #333; background-color:#ECECEC;color:#333">
        
        	<tr>
            	<td>
                <h5>Dear Customer,</h5>
                
                </td>
                <td></td>
                <td align="right">
                	<p style="font-size:10px;font-weight:700">
                    Contact Us : 0766221738<br />
                    Website : www.saloncutecuts.lk<br/>
                    Location : No 25, Lake Road Boralasgamuwa
                    </p>
                    
                
                
                </td>
            	
            </tr>
            
            <tr align="center">
            	<td colspan="3">
                <h6 style="color:#C00">Your Booking Has Rejected !</h6>
                <h6>We regret to inform you that we cannot be of service to you because we are already booked for the whole day of 
				you were booking.</h6>
				<h6>Please Booking Another Day!</h6>
                <h4 style="margin-top:20px;">Booking Corde: '.$_POST['txtb_id'].'</h4>
                
                </td>
            
            
            </tr>
            
            
            <tr align="center">
            	<td colspan="3">
                <h5 style="margin-top:10px;">Thank You!</h5>
                
                </td>
            	
            </tr>
            <tr align="left">
            	
            	<td colspan="3"><p style="font-size:12px">More Details to Visit www.saloncutecuts.lk</p></td>
            	
            </tr>
		
        </table>
    
    </div>


</div>

	
	
	';
	
    $mail->AltBody = 
    $mail->send();
   	$MSG ='Message has been sent';
}

 catch (Exception $e) {
   $MSG = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}








// booking Complete Email


if(isset($_POST['btnBCompleted'])){
	
	
	
	$Subject = "Online Reservation Completed";
	
	$msg ="";
	

	
	
try {
    //Server settings
    $mail->SMTPDebug =0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'cutecutssaloon@gmail.com';                     // SMTP username
    $mail->Password   = 'cuteJK2407';                               // SMTP password
   // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('cutecutssaloon@gmail.com', 'Salon Cute Cuts');
	
		
    $mail->addAddress($_POST['txtb_user_id']);     // Add a recipient
	
		
	
	
   // $mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('cutecutssaloon@gmail.com', 'Information');
  //  $mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');

    // Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $Subject;
    $mail->Body    = ' 

					
	<div class="container">

	<div class="row">
    
    
    	<table class="table table-borderless" style="border:double 4px #333; background-color:#ECECEC;color:#333">
        
        	<tr>
            	<td>
                <h5>Dear Customer,</h5>
                
                </td>
                <td></td>
                <td align="right">
                	<p style="font-size:10px;font-weight:700">
                    Contact Us : 0766221738<br />
                    Website : www.saloncutecuts.lk<br/>
                    Location : No 25, Lake Road Boralasgamuwa
                    </p>
                    
                
                
                </td>
            	
            </tr>
            
            <tr align="center">
            	<td colspan="3">
                <h6 style="color:#000">Your Booking Has Completed !</h6>
                <h6>Thank you for being our valued customer. We are so grateful for the pleasure of serving you and hope we met your 
				expectations.</h6>
				<h6>We hope your experience was awesome and we can’t wait to see you again soon.</h6>
                <h4 style="margin-top:20px;">Booking Corde: '.$_POST['txtb_id'].'</h4>
                </td>
            
            
            </tr>
            
            
            <tr align="center">
            	<td colspan="3">
                <h5 style="margin-top:10px;">Thank You!</h5>
                
                </td>
            	
            </tr>
            <tr align="left">
            	
            	<td colspan="3"><p style="font-size:12px">More Details to Visit www.saloncutecuts.lk</p></td>
            	
            </tr>
		
        </table>
    
    </div>


</div>

	
	
	';
	
    $mail->AltBody = 
    $mail->send();
   	$MSG ='Message has been sent';
}

 catch (Exception $e) {
   $MSG = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}









// order Shipped




if(isset($_POST['btnShipped'])){
	
	
		
	
	$Subject = "Online Order Shipped";
	
	$msg ="";
	

	
	
try {
    //Server settings
    $mail->SMTPDebug =0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'cutecutssaloon@gmail.com';                     // SMTP username
    $mail->Password   = 'cuteJK2407';                               // SMTP password
   // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('cutecutssaloon@gmail.com', 'Salon Cute Cuts');
	
		
    $mail->addAddress($_POST['txto_user_id']);     // Add a recipient
	
		
	
	
   // $mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('cutecutssaloon@gmail.com', 'Information');
  //  $mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');

    // Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $Subject;
    $mail->Body    = ' 

					
	<div class="container">

	<div class="row">
    
    
    	<table class="table table-borderless" style="border:double 4px #333; background-color:#ECECEC;color:#333">
        
        	<tr>
            	<td>
                <h5>Dear Customer,</h5>
                
                </td>
                <td></td>
                <td align="right">
                	<p style="font-size:10px;font-weight:700">
                    Contact Us : 0766221738<br />
                    Website : www.saloncutecuts.lk<br/>
                    Location : No 25, Lake Road Boralasgamuwa
                    </p>
                    
                
                
                </td>
            	
            </tr>
            
            <tr align="center">
            	<td colspan="3">
                <h6 style="color:#000">Your Order Has Shipped !</h6>
                <h6>Ordered Date : '.$_POST['txto_date'].'</h6>
                <h6>Thank you for trusting us! Together with our professional team, we promise to do our very best just to cater every little 
					thing you need.
				</h6>
                <h4 style="margin-top:20px;">Order Corde: '.$_POST['txto_id'].'</h4>
                
                </td>
            
            
            </tr>
            
            
            <tr align="center">
            	<td colspan="3">
                <div style="height:100px; width:400px; background-color:#900;">
                
                	<h1 style="padding-top:29px; color:#FFF; font-weight:700">Total : Rs.'.$_POST['txto_total'].'.0</h1>
                </div>
                
                <h5 style="margin-top:10px;">Thank You!</h5>
                
                </td>
            	
            </tr>
            <tr align="left">
            	
            	<td colspan="3"><p style="font-size:12px">More Details to Visit www.saloncutecuts.lk</p></td>
            	
            </tr>
		
        </table>
    
    </div>


</div>

	
	
	';
	
    $mail->AltBody = 
    $mail->send();
   	$MSG ='Message has been sent';
}

 catch (Exception $e) {
   $MSG = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}




	
	
	
	
	
	
	
	
	


}

?>