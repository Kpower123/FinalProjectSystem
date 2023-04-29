<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Manager</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity=
"sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity=
"sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    
    
    
<link rel="stylesheet" href="style.css">
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>

<?php 


session_start();


include('../db_Connection.php');

include('count.php');




// logout 
if(isset($_POST['btnLogout'])){

	?>
    <script>
    
    	location.replace("../index.php")
    
    </script>
    <?php 

}



// block  user

if(isset($_POST['btnBlock'])){
	
	$email = $_GET['id'];
	
	$status = "block";
	
	$sqlu="UPDATE `users` SET `status`='".$status."' where e_mail = '".$email."'  ";
	
	if(mysqli_query($con,$sqlu)){
	?>	
		<script> swal("User Has Blocked !", "Press Ok", "success");</script>
        
    <?php    
	}


}



// unblock user

if(isset($_POST['btnUnblock'])){
	
	$email = $_GET['id'];
	
	$status = "active";
	
	$sqlu="UPDATE `users` SET `status`='".$status."' where e_mail = '".$email."'  ";
	
	if(mysqli_query($con,$sqlu)){
	?>	
		<script> swal("User Has Unblock !", "Press Ok", "success");</script>
        
    <?php    
	}


}




	$SQL=" select * from users where user_type ='Customer'";
	
	
	
	
	
// serach user	
	
if(isset($_POST['btnUserSearch'])){


	$email = $_POST['txtUserSearch'];


	$SQLL=" select * from users where e_mail='".$email."' and user_type ='Customer' ";

	$result =mysqli_query($con,$SQLL);
		
		if($row= mysqli_fetch_row($result)){
			
			$SQL =$SQLL;

		}
		else{
			
		?>	
			<script> swal("User Not Found !", "Press Ok", "warning");</script>
        
    	<?php 
			
		}
	
}




?>




<!-- Page Preloder -->
<div id="preloder">
        <div class="loader"></div>
</div>
  
  
  <div class="sidebar">
    <header>
   		<img src="admin.png" width="60" height="60" style="border-radius:50%;-webkit-box-shadow: 0px 5px 8px #333333; margin-right:15px;"/>
	   Kanishka Madhawa
    </header>
  <ul>
  	<li><a href="admin_index.php"><i class="fas fa-qrcode"></i>Dashboard</a></li>
    <li><a href="product_manager.php"><i class="fas fa-link"></i>Products</a></li>
   
    <li><a href="order_manager.php"><i class="fas fa-calendar-week"></i>Orders <span style="color:#C00;font-weight:500">
	<?php echo $ordersCount;?></span></a></li>
    <!-- <li><a href="service_manager.php"><i class="fas fa-sliders-h"></i>Services</a></li> -->
    <li><a href="user_manager.php"><i class="fas fa-user-friends"></i>Users</a></li>  
     
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">  
    	<li><a href="#"><button  type="submit" name="btnLogout" style="border:none; background:none; outline:none">
    	<i class="fas fa-sign-out-alt"></i>Log Out</button></a></li>
   	</form>
   
  </ul>
  
</div>


<!-- User manager content -->

<div class="container" style="margin-left:250px; padding-right:50px">

	<div class="row top_slideBar mb-5" align="right" >
    
    	<table class="table table-borderless" style="margin-top:12px;">
        	<tr>
            	<td>
                	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                		<input type="email" name="txtUserSearch" placeholder="Enter User Email" required="required" />
            			<button type="submit" name="btnUserSearch">Search</button>
                    </form>
                </td>
                
                <td align="right">
                
                	<h2>User Manager</h2>
                </td>
              
            
            </tr>
        
        
        
        </table>
    
    </div>
    
    <div class="col-lg-12" style="padding-top:150px">
        	<table class="table table-active" style="background:#f5f5f5;-webkit-box-shadow: 0px 5px 8px #333333;">
            
            	<tr style="background:#C03; color:#FFF; font-weight:500;">
                	
                    <td>Profile</td>
                    <td>Email</td>
                    <td>Name</td>
                    <td>Contact</td>
                    <td>Address</td>
                    <td align="center">Action</td>
                
                
                </tr>
                
                <?php 
				
					$result =mysqli_query($con,$SQL);
		
					while($row= mysqli_fetch_row($result)){
				
				?> 
                
    
                <tr>
                
                <form action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $row[0];?>" method="post">
                	<td>
                    
                    	<img src="<?php echo $row[6];?>" width="100" height="100" style="border-radius:50%;
                        -webkit-box-shadow: 0px 5px 8px #999;"/>
                    	
                    </td>
                    <td><?php echo $row[0];?></td>
                    <td><?php echo $row[1];?></td>
                    <td><?php echo $row[3];?></td>
                    <td><?php echo $row[4];?></td>
                    <td align="center">
                    	<button type="submit" name="btnBlock" class=" btn btn-secondary" <?php if($row[7]=="block"){?> 
                        style="display:none" <?php } ?>>Block</button>
                       	<button type="submit" name="btnUnblock" class=" btn btn-success"<?php if($row[7]=="active"){?> 
                        style="display:none" <?php } ?>>Unblock</button>
                    	
                    </td>
                 </form>
                    
                </tr>
                
                <?php
				
				
					}
				
				
				?>
    
    
   </table> 
    
</div>




<script src="../js/jquery-3.3.1.min.js"></script> 
<script src="../js/main.js"></script>

</body>
</html>