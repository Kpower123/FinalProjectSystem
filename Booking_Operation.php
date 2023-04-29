
<?php 

$styleCode="";


// prepare the booking id
$booking_status = "processing";
$booking_ID = 0;
$B_ID ="";

$SQL="SELECT * FROM `values` where v_id = '100'; "; 

$result =mysqli_query($con,$SQL);
		
		 
	while($row= mysqli_fetch_row($result)){
			 
		$booking_ID = $row[2];
		$B_ID ="BRD".$booking_ID;
		
		$_SESSION['B_ID'] = $B_ID;
			 
	}



// booking a style

if(isset($_POST['btnBookNowStyle'])){
	
	if(isset($_SESSION['user_details'])){
		
		
		if($_POST['cmbTime']==""){
			
		?>	
			<script> swal("Please Set Time", "Press Ok", "warning");</script>
	
		<?php
			
		}
		else{
			
			
			foreach($_SESSION['user_details'] as $key => $value){
		
			$SQl="select * from booking_details inner join booking on booking.b_id = 
			booking_details.b_id where service_id = '".$_POST['styleCorde']."' and user_id = '".$value['email']."' ";
		
			}
		
			$result =mysqli_query($con,$SQl);
		
			if($row= mysqli_fetch_row($result)){
	
				?>
					<script> swal("Your Booking has Already Placed !", "", "warning");</script>
		
				<?php
				
			}
			else{
				
				foreach($_SESSION['user_details'] as $key => $value){
			
					$sql = "INSERT INTO `booking`(`b_id`, `date`, `time`, `total`, `status`, `user_id` ) VALUES ('".$B_ID."','".$_POST[
					'txtDate']."', '".$_POST['cmbTime']."', ".$_POST['stylePrice'].", '".$booking_status."','".$value['email']."')";
				}
				
				if(mysqli_query($con,$sql)){
			
			
					$Sql =  "INSERT INTO `booking_details`(`b_id`, `service_id`, `service_name`  , `price`) VALUES ('".$B_ID."', 
					'".$_POST['styleCorde']."', '".$_POST['styleName']."',".$_POST['stylePrice'].")";
					
					if(mysqli_query($con,$Sql)){
				
					?>
						<script> swal("Your Booking has Placed !", "", "success");</script>
                        
					<?php
					
						include('Email_Operation.php');
			
					}
					else{
					
						echo "<p>Error : ". mysqli_error($con)."</p>";
					}
					
					unset($_SESSION['B_ID']);
					
					$booking_ID = $booking_ID+1;
		
					$SQLU ="UPDATE `values` SET `b_id`= ".$booking_ID." ";
					mysqli_query($con,$SQLU);
							
				}
						
		   	}
		
		}
						
	}
	else{
	  
	  $_SESSION['notLoginMsg']="You Have to Login First !";
	  ?>
      	<script>
  			location.replace("Login.php")	
      </script>
      <?php
	  
  	}	
	
	
}


// booking servies 

if(isset($_POST['AddToBooking'])){
	
	
	if(isset($_SESSION['bookingList'])){
		  $sID = array_map(function($value){return $value['service_id'];},$_SESSION['bookingList']);
		  if(!in_array($_GET['id'],$sID)){
			  $count = count($_SESSION['bookingList']);
			  $bookingListArray = array('service_id'=>$_GET['id'],'service_name'=>$_POST['service_name'],'price'=>$_POST['service_price']); 
			  $_SESSION['bookingList'][$count] =$bookingListArray;			 
			  $_SESSION['booking_items'] +=1;
			 
			  
			 ?>
             <script> swal("Service has Add to Booking List", "Press Ok", "success");</script>
             <?php 	 		  		  
		  }
		  else{
		 	  
			  $_SESSION['bookingErro']="This Service has Already in Your Booking List !";
		 	
		  }		  
	  }
	  else{
		 $bookingListArray = array('service_id'=>$_GET['id'],'service_name'=>$_POST['service_name'],'price'=>$_POST['service_price']); 
		 $_SESSION['bookingList'][0] =$bookingListArray;		
		 $_SESSION['booking_items']=1;
		?>
        	<script> swal("Service has Add to Booking List", "Press Ok", "success");</script>
         <?php 		  
	  }	
	
	


}



