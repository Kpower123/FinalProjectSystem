<?php 
session_start();


include('db_Connection.php');?>


<?php 

$Home = "";
$Products = "";
$men = "";
$shop = "";
$page = "";
$blog = "";
$contact = "";


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Account</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>



<link rel="stylesheet" href="css/style.css">

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>




</head>

<body>

<?php



if(!isset($_SESSION['user_details'])){	
 
 
 $_SESSION['notLoginMsg']="You Have to Login First";
	  ?>
      	<script>
  			location.replace("Login.php")	
      </script>
      <?php
 
 
}




foreach($_SESSION['user_details'] as $key => $value){

$sql ="SELECT * FROM users where e_mail = '".$value['email']."'";

$result =mysqli_query($con,$sql);

	while($row= mysqli_fetch_row($result)){
		
		$mail = $row[0];
		$OldName = $row[1];
		$OldPass = $row[2];
		$OldContact = $row[3];
		$OldAddress = $row[4];
		
	}



$msg="";


// save details 

if(isset($_POST['btnSave'])){
	
		
		$name = $_POST['txtName'];
		$contact = $_POST['txtContact'];
		$address = $_POST['txtAddress'];
		
		if(strlen($contact)< 10 ){
		?>	
			<script> swal("Please Set Proper Contact Number", "Press Ok", "warning");</script>
    
		<?php 
		}
	
		else if($address == ''){
		?>	
			<script> swal("Please Set an Address", "Press Ok", "warning");</script>
            
        <?php 
		}
		else{
			
			if(!empty($_FILES['profileImage']['name'])){
			
				$temp_image = $_FILES['profileImage']['tmp_name'];
				$imageName  = $_FILES['profileImage']['name'];
			
				$ext = explode(".",$imageName);
				$extType = array("jpg","png","gif","jpeg");
			
				if(in_array($ext[1],$extType)){
				
					$image_base64 = base64_encode(file_get_contents($temp_image));
					$image = "data:image/;base64,".$image_base64;
				
					$sql = "UPDATE `users` SET `u_name`='".$name."',`contact`='".$contact."',`address`='".$address."',`profile_img`='".                    $image."' where e_mail = '".$value['email']."'";
						
					if(mysqli_query($con,$sql)){
					?>	
						<script> swal("Saved Changes!", "Press Ok", "success");</script>
           			<?php    
					}
					else{
					?>
						<script> swal("<?php echo "Error : ". mysqli_error($con)."";?>", "Press Ok", "warning");</script>      
                    <?php	
					}
	
				}
			
			}
			else{
	
				if( $OldName != $name || $OldContact != $contact || $OldAddress != $address){
					
					$sql = "UPDATE `users` SET `u_name`='".$name."',`contact`='".$contact."',`address`='".$address."' 
							where e_mail = '".$value['email']."'";
					
					if(mysqli_query($con,$sql)){
					?>	
						<script> swal("Saved Changes!", "Press Ok", "success");</script>
           			<?php    
					}
					else{
					?>
						<script> swal("<?php echo "Error : ". mysqli_error($con)."";?>", "Press Ok", "warning");</script>      
                    <?php	
					}
					
				}
			
			}
					
		}
	
	}
	
	
	// password change 
	if(isset($_POST['btnChange'])){
		
		$getOldPass   = $_POST['txtOldPass'];
		$getNewPass   = $_POST['txtNewPass'];
		$getReNewPass = $_POST['txtReNewPass'];
		
		if($OldPass == $getOldPass){
			
			if($OldPass != $getNewPass){
				
				if($getNewPass == $getReNewPass){
					
					$Sql = "UPDATE `users` SET `password`='".$getNewPass."' where e_mail = '".$value['email']."' ";
					
					
					if(mysqli_query($con,$Sql)){
					?>
                    	
                        <script> swal("Password Changed Successfully!", "Press Ok", "success");</script>
                    
                    <?php
					}
					
				}
				else{
				?>
                
                	<script> swal("Re-New Password was Incorrect!", "Try Again!", "");</script>
					
				<?php
				}
				
			}
			else{
			?>	
            
				<script> swal("This Password Already Exist!", "Try with Another One!", "");</script>
                
            <?php	
			}
		}
		else{
		?>	
      
			<script> swal("Old Password does not Match!", "", "");</script>
                
        <?php		
		}
	
	}

}





