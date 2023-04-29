<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Order Manager</title>


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
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

<style>
	.my_class{
		text-align: center;
	}
</style>

</head>

<body>

<?php 


session_start();


include('../db_Connection.php');

include('count.php');




// logout funtion

if(isset($_POST['btnLogout'])){

	?>
    <script>
    
    	location.replace("../index.php")
    
    </script>
    <?php 

}



$notShipped="active";

$shipped = "";




unset($_SESSION['order_detailss']);

$sql = "SELECT * FROM orders where order_status = 'processing' ";





if(isset($_POST['btnnotShipped'])){

	unset($_SESSION['order_detailss']);	
	
	$notShipped="active";

	$shipped = "";

	$sql = "SELECT * FROM orders where order_status = 'processing' ";
	
}


if(isset($_POST['btnMShipped'])){
	
	
	
	$notShipped="";

	$shipped = "active";

	$sql = "SELECT * FROM orders where order_status = 'shipped' ";	

}



	// view the orders 

	$result =mysqli_query($con,$sql);
		
		 while($row= mysqli_fetch_row($result)){
			 
			if(isset($_SESSION['order_detailss'])){

				$OrdersArray = array('order_id'=>$row[0],'date'=>$row[1],'time'=>$row[2],'total'=>$row[3],
				'order_status'=>$row[4],'user_id'=>$row[5]); 
				$count = count($_SESSION['order_detailss']);
		
		 		$_SESSION['order_detailss'][$count]=$OrdersArray;
				
		 }
		 else{
			 
			 $OrdersArray = array('order_id'=>$row[0],'date'=>$row[1],'time'=>$row[2],'total'=>$row[3],'order_status'=>$row[4],
			 'user_id'=>$row[5]); 
				
		
		 		$_SESSION['order_detailss'][0]=$OrdersArray;
			
			 
			 }
		 
		
		}




// order shipped function

if(isset($_POST['btnShipped'])){
	
	
	
	$status = "shipped";
	
	
	
	$SQL= "UPDATE `orders` SET `order_status`='".$status."' where order_id='".$_POST['txto_id']."' ";
	
	if(mysqli_query($con,$SQL)){
	?>	
		<script> swal("Order Has Shipped !", "Press Ok", "success");</script>
     <?php 
	 
	 include('mail_operation.php');
	  
	 unset($_SESSION['order_detailss']); 
	 
	 lodavalues2(); 
	 include('count.php');
	}
	else{
	?>
		<script> swal("<?php echo "Error : ". mysqli_error($con)."";?>", "Press Ok", "warning");</script>      
    <?php	
	}
	

}





// loading of processing orders 
function lodavalues2(){
	
	include('../db_Connection.php');
	

	$Sql = "SELECT * FROM orders where order_status = 'processing' ";
	$result =mysqli_query($con,$Sql);
		
		 while($row= mysqli_fetch_row($result)){
			 
			if(isset($_SESSION['order_detailss'])){

				$OrdersArray = array('order_id'=>$row[0],'date'=>$row[1],'time'=>$row[2],'total'=>$row[3],
				'order_status'=>$row[4],'user_id'=>$row[5]); 
				$count = count($_SESSION['order_detailss']);
		
		 		$_SESSION['order_detailss'][$count]=$OrdersArray;
				
		 }
		 else{
			 
			 $OrdersArray = array('order_id'=>$row[0],'date'=>$row[1],'time'=>$row[2],'total'=>$row[3],'order_status'=>$row[4],
			 'user_id'=>$row[5]); 
				
		
		 		$_SESSION['order_detailss'][0]=$OrdersArray;
			
			 
			 }
		 
		
		}




}



// search order

