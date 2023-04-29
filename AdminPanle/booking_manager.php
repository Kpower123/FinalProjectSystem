<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Booking Manager</title>
</head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity=
"sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity=
"sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity=
"sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    
    
    
<link rel="stylesheet" href="style.css">
<script src="https://kit.fontawesome.com/a076d05399.js"></script>  
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



<body>
<?php 

session_start();


include('../db_Connection.php');

include('count.php');





$notConfirm = "active";
$confirm = "";
$completed = "";


unset($_SESSION['booking_detailss']);

$sql = "SELECT * FROM booking where status = 'processing'";


if(isset($_POST['btnnotConfirm'])){
	
	
	$notConfirm = "active";
	$confirm = "";
	$completed = "";
	
	$sql = "SELECT * FROM booking where status = 'processing'";
}


if(isset($_POST['btnConfirm'])){
	
	
	$notConfirm = "";
	$confirm = "active";
	$completed = "";
	
	$sql = "SELECT * FROM booking where status = 'confirmed'";
}




if(isset($_POST['btnCompleted'])){
	
	
	$notConfirm = "";
	$confirm = "";
	$completed = "active";
	
	$sql = "SELECT * FROM booking where status = 'completed'";
}

// view the booking details 

	$result =mysqli_query($con,$sql);
		
	while($row= mysqli_fetch_row($result)){
			 
		if(isset($_SESSION['booking_detailss'])){

			$BookingsArray = array('b_id'=>$row[0],'date'=>$row[1],'time'=>$row[2],'total'=>$row[3],'booking_status'=>$row[4],
			'user_id'=>$row[5]); 
			$count = count($_SESSION['booking_detailss']);
		
		 	$_SESSION['booking_detailss'][$count]=$BookingsArray;
				
		 }
		 else{
			 
			$BookingsArray =  array('b_id'=>$row[0],'date'=>$row[1],'time'=>$row[2],'total'=>$row[3],'booking_status'=>$row[4],
			'user_id'=>$row[5]); 
				
		 	$_SESSION['booking_detailss'][0]=$BookingsArray;
		}
			
	
}



// booking confirm 

if(isset($_POST['btnBConfirm'])){
	
	$status = "confirmed";
	
	
	
	$SQL= "UPDATE `booking` SET `status`='".$status."' where b_id='".$_POST['txtb_id']."' ";
	
	if(mysqli_query($con,$SQL)){
	?>	
		<script> swal("Booking Has confirmed !", "Press Ok", "success");</script>
     <?php 
	 
	 include('mail_operation.php');
	  
	 unset($_SESSION['booking_detailss']); 
	 
	 lodavalues();
	 include('count.php'); 
	}
	else{
	?>
		<script> swal("<?php echo "Error : ". mysqli_error($con)."";?>", "Press Ok", "warning");</script>      
    <?php	
	}
	
	
	
}


// booking completed

if(isset($_POST['btnBCompleted'])){
	
	
	$status = "completed";
	
	
	
	$SQL= "UPDATE `booking` SET `status`='".$status."' where b_id='".$_POST['txtb_id']."' ";
	
	if(mysqli_query($con,$SQL)){
	?>	
		<script> swal("Booking Has completed !", "Press Ok", "success");</script>
     <?php 
	 
	 include('mail_operation.php');
	  
	 unset($_SESSION['booking_detailss']); 
	 
	 lodavalues2(); 
	 include('count.php');
	}
	else{
	?>
		<script> swal("<?php echo "Error : ". mysqli_error($con)."";?>", "Press Ok", "warning");</script>      
    <?php	
	}
	
	
	
	







}






// booking rejected 

if(isset($_POST['btnReject'])){


	$SQL="DELETE FROM `booking` WHERE b_id = '".$_POST['txtb_id']."'";
	
	if(mysqli_query($con,$SQL)){
		
		
		$SqL="DELETE FROM `booking_details` WHERE b_id = '".$_POST['txtb_id']."'";
		
		if(mysqli_query($con,$SqL)){
			
		?>	
       
			<script> swal("Booking Has Rejected !", "Press Ok", "success");</script>
        
   		<?php
		
		include('mail_operation.php');
		
		unset($_SESSION['booking_detailss']); 
	 
	 	lodavalues();
		include('count.php');  
		
		}
	
	
	}


}