?>

<!-- Page Preloder -->
<div id="preloder">
        <div class="loader"></div>
</div>



<div style="padding-bottom:100px">
<?php include('Nav_Bar.php');?>
</div>

<div class="container mb-5 mt-3 pb-5"  style="border-bottom:solid 1px #CCC">

<?php

	$sql ="SELECT * FROM users where e_mail = '".$mail."'";
	$result =mysqli_query($con,$sql);
	while($row= mysqli_fetch_row($result)){

?>
	<div class="row" style="border-bottom:solid #333 10px; background-color:#f5f5f5; border-radius:0px 0px 50px 50px;margin:0px 75px 0px 75px; -webkit-box-shadow: 0px 5px 8px #333333;">
    
		<div class="col-lg-4 col-md-8 col-sm-12 m-auto">
        
        	<div class="text-center mt-5">
        		<h4 style="font-family:'Helvetica"><?php echo $row[0];?></h4>
        	</div>
            
            <div align="center" class="mt-4">
            	<img src="<?php echo $row[6];?>" style="border:solid #FFF 5px; border-radius:50%;
                -webkit-box-shadow: 0px 5px 10px rgba(91, 91, 91, 0.1); box-shadow: 0px 5px 10px #333333;" 
                class="img-fluid" height="150" width="150"/>
            </div>
        
        	<div class="form">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
            	<label class=" flb">change profile</label>
				<input type="file" name="profileImage" class="file_uploadBox"/>					
			</div>
        	
            <div class="form">
            	<label class=" flb">name</label>
				<input type="text" class="sg_input" name="txtName" required="required" placeholder="Your Name" 
                value="<?php echo $row[1];?>"  maxlength="30"/>					
			</div>   
            
            <div class="form">
            	<label class=" flb">contact</label>
				<input type="text" class="sg_input"  name="txtContact" required="required" placeholder="Your Number" 
                value="<?php echo $row[3];?>" maxlength="10" onkeypress="isInputNumber(event)"/>					
			</div> 
            
            <div class="form">
            	<label class=" flb">address</label>
				<textarea type="text" class="addressBox" name="txtAddress"  placeholder="Your Address"><?php echo $row[4];?></textarea>				
			</div> 
              
            <div class=" mb-5" align="center">
              <button type="submit" class="btn btn-info mt-5" name="btnSave" style="height:45px;width:100px;"> Save</button>
              </form>
              <button data-toggle="modal" data-target="#changePassword" class="btn btn-danger mt-5"
              style="height:45px;">Change Password</button>         
            </div>          
                        
        </div> 
<?php 

	}
		
?> 
	</div>
   
</div>



<div class="modal fade" tabindex="-1" id="changePassword">
  <div class="modal-dialog">
    <div class="modal-content" style="background-color:#FCF; border-top-left-radius:30px; border-bottom-right-radius:30px;">
      <div class="modal-header">
        <h5 class="modal-title">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      	<div class="container">
      
      		<div class="row m-auto pl-4 pr-4">
            
            	<div class="col-lg-10 m-auto">
                 
                 <div class="form mt-3">
            	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
				<input type="password" class="datep" name="txtOldPass" required="required" placeholder="Old Password" maxlength="20"/>
								
			</div>   
                 <div class="form mt-5">
            	
				<input type="password" class="datep" name="txtNewPass" required="required" placeholder="New Password" maxlength="20"/>
								
			</div> 
            
             <div class="form mt-5">
            	
				<input type="password" class="datep" name="txtReNewPass" required="required" placeholder="Re-New Password" maxlength="20"/>
								
			</div> 
             <div class="mt-5 mb-5" align="center">
                <button type="submit" class="btn btn-success" name="btnChange" style="height:45px;width:100px;">Change</button>
                </form>
             </div> 
             
                </div>
            
            </div>
      
      	</div>
    
      </div>
      
    </div>
  </div>
</div> 

<!-- Footer Section Begin -->
<?php include('Footer.php');?>
<!-- Footer Section End -->
   


<script src="js/jquery-3.3.1.min.js"></script> 
<script src="js/main.js"></script>
<script>
 function isInputNumber(evt){
                
                var ch = String.fromCharCode(evt.which);
                
                if(!(/[0-9]/.test(ch))){
                    evt.preventDefault();
                }
                
            }

</script>
</body>
</html>