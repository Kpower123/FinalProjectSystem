
<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer/PHPMailer.php';
require 'PHPMailer/PHPMailer/SMTP.php';
$mail = new PHPMailer(true);




// checkout 
if(isset($_POST['btnCheckOut'])){
	
	$customer="";
	
	$Subject = "Online Order";
	
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
	foreach($_SESSION['user_details'] as $key => $value){
		
    $mail->addAddress($value['email']);     // Add a recipient
	
		$customer = $value['uname'];
	
	}
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
                <h5>Hi '.$customer.',</h5>
                
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
                <h6>Your Order Has Placed!</h6>
                
                <h4 style="margin-top:20px;">Order Corde: '.$_SESSION['O_ID'].'</h4>
                
                </td>
            
            
            </tr>
            
            
            <tr align="center">
            	<td colspan="3">
                <div style="height:100px; width:400px; background-color:#900;">
                
                	<h1 style="padding-top:29px; color:#FFF; font-weight:700">Total : Rs.'.$_SESSION['total'].'.0</h1>
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







// booking style 
if(isset($_POST['btnBookNowStyle'])){
	
	
		
	$MSG="";
	
	$customer="";
	
	$Subject = "Online Reservation";
	
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
	foreach($_SESSION['user_details'] as $key => $value){
		
    $mail->addAddress($value['email']);     // Add a recipient
	
		$customer = $value['uname'];
	
	}
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
                <h5>Hi '.$customer.',</h5>
                
                </td>
                <td></td>
                <td align="right">
                	<p style="font-size:10px;font-weight:700">
                    Contact Us : 0766221738<br/>
                    Website : www.saloncutecuts.lk<br/>
                    Location : No 25, Lake Road Boralasgamuwa
                    </p>
                    
                
                
                </td>
            	
            </tr>
            
            <tr align="center">
            	<td colspan="3">
                <h6>Your Booking Has Placed!</h6>
                <h6>Date : '.$_POST['txtDate'].'</h6>
                <h6>Time : '.$_POST['cmbTime'].'</h6>
                <h4>Booking Corde : '.$_SESSION['B_ID'].'</h4>
                
                </td>
            
            
            </tr>
            
            
            <tr align="center">
            	<td colspan="3">
                <div style="height:100px; width:400px; background-color:#900;">
                
                	<h1 style="padding-top:30px; color:#FFF; font-weight:700">Total : Rs.'.$_POST['stylePrice'].'.0</h1>
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







// booking services 

if(isset($_POST['btnbookConfirm'])){
	
	
		
	$MSG="";
	
	$customer="";
	
	$Subject = "Online Reservation";
	
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
	foreach($_SESSION['user_details'] as $key => $value){
		
    $mail->addAddress($value['email']);     // Add a recipient
	
		$customer = $value['uname'];
	
	}
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
                <h5>Hi '.$customer.',</h5>
                
                </td>
                <td></td>
                <td align="right">
                	<p style="font-size:10px;font-weight:700">
                    Contact Us : 0766221738<br/>
                    Website : www.saloncutecuts.lk<br/>
                    Location : No 25, Lake Road Boralasgamuwa
                    </p>
                    
                
                
                </td>
            	
            </tr>
            
            <tr align="center">
            	<td colspan="3">
                <h6>Your Booking Has Placed!</h6>
                <h6>Date : '.$_POST['txtDate'].'</h6>
                <h6>Time : '.$_POST['cmbTime'].'</h6>
                <h4>Booking Corde : '.$_SESSION['B_ID'].'</h4>
                
                </td>
            
            
            </tr>
            
            
            <tr align="center">
            	<td colspan="3">
                <div style="height:100px; width:400px; background-color:#900;">
                
                	<h1 style="padding-top:30px; color:#FFF; font-weight:700">Total : Rs.'.$_SESSION['service_total'].'.0</h1>
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