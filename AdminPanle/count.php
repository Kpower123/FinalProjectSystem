
<?php

$ordersCount ="";
$orderShippedCount="";
$bookingCount = "";
$bookConfirmCount = "";
$bookCompleteCount ="";


	// count processing orders 

	$sql="SELECT COUNT(`order_id`) FROM orders where order_status = 'processing'";

	$result =mysqli_query($con,$sql);
		
		 
	if($row= mysqli_fetch_row($result)){
		
		
		$ordersCount = $row[0];
	
	
	}
	
	
	// count shipped orders 
	
	$sqls="SELECT COUNT(`order_id`) FROM orders where order_status = 'shipped'";

	$result =mysqli_query($con,$sqls);
		
		 
	if($row= mysqli_fetch_row($result)){
		
		
		$orderShippedCount = $row[0];
	
	
	}
	
	
	
	
	
	// count processing bookings 
	
	$Sql="SELECT COUNT(`b_id`) FROM booking where status = 'processing'";

	$result =mysqli_query($con,$Sql);
		
		 
	if($row= mysqli_fetch_row($result)){
		
		
		$bookingCount = $row[0];
	
	
	}
	
	
	
	// count confirmed bookings 
	
	$Sqlb="SELECT COUNT(`b_id`) FROM booking where status = 'confirmed'";

	$result =mysqli_query($con,$Sqlb);
		
		 
	if($row= mysqli_fetch_row($result)){
		
		
		$bookConfirmCount = $row[0];
	
	
	}
	
	
	// count completed bookings 
	
	$Sqlbb="SELECT COUNT(`b_id`) FROM booking where status = 'completed'";

	$result =mysqli_query($con,$Sqlbb);
		
		 
	if($row= mysqli_fetch_row($result)){
		
		
		$bookCompleteCount = $row[0];
	
	
	}
	
	
	
	

?>