if(isset($_POST['btnOrderSearch'])){
	
	
	unset($_SESSION['order_detailss']);
	
	
	$order_id = $_POST['txtOrderSearch'];
	
	
	$sql = "SELECT * FROM orders where order_id = '".$order_id."' ";
	$result =mysqli_query($con,$sql);
		
		 while($row= mysqli_fetch_row($result)){
			 
			if(isset($_SESSION['order_detailss'])){

				$OrdersArray = array('order_id'=>$row[0],'date'=>$row[1],'time'=>$row[2],'total'=>$row[3],
				'order_status'=>$row[4],'user_id'=>$row[5]); 
				$count = count($_SESSION['order_detailss']);
		
		 		$_SESSION['order_detailss'][$count]=$OrdersArray;
				
		 	}
		 	else{
			 
			 $OrdersArray = array('order_id'=>$row[0],'date'=>$row[1],'time'=>$row[2],'total'=>$row[3],'order_status'=>$row[4],
			 'user_id'=>$row[5]); 
				
		
		 		$_SESSION['order_detailss'][0]=$OrdersArray;
			
			 
			}
		 
		
		}
		
		if(!empty($_SESSION['order_detailss'])){
			
			
			foreach($_SESSION['order_detailss'] as $key => $value){
				
				if($value['order_status']=='processing'){
					
					$notShipped="active";
					$shipped = "";
					
				}
				else{
					
					$notShipped="";
					$shipped = "active";
				
				}
				
			
			}
			
			
			
		}else{
			
			
			$notShipped="";
			$shipped = "";
		
		
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


<!-- Order manager content -->

<div class="container-fulid" style="margin-left:265px">

	<div class="row top_slideBar mb-5" align="right" >
    
    	<table class="table table-borderless" style="margin-top:12px;">
        	<tr>
            	<td>
                	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                		<input type="text" name="txtOrderSearch" placeholder="Enter Order ID" required="required" />
            			<button type="submit" name="btnOrderSearch">Search</button>
                    </form>
                </td>
                
                <td align="right">
                
                	<h2> Order Manager</h2>
                </td>
              
            
            </tr>
        
        
        
        </table>
    
    </div>
    
    <div class="row" align="center" style="padding-top:100px;" >
   
    	<div class="col-lg-12 mt-4">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
 		 		<button class="revBtn <?php echo $notShipped; ?>"  name="btnnotShipped"><i class="fa fa-hourglass-half"></i>&nbsp; Not Shipped
                </button>
                <button class="revBtn <?php echo $shipped; ?>"  name="btnMShipped" ><i class="fas fa-eye"></i>&nbsp; Shipped
                <span style="color:#C00;font-weight:600"><?php echo $orderShippedCount;?></span>
                </button>
  			</form>
        </div>
        
        
        
  
    </div>
    

<?php
if(isset($_SESSION['order_detailss'])){
?>
<div class="row m-4">
<div class="col-lg-12">
<table class="table table-active" style="background:#f5f5f5;-webkit-box-shadow: 0px 5px 8px #333333;" id="example">
	<thead>
		<tr style="background:#C03; color:#FFF; font-weight:500;text-align: center;">
			<td>Order Corde</td>
			<td>Date</td>
			<td>Time</td>
			<td>Total</td>
			<td>User</td>
			<td>Status</td>
			<td>Action</td>
		</tr>
	</thead>
	<tbody>
    <?php 
	
	foreach($_SESSION['order_detailss'] as $key => $value){
	
	?>
	
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <tr style="color:#333; font-size:14px; font-weight:500" align="center">
    	<td><?php echo $value['order_id']; ?></td>
        <td><?php echo $value['date']; ?></td>
        <td><?php echo $value['time']; ?></td>
        <td>Rs.<?php echo $value['total']; ?>.0</td>
        <td><?php echo $value['user_id']; ?></td>
        <td><?php echo $value['order_status']; ?></td>
        
        	<input type="hidden" name="txto_id" value="<?php echo $value['order_id']; ?>"/>
            <input type="hidden" name="txto_date" value="<?php echo $value['date']; ?>"/>
            <input type="hidden" name="txto_total" value="<?php echo $value['total']; ?>"/>
            <input type="hidden" name="txto_user_id" value="<?php echo $value['user_id']; ?>"/>
       
        <td>
			<button type="submit" class="btn btn-success" name="btnShipped" <?php if($value['order_status']=="shipped"){?> style="display:none;"<?php } ?>>Shipped</button>
			</form>
			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#<?php echo $value['order_id'];?>">More</button>
			<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="<?php echo $value['order_id'];?>">
  				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header" style="background:#C03 ;color:#FFF;">
							<h5 class="modal-title" style="padding-left:15px;"> Order Corde : <?php echo $value['order_id']; ?></h5>
							<button type="button" class="close close_btn" data-dismiss="modal" aria-label="Close" style="outline:none;color:#FFF">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body" style="background:#f5f5f5">
							
							<div class="container">
								<div class="row m-auto pb-2" align="center" style="border-bottom:#CCC solid 1px">
								
									<div class="col col-lg-3"> <h4>Item</h4></div>
									<div class="col col-lg-3"><h4>Price</h4></div>
									<div class="col col-lg-3"><h4>Qty</h4></div>
									<div class="col col-lg-3"><h4>Subtotal</h4></div>
								
								</div>
								<?php
								$Sql = "select * from order_details inner join products on order_details.p_id = products.p_id where order_id='".
								$value['order_id']."'";
							
										$result =mysqli_query($con,$Sql);
			
										while($row= mysqli_fetch_row($result)){ 
				
								?>
								<div class="row m-auto" align="center" style="border-bottom:#CCC solid 1px">
								
									<div class="col col-lg-3 mt-3">
										
										
										<img src="<?php echo $row[8];?>" alt="" width="120" height="120" style="
											-webkit-box-shadow: 0px 5px 8px #333333;">
										
											<h6 class="mt-3 mb-2"><?php echo $row[6];?></h6>
											<p class="mt-2 mb-3" style="font-size:11px; font-weight:600">Item Corde : <?php echo $row[2];?></p>
									</div>
									<div class="col col-lg-3 m-auto"><h6>Rs.<?php echo $row[7];?>.0</h6></div>
									<div class="col col-lg-3 m-auto"><h6><?php echo $row[3];?></h6></div>
									<div class="col col-lg-3 m-auto"><h6>Rs.<?php echo $row[4];?>.0</h6></div>
								
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
								
								<div class="row m-auto" align="center" style="color:#333; background-color:#FCF">
								
									<?php
									$SQLL = "select * from users where e_mail = '".$value['user_id']."' ";
									
									$result =mysqli_query($con,$SQLL);
			
									if($row= mysqli_fetch_row($result)){ 
									?>
									
										<div class="col col-lg-4 mt-4 mb-3">
											
											<h6><?php echo $row[1]?></h6>
												
										</div>
											
										<div class="col col-lg-4 mt-4 mb-3">
											
											<h6><?php echo $row[3]?></h6>
												
										</div>
											
										<div class="col col-lg-4 mt-4 mb-3">
											
											<h6><?php echo $row[4]?></h6>
												
										</div>
									
									<?php 
									
									}
									
									?>
									
								
				
								</div>
							</div>
						
						</div>
					</div>
				</div>
			</div>
        </td>
    </tr>
 
    
    <!-- <tr>
    	
    
    </tr> -->
	
   <?php 
   }
	
?>
<tbody>
</table>

</div>
</div>
<?php

}
else{
?>

<div class="row" align="center">
	<div class="col-lg-12 mt-5">
        <div style="height:300px; width:400px; background-color:#FCC; padding-top:50px; border-radius:25px">
              <span style="color:#333"><svg cowidth="6em" height="6em" viewBox="0 0 16 16" class="bi bi-exclamation-circle" fill=
				"currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8
				0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 
				3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/></svg>
              </span>
			<h2 class="pt-5" style="text-transform:lowercase; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; color:#333; 
            font-weight:600">No Orders are In</h2>
        </div>
                
   </div>

</div>
<?php

}


?>
    
    
    

</div>



<script src="../js/jquery-3.3.1.min.js"></script> 
<script src="../js/main.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function () {
    // $('#example').DataTable({
	// 	"columnDefs": [
    // 		{"className": "dt-center", "targets": "_all"}
  	// 	]
	// 	}
	// );
});
</script>
</body>
</html>