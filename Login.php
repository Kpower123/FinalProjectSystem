<?php 
session_start();


include('db_Connection.php');?>


<?php 

	$Home = "";
	$Products = "";
	$styles = "";
	$about = "";
	$page = "";
	$contact = "";


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>

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

if(isset($_SESSION['notLoginMsg'])){
	
?>	
	
	<script> swal("<?php echo $_SESSION['notLoginMsg'];?>", "Press Ok", "warning");</script>
	
<?php	
	
	unset($_SESSION['notLoginMsg']);
	
}


if(isset($_SESSION['LoginMsg'])){
	
?>	
	
	<script> swal("<?php echo $_SESSION['LoginMsg'];?>", "Press Ok", "error");</script>
	
<?php	
	
	unset($_SESSION['LoginMsg']);
	
}




if(isset($_POST['btnCreateAccount'])){

?>
    <script> 
  		location.replace("CreateAccount.php")	
	</script>
       
<?php
	
	
	
}


// sing in operation

if(isset($_POST['btnSingin'])){
	
	$username = $_POST['txtUsername'];
	$password = $_POST['txtPassword'];
	$status = "active";
	
	$sql ="SELECT * FROM users where e_mail = '".$username."' and password = '".$password."' and status = '".$status."' ";
	$result =mysqli_query($con,$sql);
	
	if($row= mysqli_fetch_row($result)){
		
	
		 
		 if($row[5]=='Customer'){
			 
			$UserArray = array('email'=>$row[0],'uname'=>$row[1],'password'=>$row[2],'contact'=>$row[3],
			 'address'=>$row[4],'profile_img'=>$row[6]); 
		
		 	$_SESSION['user_details'][0] =$UserArray;
			 
			 $_SESSION['LoginMsg'] = "You Have Login Successfully ! ";
		 
		 	?>
         		<script> 
  					location.replace("index.php")
				</script>
                      
         	<?php 
		 	}
		 	else{
			
				$_SESSION['LoginMsg'] = "Admin Has Login Successfully ! ";
			
			  
			?>	 
			<script>
			
				location.replace("AdminPanle/admin_index.php")
				
			</script>   
			<?php 
		}
			
			
	}
	else{
		
		$_SESSION['LoginMsg'] = "Login Failed! ";
		
		
	}
	
	
}





if(isset($_SESSION['SingUpMsg'])){
	
?>	
	
	<script> swal("<?php echo $_SESSION['SingUpMsg'];?>", "Press Ok", "success");</script>
	
<?php	
	
	unset($_SESSION['SingUpMsg']);
	
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
        	<h1 class="mt-4 mb-2">Login</h1>
        </div>
    </div>

	<div class="row" style="border:solid #FFF 3px; background:url(img/login%20background.jpg); border-radius:50px;margin:0px 75px 0px 75px">
    
    	<div class="col-lg-4 mt-3 m-auto pt-3" align="center">
        	<h1 style="font-family:'Times New Roman', Times, serif; font-weight:700; text-align:center;position:relative">
            New to Our Shop?</h1>
            <p>There are advances being made in science and technology everyday, and a good example of this is the</p>
            
             <div class="mt-4" align="center">
            
            	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            	<button type="submit" class="btn btn-outline-light" name="btnCreateAccount" style="height:45px;width:170px;">
                Create An Account</button> 
                </form>
                 
            </div>
            <div class="mt-5" style="border-bottom:solid #903 4px;"></div> 
            
            
        </div>
    
		<div class="col-lg-4 col-md-8 col-sm-12 m-auto">
        	
            <h3 class="mt-5" style="font-family:'Times New Roman', Times, serif; font-weight:600; 
            text-align:center;position:relative">Welcome Back ! Please Sign in now</h3>
            <div class="feild">
            	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
				<input type="email" class="lg_input" name="txtUsername" required="required" placeholder="Your Email"  maxlength="40"/>
								
			</div>   
            
            <div class="feild mb-5">
            	
				<input type="password" class="lg_input"  name="txtPassword" required="required" placeholder="Your Password" />					
			</div>
            
            <div class="feild mb-5" align="center">
            
            	<button type="submit" class="btn btn-danger" name="btnSingin" style="height:45px;width:100px;font-weight:500">Sign In</button> 
                 </form>
            </div> 
            
                            
          </div> 
 
      
	</div>
   
</div>


<!-- Footer Section Begin -->
<?php include('Footer.php');?>
<!-- Footer Section End -->


<script src="js/jquery-3.3.1.min.js"></script> 
<script src="js/main.js"></script>
</body>
</html>