//remove booking service
	if(isset($_POST['btnRemove'])){
		
		foreach($_SESSION['bookingList'] as $key => $value){
			if($value['service_id']==$_GET['id']){
				
				$_SESSION['service_total']=0;
				unset($_SESSION['bookingList'][$key]);
				$_SESSION['booking_items'] -=1;
		?>
        	 <script> //swal("Item has Removed", "You clicked the button!", "success");
             			swal({
  						title: "Service has Removed!",
  						text: "This will close in 2 seconds.",
  						timer: 1500,
  						showConfirmButton: false
						});
             </script>
        <?php
			}
		}
	}


//cancel booking list
	if(isset($_POST['btnbookCancel'])){
			unset($_SESSION['bookingList']);
			unset($_SESSION['booking_items']);
			unset($_SESSION['service_total']);
			


	}
	
	
	
// booking confirm

if(isset($_POST['btnbookConfirm'])){
	
	if(isset($_SESSION['user_details'])){
		
		if($_POST['cmbTime']==""){
			
		?>	
			<script> swal("Please Set Time", "Press Ok", "warning");</script>
	
		<?php
			
		}
		else{
			
			foreach($_SESSION['user_details'] as $key => $value){
			
				$sql = "INSERT INTO `booking`(`b_id`, `date`, `time`, `total`, `status`, `user_id` ) VALUES ('".$B_ID."','".$_POST[
				       'txtDate']."', '".$_POST['cmbTime']."', ".$_SESSION['service_total'].", '".$booking_status."','".$value['email']."')";
			}
			
			if(mysqli_query($con,$sql)){
			
					foreach($_SESSION['bookingList'] as $key => $value){
						
					$Sql =  "INSERT INTO `booking_details`(`b_id`, `service_id`, `service_name` , `price`) VALUES 
							('".$B_ID."', '".$value['service_id']."','".$value['service_name']."',".$value['price'].")";
					
						mysqli_query($con,$Sql);
					
					}
					
						include('Email_Operation.php');
					
					?>
						<script> swal("Your Booking has Placed !", "", "success");</script>
		
					<?php
			
					$update_Booking_ID = $booking_ID+1;
		
					$SQLU ="UPDATE `values` SET `b_id`= ".$update_Booking_ID." ";
					mysqli_query($con,$SQLU);
					
					
					unset($_SESSION['B_ID']);
					unset($_SESSION['bookingList']);
					unset($_SESSION['booking_items']);
					unset($_SESSION['service_total']);
							
				}
						
			
			
		
		}
	
	
	}
	else{
	  
	  $_SESSION['notLoginMsg']="You Have to Login First !";
	  ?>
      	<script>
  			location.replace("Login.php")	
      </script>
      <?php
	  
  	}	
	
	
	

}
	
	
	

?>







