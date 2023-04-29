
<?php

date_default_timezone_set('Asia/Colombo');


// prepare order id
$order_status = "processing";
$order_ID = 0;
$O_ID ="";

$update_order_ID = 0;

$SQL="SELECT * FROM `values` where v_id = '100'; "; 

$result =mysqli_query($con,$SQL);
		
		 
	if($row= mysqli_fetch_row($result)){
			 
		$order_ID = $row[1];
		$O_ID ="ORD".$order_ID;
		
		$_SESSION['O_ID'] = $O_ID;
			 
	}






    // add to cart
	if(isset($_POST['btnAddToCart'])){
	 
	  $_SESSION['total']=0;
	  
	  if(isset($_SESSION['cart'])){
		  $pID = array_map(function($value){return $value['id'];},$_SESSION['cart']);
		  if(!in_array($_GET['id'],$pID)){
			  $count = count($_SESSION['cart']);
			  $proArray = array('id'=>$_GET['id'],'name'=>$_POST['productName'],'price'=>$_POST['productPrice'],'qty'=>$_POST['txtQty'],
			  'productImage'=>$_POST['productIMG']); 
			  $_SESSION['cart'][$count] =$proArray;			 
			  $_SESSION['items'] +=1;
			 
			  
			 ?>
             <script> swal("Item has Add to Cart", "Press Ok", "success");</script>
             <?php 	 		  		  
		  }
		    
	  }
	  else{
		 $proArray = array('id'=>$_GET['id'],'name'=>$_POST['productName'],'price'=>$_POST['productPrice'],'qty'=>$_POST['txtQty'],
		 'productImage'=>$_POST['productIMG']); 
		 $_SESSION['cart'][0] =$proArray;		
		 $_SESSION['items']=1;
		?>
        	<script> swal("Item has Add to Cart", "Press Ok", "success");</script>
         <?php 		  
	  }	
	
	}
	
   ?>




<?php
 //remove items
	if(isset($_POST['btnRemove'])){
		
		foreach($_SESSION['cart'] as $key => $value){
			if($value['id']==$_GET['id']){
				
				$_SESSION['total']=0;
				unset($_SESSION['cart'][$key]);
				$_SESSION['items'] -=1;
		?>
        	 <script> //swal("Item has Removed", "You clicked the button!", "success");
             			swal({
  						title: "Item has Removed!",
  						text: "This will close in 2 seconds.",
  						timer: 1500,
  						showConfirmButton: false
						});
             </script>
        <?php
			}
		}
	}
	
	//cancel cart
	if(isset($_POST['btnCancelCart'])){
			unset($_SESSION['cart']);
			unset($_SESSION['items']);
			
			
	}
	
	
	
// check out button 
if(isset($_POST['btnCheckOut'])){
	
  if(isset($_SESSION['user_details'])){	
	
	foreach($_SESSION['user_details'] as $key => $value){
	
	$sql = "INSERT INTO `orders`(`order_id`, `order_date`, `order_time`, `total`, `order_status`, `user_id` ) VALUES ('".$O_ID."','".date('Y-m-d')."', '".date("h:iA")."', ".$_SESSION['total'].", '".$order_status."','".$value['email']."')";
	}
	
	if(mysqli_query($con,$sql)){
		
		
		foreach($_SESSION['cart'] as $key=>$value){
			
			
			$subtotal = $value['price']* $value['qty'];
			$Sql =  "INSERT INTO `order_details`(`order_id`, `p_id`, `qty`, `subtotal`) VALUES ('".$O_ID."','".$value['id']."',".$value['qty']
			.",".$subtotal.")";
			if(mysqli_query($con,$Sql)){
				
				
			}else{
				
				echo "<p>Error : ". mysqli_error($con)."</p>";
			}
			
			
		}
		
		include('Email_Operation.php');
		?>
		<script> swal("Order has Placed !", "", "success");</script>
		
		<?php
		
		
	
		$update_order_ID = $order_ID+1;
		
		$SQLU ="UPDATE `values` SET `order_id`= ".$update_order_ID." ";
		mysqli_query($con,$SQLU);
		
		
		unset($_SESSION['O_ID']);
		unset($_SESSION['cart']);
		unset($_SESSION['items']);

				
	}
	else{
		
		echo "<p>Error : ". mysqli_error($con)."</p>";
		}
	
	
  }
  else{
	  
	  $_SESSION['notLoginMsg']="You Have to Login First";
	  ?>
      	<script>
  			location.replace("Login.php")	
      </script>
      <?php
	  
  }
	
}
	
	
	
	
	
	
	
	
	
	
	
	
	
?>


