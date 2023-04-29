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
<title>Create New Account</title>

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


$name        = "";
$contact     = "";
$address     = "";
$username    = "";
$password    = "";
$conPassword = "";
$userType    = "Customer";


// sign up and register operation 
if(isset($_POST['btnSingUp'])){
	
	
	$name        = $_POST['txtName'];
	$contact     = $_POST['txtContact'];
	$address     = $_POST['txtAddress'];	
	$username    = $_POST['txtUsername'];
	$password    = $_POST['txtPassword'];
	$conPassword = $_POST['txtConfirmPassword'];
	$status      = "active";
	
	$sql ="SELECT * FROM users where e_mail = '".$username."'";
	$result =mysqli_query($con,$sql);
	
	if($row= mysqli_fetch_row($result)){
	?> 
    
    	<script> swal("This Email has Already Account!", "Please Try With Aother One", "warning");</script>	
	
    <?php 	
	}
	else if($address == ''){
	?>
    
    	<script> swal("Please Set an Address", "Press Ok", "warning");</script>
		
	<?php 	
	}
	else if($password  != $conPassword){
	?>
    
    	<script> swal("Confirm Password Doesn't Match", "Press Ok", "warning");</script>
		
	<?php 	
	}
	else if(strlen($contact)< 10 ){
	?>	
    
		<script> swal("Please Set Proper Contact Number", "Press Ok", "warning");</script>
    
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
				
					$sql = "INSERT INTO `users`(e_mail, u_name, password, contact, address, user_type, profile_img, status ) VALUES 
							('".$username."', '".$name."', '".$password."', '".$contact."', '".$address."', '".$userType."', 
							'".$image."', '".$status."') ";
						
					if(mysqli_query($con,$sql)){
						
						$name        = '';
						$contact     = '';
						$address     = '';
						$username    = '';
						$password    = '';
						$conPassword = '';
						
						$_SESSION['SingUpMsg'] = "You Have Been Sign Up!";
						
					?>	
                
						<script> 
                        
                        	location.replace("Login.php")
							
                        </script>
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
			?>
            
                <script> swal("Please Choose a Profile Picture", "Press Ok", "warning");</script>
            
            <?php
			
			}
	
	}


	
}


?>


<!-- Page Preloder -->
<div id="preloder">
        <div class="loader"></div>
</div>

<div style="padding-bottom:100px;">
<?php include('Nav_Bar.php');?>
</div>

<div class="container mb-5 pb-5" style="border-bottom:solid 1px #CCC">

	<div class="row" align="center">
    	<div class="col-lg-12 m-auto">
        	<h1 class="mt-4 mb-4">Sign Up</h1>
        </div>
    </div>

	<div class="row pt-5 pb-5" style="border:solid #FFF 3px; background-color:#f5f5f5; border-radius:50px;
    	margin:0px 75px 0px 75px; -webkit-box-shadow: 0px 5px 8px #333333;">
    
    	<div class="col-lg-12 m-auto" align="center">
        
        	<span class="preview feild">
            	<img id="file-ip-1-preview" width="150" height="150"/>
    		</span>
    
    	</div>
    	<div class="col-lg-4 col-md-8 col-sm-12 m-auto" align="center">

    		<div class="felid">
            	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
            	<label class=" flb">choose profile</label>
				<input type="file" name="profileImage" class="file_uploadBox" accept="image/*" onchange="showPreview(event);"/>
								
			</div>
            
            <div class="feild">
            	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
				<input type="text" class="sg_input" name="txtName" required="required" placeholder="Your Name" 
                value="<?php echo $name; ?>"  maxlength="30"/>
								
			</div>
            
            <div class="feild">
            	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
				<input type="text" class="sg_input" name="txtContact" required="required" placeholder="Your Contact" 
                value="<?php echo $contact; ?>"  maxlength="10" onkeypress="isInputNumber(event)" />
								
			</div> 
            
            <div class="feild">
				<textarea type="text" class="addressBox" name="txtAddress"  placeholder="Your Address"><?php echo $address; ?></textarea>				
			</div>       
            
            
        </div>
    
		<div class="col-lg-4 col-md-8 col-sm-12 m-auto">
        	
            <div class="feild">
            	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
				<input type="email" class="sg_input" name="txtUsername" required="required" placeholder="Your Email" 
                value="<?php echo $username; ?>"  maxlength="40"/>
								
			</div>   
            
            <div class="feild">
            	
				<input type="password" class="sg_input"  name="txtPassword" required="required" placeholder="Your Password" 
                value="<?php echo $password; ?>"/>					
			</div>
            
            <div class="feild">
            	
				<input type="password" class="sg_input"  name="txtConfirmPassword" required="required" placeholder="Confirm Your Password" 
                value="<?php echo $conPassword; ?>"/>					
			</div>
            
            <div class="feild mb-5" align="center">
            
            	<button type="submit" class="btn btn-danger" name="btnSingUp" 
                	style="height:45px;width:100px; font-weight:500">Sign Up
               	</button> 
              </form>
            </div>
            
             <div class="mt-4" style="border-bottom:solid #903 4px;"></div> 
            
                            
          </div> 
 
      
	</div>
   
</div>

<!-- Footer Section Begin -->
<?php include('Footer.php');?>
<!-- Footer Section End -->

<script>
function showPreview(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("file-ip-1-preview");
    preview.src = src;
    preview.style.display = "block";
  }
}
</script>

<script>
 function isInputNumber(evt){             
    var ch = String.fromCharCode(evt.which);       
      if(!(/[0-9]/.test(ch))){
         evt.preventDefault();
      }             
 }
</script>


<script src="js/jquery-3.3.1.min.js"></script> 
<script src="js/main.js"></script>
</body>
</html>