<!-- My booking List   -->

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="myBookingList">
        
  			<div class="modal-dialog modal-lg">
    			<div class="modal-content">
                	<div class="modal-header" style="background:#C03 ;color:#FFF;">
        				<h5 class="modal-title" style="padding-left:15px;">My Booking List</h5>
        				<button type="button" class="close close_btn" data-dismiss="modal" aria-label="Close" style="outline:none;color:#FFF">
          				<span aria-hidden="true">&times;</span>
        				</button>
      				</div>
                    <div class="modal-body" style="background:#f5f5f5">
                    	
                        <div class="container">
                        <?php
							if(!empty($_SESSION['bookingList'])){
						?>
                        	<div class="row m-auto pb-2" style="border-bottom:#CCC solid 1px" align="center">
                            
                            	<div class="col col-lg-3 m-auto"> <h5>Service Corde</h5></div>
                                <div class="col col-lg-3 m-auto"><h5>Services</h5></div>
                                <div class="col col-lg-3 m-auto"><h5>Price</h5></div>
                                <div class="col col-lg-3 m-auto"></div>
                             
                               
                            </div>
                           
                            <?php
								$total =0;
                           		foreach($_SESSION['bookingList'] as $key => $value){
							?>
                            <form action="<?php echo $_SERVER['PHP_SELF'];?> ?id=<?php echo $value['service_id'];?>" method="post">
                            <div class="row m-auto pt-3 pb-3" style="border-bottom:#CCC solid 1px" align="center">
                            
                                <div class="col col-lg-3 m-auto"><h6><?php echo $value['service_id'];?></h6></div>
                                <div class="col col-lg-3 m-auto"><h6><?php echo $value['service_name'];?></h6></div>
                                <div class="col col-lg-3 m-auto"><h6>Rs.<?php echo $value['price'];?>.0</h6></div>
                                <div class="col col-lg-3 m-auto">
                                
                                <button type="submit" name="btnRemove" class="iconn_close" style="outline:none">
											<svg width="25px" height="25px"viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns=
											"http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 
											7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 
											2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                </button>
                                
                                </div>
                                
                            
                            </div>
                            </form>
                            <?php
									$total += $value['price'];
									$_SESSION['service_total']=$total;
										
								}
							?>
                            
                            <div class="row m-auto" align="center">
                            
                            	 <div class="col col-lg-12 mt-2 book_date_time" >
                                 
                                 <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                                  
                                 		<label>set date</label>
                        				<input type="date" name="txtDate" required="required" 
                                        value="<?php if(isset($_POST['txtDate'])){ echo $_POST['txtDate'];}?>"/>
                                 
                                
                                 	
                        				<select name="cmbTime" class="time_box">
    										<option value="">Not Set</option>
        									<option value="10:00AM">10:00AM</option>
        									<option value="12:00PM">12:00PM</option>
                            				<option value="03:00PM">03:00PM</option>
                            				<option value="05:00PM">05:00PM</option>
        
    									</select>
                                    
                                    	<label style="border-radius:0px 25px 25px 0px;">set time</label>
                             	</div>
                                
                            </div>
                            
                            <div class="row m-auto" align="center">
                            	
                                <div class="col col-lg-3 mt-3 mb-3" style="background-color:#333; color:#FFF; padding:30px 0px 0px 0px">                                	<h3>Total</h3>  
                                </div>
                                
                                <div class="col col-lg-3 mt-3 mb-3" style="background-color:#333; color:#FFF; padding:30px 20px 0px 0px">
                                	<h3>Rs.<?php echo $_SESSION['service_total'];?>.0</h3>
                                </div>
                                
                                <div class="col col-lg-6 mb-3">
                                
                                	<div>
                                    	<button type="submit" class="btnbookConfirm mt-3" name="btnbookConfirm">Confirm</button>
                             	  </form>
                                    </div>
                                    <div>
                                    	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                                    		<button type="submit" class="btnbookCancel mt-3" name="btnbookCancel">Cancel</button>
                                    	</form>
                                	</div>
                                    
                                </div>
                            
                            </div>
                           <?php 
						   
							}
							else{
						   
						   ?>
                           <div class="row" align="center">
                           
            			   		<div class="col-lg-12 mt-3 mb-3">
                					<div style="height:300px; width:400px; background-color:#FCC; padding-top:50px; border-radius:25px">
                						<span style="color:#333"><svg cowidth="6em" height="6em" viewBox="0 0 16 16" class="bi 
										bi-exclamation-circle"fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd"
										d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M7.002 11a1 1 0 1 
										1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                                        </svg>
                                		</span>
										<h2 class="pt-5" style="text-transform:lowercase; font-family:'Trebuchet MS', Arial, Helvetica, 
                                        sans-serif; color:#333; font-weight:600">No Services are In</h2>
                					</div>
                
                			</div>
           				 </div>
                    
                           <?php
						   
							}
							
                           ?>
                       </div>
                       
                    </div>
                    
    			</div>
                
 			 </div>
             
		</div>