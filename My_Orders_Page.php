<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Orders</title>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>


<link rel="stylesheet" href="css/style.css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>

<?php 
session_start();

include('db_Connection.php');
include('Cart.php');

$Home = "";
$Products = "";
$styles = "";
$about = "";
$page = "active";
$contact = "";


// view the orders have ordered 
if(isset($_SESSION['user_details'])){

unset($_SESSION['order_details']);

foreach($_SESSION['user_details'] as $key => $value){
	
		$sql = "SELECT * FROM orders where user_id = '".$value['email']."'";
	}
	
	$result =mysqli_query($con,$sql);
		
		 while($row= mysqli_fetch_row($result)){
			 
			if(isset($_SESSION['order_details'])){

				$OrdersArray = array('order_id'=>$row[0],'date'=>$row[1],'time'=>$row[2],'total'=>$row[3],
				'order_status'=>$row[4],'user_id'=>$row[5]); 
				$count = count($_SESSION['order_details']);
		
		 		$_SESSION['order_details'][$count]=$OrdersArray;
				
		 }else{
			 
			 
			 $OrdersArray = array('order_id'=>$row[0],'date'=>$row[1],'time'=>$row[2],'total'=>$row[3],
			 'order_status'=>$row[4],'user_id'=>$row[5]); 
				
		
		 		$_SESSION['order_details'][0]=$OrdersArray;
				
			
			 
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

<div class="container pb-5 mb-5" style="border-bottom:solid 1px #CCC">
<div class="row" align="center">
   <div class="col-lg-12 m-auto">
       <h2 class="mt-5 mb-1">My Orders</h2>
   </div>
</div>

<?php
if(isset($_SESSION['order_details'])){
?>
<div class="row mt-4">

<table class="table table-active" style="background:#f5f5f5;-webkit-box-shadow: 0px 5px 8px #333333;">
	<tr style="background:#C03; color:#FFF;">
         <th>Order Corde</th>
         <th>Date</th>
         <th>Time</th>
         <th>Total</th>
         <th>Status</th>
         <th>Action</th>
 	</tr>
    <?php 
	
	foreach($_SESSION['order_details'] as $key => $value){
	
	?>
    <tr style="color:#333; font-size:14px; font-weight:500">
    	<td><?php echo $value['order_id']; ?></td>
        <td><?php echo $value['date']; ?></td>
        <td><?php echo $value['time']; ?></td>
        <td>Rs.<?php echo $value['total']; ?>.0</td>
        <td><?php echo $value['order_status']; ?></td>
        <td><button type="submit" class="btn btn-info" data-toggle="modal" data-target="#<?php echo $value['order_id'];?>">More</button></td>
    </tr>
 
    
    <tr>
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
<!-- Footer Section Begin -->
<?php include('Footer.php');?>
<!-- Footer Section End -->


<script src="js/jquery-3.3.1.min.js"></script> 
<script src="js/main.js"></script>
</body>
</html>