// load processing bookings 

function lodavalues(){
	
	include('../db_Connection.php');
	
	$Sql = "SELECT * FROM booking where status = 'processing'";	

	$result =mysqli_query($con,$Sql);
		
	while($row= mysqli_fetch_row($result)){
			 
		if(isset($_SESSION['booking_detailss'])){

			$BookingsArray = array('b_id'=>$row[0],'date'=>$row[1],'time'=>$row[2],'total'=>$row[3],'booking_status'=>$row[4],
			'user_id'=>$row[5]); 
			$count = count($_SESSION['booking_detailss']);
		
		 	$_SESSION['booking_detailss'][$count]=$BookingsArray;
				
		 }
		 else{
			 
			$BookingsArray =  array('b_id'=>$row[0],'date'=>$row[1],'time'=>$row[2],'total'=>$row[3],'booking_status'=>$row[4],'user_id'=>$row
			[5]); 
				
		 	$_SESSION['booking_detailss'][0]=$BookingsArray;
		}
			
	
	}


	

}


// load confirmed bookings 

function lodavalues2(){
	
	include('../db_Connection.php');
	
	
	$Sql = "SELECT * FROM booking where status = 'confirmed'";	

	$result =mysqli_query($con,$Sql);
		
	while($row= mysqli_fetch_row($result)){
			 
		if(isset($_SESSION['booking_detailss'])){

			$BookingsArray = array('b_id'=>$row[0],'date'=>$row[1],'time'=>$row[2],'total'=>$row[3],'booking_status'=>$row[4],
			'user_id'=>$row[5]); 
			$count = count($_SESSION['booking_detailss']);
		
		 	$_SESSION['booking_detailss'][$count]=$BookingsArray;
				
		 }
		 else{
			 
			$BookingsArray =  array('b_id'=>$row[0],'date'=>$row[1],'time'=>$row[2],'total'=>$row[3],'booking_status'=>$row[4],'user_id'=>$row
			[5]); 
				
		 	$_SESSION['booking_detailss'][0]=$BookingsArray;
		}
			
	
	}


	

}


// logout 
if(isset($_POST['btnLogout'])){

	?>
    <script>
    
    	location.replace("../index.php")
    
    </script>
    <?php 

}




// search booking
if(isset($_POST['btnBookingSearch'])){
	
	unset($_SESSION['booking_detailss']); 
	
	$Sql ="SELECT * FROM booking where b_id = '".$_POST['txtBookingSearch']."'";
	
	

	$result =mysqli_query($con,$Sql);
		
	while($row= mysqli_fetch_row($result)){
			 
		if(isset($_SESSION['booking_detailss'])){

			$BookingsArray = array('b_id'=>$row[0],'date'=>$row[1],'time'=>$row[2],'total'=>$row[3],'booking_status'=>$row[4],
			'user_id'=>$row[5]); 
			$count = count($_SESSION['booking_detailss']);
		
		 	$_SESSION['booking_detailss'][$count]=$BookingsArray;
				
		 }
		 else{
			 
			$BookingsArray =  array('b_id'=>$row[0],'date'=>$row[1],'time'=>$row[2],'total'=>$row[3],'booking_status'=>$row[4],'user_id'=>$row
			[5]); 
				
		 	$_SESSION['booking_detailss'][0]=$BookingsArray;
		}
			
	
	}
	
	if(!empty($_SESSION['booking_detailss'])){
			
			
			foreach($_SESSION['booking_detailss'] as $key => $value){
				
				if($value['booking_status']=='processing'){
					
					$notConfirm = "active";
					$confirm = "";
					$completed = "";
					
				}
				else if($value['booking_status']=='confirmed'){
					
					$notConfirm = "";
					$confirm = "active";
					$completed = "";
				
				}
				else{
					
					$notConfirm = "";
					$confirm = "";
					$completed = "active";
					
				}
				
			
			}
		
		}
		else{
			
			$notConfirm = "";
			$confirm = "";
			$completed = "";
		
		
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
    <li><a href="booking_manager.php"><i class="fas fa-stream"></i>Bookings <span style="color:#C00;font-weight:500">
	<?php echo $bookingCount;?></span></a></li>
    <li><a href="order_manager.php"><i class="fas fa-calendar-week"></i>Orders <span style="color:#C00;font-weight:500">
	<?php echo $ordersCount;?></span></a></li>
    <li><a href="service_manager.php"><i class="fas fa-sliders-h"></i>Services</a></li>
    <li><a href="user_manager.php"><i class="fas fa-user-friends"></i>Users</a></li>  
     
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">  
    	<li><a href="#"><button  type="submit" name="btnLogout" style="border:none; background:none; outline:none">
    	<i class="fas fa-sign-out-alt"></i>Log Out</button></a></li>
   	</form>
   
  </ul>
  
</div>


<!-- booking manager content -->

<div class="container" style="margin-left:250px; padding-right:50px">

	<div class="row top_slideBar mb-5" align="right" >
    
    	<table class="table table-borderless" style="margin-top:12px;">
        	<tr>
            	<td>
                	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                		<input type="text" name="txtBookingSearch" placeholder="Enter Booking ID" required="required" />
            			<button type="submit" name="btnBookingSearch">Search</button>
                    </form>
                </td>
                
                <td align="right">
                
                	<h2 > Booking Manager</h2>
                </td>
              
            
            </tr>
        
        
        
        </table>
    
    </div>
    
    <div class="row" align="center" style="padding-top:100px;" >
   
    	<div class="col-lg-12 mt-4">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
 		 		<button class="revBtn <?php echo $notConfirm; ?>"  name="btnnotConfirm"><i class="fa fa-hourglass-half"></i>&nbsp; Not Confirm
                </button>
  				<button class="revBtn <?php echo $confirm; ?>"  name="btnConfirm" ><i class="fa fa-check"></i>&nbsp; Confirmed
                <span style="color:#C00;font-weight:600"><?php echo $bookConfirmCount;?></span>
                </button>
                <button class="revBtn <?php echo $completed; ?>"  name="btnCompleted" ><i class="fas fa-eye"></i>&nbsp; Completed
                <span style="color:#C00;font-weight:600"><?php echo $bookCompleteCount;?></span>
                </button>
  			</form>
        </div>
        
        
        
  
    </div>
    
    
    <div class="row m-4">
    <?php
		if(isset($_SESSION['booking_detailss'])){
    ?>
    <table class="table table-active" style="background:#f5f5f5;-webkit-box-shadow: 0px 5px 8px #333333;">
		<tr style="background:#C03; color:#FFF; font-weight:500" align="center">
         	<td>Booking Corde</td>
         	<td>Date</td>
         	<td>Time</td>
         	<td>Total</td>
            <td>User</td>
         	<td>Status</td>
         	<td>Action</td>
 		</tr>
   		<?php 
		
		
		foreach($_SESSION['booking_detailss'] as $key => $value){
				
			
	
		?>
    	<tr style="color:#333; font-size:14px; font-weight:500" align="center">
        
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    		<td><?php echo $value['b_id']; ?></td>
        	<td><?php echo $value['date']; ?></td>
        	<td><?php echo $value['time']; ?></td>
        	<td>Rs.<?php echo $value['total']; ?>.0</td>
            <td><?php echo $value['user_id']; ?></td>
        	<td><?php echo $value['booking_status']; ?></td>
        	<td>
            	
                <input type="hidden" name="txtb_id" value="<?php echo $value['b_id']; ?>"/>
                <input type="hidden" name="txtb_date" value="<?php echo $value['date']; ?>"/>
                <input type="hidden" name="txtb_time" value="<?php echo $value['time']; ?>"/>
                <input type="hidden" name="txtb_total" value="<?php echo $value['total']; ?>"/>
                <input type="hidden" name="txtb_user_id" value="<?php echo $value['user_id']; ?>"/>
                
               
                <button type="submit" class="btn btn-danger" <?php if($value['booking_status']=="completed" || $value['booking_status']==
				"confirmed"){?>  style="display:none"  <?php }?> name="btnReject">Reject</button>
                <button type="submit" class="btn btn-success" <?php if($value['booking_status']=="completed" || $value['booking_status']==
				"confirmed"){?>  style="display:none"  <?php }?> name="btnBConfirm">Confirm</button>
                
                <button type="submit" class="btn btn-success" <?php if($value['booking_status']=="completed" || $value['booking_status']==
				"processing"){?>  style="display:none"  <?php }?> name="btnBCompleted">Completed</button>
              </form>  
            	<button type="button" class="btn btn-info" data-toggle="modal" data-target="#<?php echo $value['b_id'];?>">More</button>
                
            </td>
    	</tr>
        
         <tr>
         
    	<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="<?php echo $value['b_id'];?>">
        
  			<div class="modal-dialog modal-lg">
    			<div class="modal-content">
                	<div class="modal-header" style="background:#C03 ;color:#FFF;">
        				<h5 class="modal-title" style="padding-left:15px;"> Booking Corde : <?php echo $value['b_id']; ?></h5>
        				<button type="button" class="close close_btn" data-dismiss="modal" aria-label="Close" style="outline:none;color:#FFF">
          				<span aria-hidden="true">&times;</span>
        				</button>
      				</div>
                    <div class="modal-body" style="background:#f5f5f5">
                    	
                        <div class="container">
                        	<div class="row m-auto pb-2" style="border-bottom:#CCC solid 1px" align="center">
                            
                            	<div class="col col-lg-4 m-auto"> <h5>Service Corde</h5></div>
                                <div class="col col-lg-4 m-auto"><h5>Services</h5></div>
                                <div class="col col-lg-4 m-auto"><h5>Price</h5></div>
                                
                            
                            </div>
                            <?php
								$Sql = "SELECT * FROM booking_details where b_id='".$value['b_id']."'";
								
								$result =mysqli_query($con,$Sql);
		
								while($row= mysqli_fetch_row($result)){
							
                           	?>
                            <div class="row m-auto pt-3 pb-3" style="border-bottom:#CCC solid 1px" align="center">
                            
                                <div class="col col-lg-4 m-auto"><h6><?php echo $row['2'];?></h6></div>
                                <div class="col col-lg-4 m-auto"><h6><?php echo $row['3'];?></h6></div>
                                <div class="col col-lg-4 m-auto"><h6>Rs.<?php echo $row['4'];?>.0</h6></div>
                            
                            </div>
                            <?php
							
								}
                            	
                            ?>
                            <div class="row m-auto" align="center" style="background-color:#333; color:#FFF">
                            	
                                <div class="col col-lg-4 mt-3 mb-3">
                                	<h3>Total</h3>
                                </div>
                                <div class="col col-lg-4 mt-3 mb-3">
                                
                                </div>
                                <div class="col col-lg-4 mt-3 mb-3">
                                	<h3>Rs.<?php echo $value['total'];?>.0</h3>
                                </div>
                            
                            </div>
                        </div>
                       
                    </div>
    			</div>
 			 </div>
		</div>
    
    	</tr>
   		<?php
   
		}
		
		?>
         
 	</table>
    <?php
	
	   }
	   else{
		   
	?>
                      
          <div class="col-lg-12 mt-3 mb-3" align="center">
          
              <div style="height:300px; width:400px; background-color:#FCC; padding-top:50px; border-radius:25px">
                <span style="color:#333"><svg cowidth="6em" height="6em" viewBox="0 0 16 16" class="bi 
				bi-exclamation-circle"fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd"
				d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M7.002 11a1 1 0 1 
				1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                </svg>
                </span>
				<h2 class="pt-5" style="text-transform:lowercase; font-family:'Trebuchet MS', Arial, Helvetica, 
                 sans-serif; color:#333; font-weight:600">No Bookings are In</h2>
              </div>
                
         </div>
    
    <?php 
	
	   }
	?>
   
   </div>
    
    
    
    
    
    
    
    
    

</div>



<script src="../js/jquery-3.3.1.min.js"></script> 
<script src="../js/main.js"></script>
</body>
</html>