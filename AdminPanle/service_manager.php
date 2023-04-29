<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Service Manager</title>

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




</head>

<body>

<?php 

session_start();


include('../db_Connection.php');

include('count.php');



$name = "";
$price = "";




$viweServive ="active";
$addMservice = "";





$beverages ="active";
$waxing = "";
$bleaching="";
$facials="";




$SQL = "SELECT * FROM services where category = 'beverages'";






if(isset($_POST['btnbeverages'])){
	
	
	$beverages ="active";
	$waxing = "";
	$bleaching="";
	$facials="";
	
	$SQL = $SQL;

}


if(isset($_POST['btnWaxing'])){
	
	
	$beverages ="";
	$waxing = "active";
	$bleaching="";
	$facials="";
	
	$SQL = "SELECT * FROM services where category = 'Waxing'";

}


if(isset($_POST['btnbleaching'])){
	
	
	$beverages ="";
	$waxing = "";
	$bleaching="active";
	$facials="";
	
	$SQL = "SELECT * FROM services where category = 'Bleaching'";

}

if(isset($_POST['btnfacials'])){
	
	
	$beverages ="";
	$waxing = "";
	$bleaching="";
	$facials="active";
	
	$SQL = "SELECT * FROM services where category = 'Facials'";

}











if(isset($_POST['btnMService'])){
	
	
	$viweServive ="active";
	$addMservice = "";
	
	
	
}


if(isset($_POST['btnMAddService'])){
	
	
	$viweServive ="";
	$addMservice = "active";
	
	
	
}




// update service details

if(isset($_POST['btnSUpdate'])){
	
	$service_id = $_GET['id'];
	$name = $_POST['txtServiceName'];
	$category = $_POST['cmbSCategory'];
	$price = $_POST['txtServicePrice'];
	
	
	$sqll= "select * from services where service_id ='".$service_id."' ";
	
		$result =mysqli_query($con,$sqll);
		
		if($row= mysqli_fetch_row($result)){

	
			if($name!= $row[1] || $price!= $row[3] || $category!="Not_Set" ){
				
				
				if($category=="Not_Set"){
	
					$category = $_POST['txtServiceCategory'];
				}
				
	
				$SqL = "UPDATE `services` SET `name`='".$name."', `category`='".$category."', 
				`price`= ".$price." where service_id ='".$service_id."'";
	
				if(mysqli_query($con,$SqL)){
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




// add service


if(isset($_POST['btnAdd'])){
	
	
	$name = $_POST['txtServiceName'];
	$category = $_POST['cmbSCategory'];
	$price = $_POST['txtServicePrice'];
	
	
	$service_id =0;
	$s_id ="";
	
	
	$sqla = "SELECT * FROM `values` where v_id = '100'; ";
	
 	$result =mysqli_query($con,$sqla);
		
		 
	if($row= mysqli_fetch_row($result)){
			 
		$service_id = $row[4];
		$s_id ="SEV".$service_id;
			 
	}
	
	
	if($category!="Not_Set"){
	
		$sqlb ="INSERT INTO services VALUES('".$s_id."','".$name."', '".$category."' ,".$price.")";
	
		if(mysqli_query($con,$sqlb)){
					
					
			$service_id = $service_id+1;
						
			$SQLU ="UPDATE `values` SET `s_id`= ".$service_id." ";
		
			if(mysqli_query($con,$SQLU)){
							
			?>	
				<script> swal("Service Has Adding Successfully !", "Press Ok", "success");</script>
                            
       		<?php
							
			}
					    
		}
		else{
		?>
			<script> swal("<?php echo "Error : ". mysqli_error($con)."";?>", "Press Ok", "warning");</script>
              
    	<?php	

		}
	
	}
	else{
		
	?>	 
		<script> swal("Please Set Service Category !", "Press Ok", "warning");</script>
        
    <?php 
	
	}
	
	$viweServive ="";
	$addMservice = "active";


}





// Delete Service


if(isset($_POST['btnSDelete'])){
	
	
	$service_id = $_GET['id'];
	
	$sqlu ="DELETE FROM `services` WHERE service_id = '".$service_id."'";
	
	if(mysqli_query($con,$sqlu)){
		
	?>	
       
	<script> swal("Service Has Deleted !", "Press Ok", "success");</script>
        
    <?php 
	
	}
	
	








}




// search service

if(isset($_POST['btnServiceSearch'])){
	
	
	$service_id = $_POST['txtServiceSearch'];
	
	$sqly="SELECT * FROM services where service_id = '".$service_id."' ";
	
	$result =mysqli_query($con,$sqly);
		
	if($row= mysqli_fetch_row($result)){
		
		if($row[2]=="beverages"){
			
			$beverages ="active";
			$waxing = "";
			$bleaching="";
			$facials="";
			
		}
		else if($row[2]=="Waxing"){
			
			$beverages ="";
			$waxing = "active";
			$bleaching="";
			$facials="";
			
			
		}
		else if($row[2]=="Bleaching"){
			
			$beverages ="";
			$waxing = "";
			$bleaching="active";
			$facials="";
			
		
		}
		else if($row[2]=="Facials"){
			
			$beverages ="";
			$waxing = "";
			$bleaching="";
			$facials="active";
			
		
		}
		
		$SQL = $sqly;
		
		
	}
	else{
		
	?>
		<script> swal("Service Not Found !", "Press Ok", "warning");</script>
              
    <?php
		
		
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




// go style page 
if(isset($_POST['btnGoStyle'])){

	?>
    <script>
    
    	location.replace("style_manager.php")
    
    </script>
    <?php 

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


<!-- Service manager content -->

<div class="container" style="margin-left:250px; padding-right:50px">

	<div class="row top_slideBar mb-5" align="right" >
    
    	<table class="table table-borderless" style="margin-top:12px;">
        	<tr>
            	<td>
                	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                		<input type="text" name="txtServiceSearch" placeholder="Enter Service ID" required="required" />
            			<button type="submit" name="btnServiceSearch">Search</button>
                    </form>
                </td>
                
                <td align="right">
                
                	<h2>Services Manager</h2>
                </td>
              
            
            </tr>
        
        
        
        </table>
    
    </div>
    
    <div class="row" align="center" style="padding-top:100px;" >
   
    	<div class="col-lg-12 mt-4">
        	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        
 		 		<button class="revBtn <?php echo $viweServive; ?>"  name="btnMService"><i class="fas fa-eye"></i>&nbsp; Services
                </button>
  				<button class="revBtn <?php echo $addMservice; ?>"  name="btnMAddService" ><i class="fas fa-plus"></i>&nbsp; Add Service
                </button>
                <button class="revBtn "  name="btnGoStyle"><i class="fas fa-arrow-alt-circle-right"></i>&nbsp; Go Styles
                </button>
                
  			</form>
        </div>
        <div class="col-lg-12 mt-3 mb-3">
            
           <div style="border-bottom:solid #CCC 1px;"></div>
           
        </div>
        
        
  
    </div>
    
    
  <span <?php if(isset($_POST['btnMAddService']) || isset($_POST['btnAdd'])){ ?> style="display:none"<?php }else{?> 
  	style="display:block" <?php } ?>> 
     
      <div class="row m-4">
    
        <div class="col-lg-12 mt-2 mb-3 pb-3 pt-2 " align="center">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="sevBtn_group">
            <button class="sevBtn <?php echo $beverages; ?>"  name="btnbeverages" id="sevBtn">beverages</button>
            <button class="sevBtn <?php echo $waxing; ?>"  name="btnWaxing">Waxing</button>
            <button class="sevBtn <?php echo $bleaching; ?>"  name="btnbleaching">Bleaching</button>
            <button class="sevBtn <?php echo $facials; ?>"  name="btnfacials">Facials</button>
        </form>
        </div>
        
        <div class="col-lg-12">
        	<table class="table table-active" style="background:#f5f5f5;-webkit-box-shadow: 0px 5px 8px #333333;">
            
            	<tr style="background:#C03; color:#FFF; font-weight:500;">
                	
                    <td>Service ID</td>
                    <td>Service</td>
                    <td>Price</td>
                    <td>Action</td>
                
                
                </tr>
            	
            
            	
            	<?php 
				
					$result =mysqli_query($con,$SQL);
		
					while($row= mysqli_fetch_row($result)){
				
				?> 
                <tr style="font-weight:500; font-size:16px; color:#333;">
                
                
                	<td>
						<?php echo $row[0];?>
                    	
                    </td>
                	<td>
						<?php echo $row[1];?>
                    	
                    </td>
                    <td>
                    	Rs.<?php echo $row[3];?>.0
                       
                    </td>
                    <td>
						
                    	<button type="button" class="btn btn-info" data-toggle="modal" 
                        data-target="#<?php echo $row[0];?>">More</button>
                    </td>
                    
                            
                    	<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="<?php echo $row[0];?>">
        
  						<div class="modal-dialog modal-lg">
    						<div class="modal-content">
                				<div class="modal-header" style="background:#C03 ;color:#FFF;">
        						<h5 class="modal-title" style="padding-left:15px;">Service ID : <?php echo $row[0]; ?></h5>
        						<button type="button" class="close close_btn" data-dismiss="modal" aria-label="Close" 
                                	style="outline:none;color:#FFF">
          							<span aria-hidden="true">&times;</span>
        						</button>
      							</div>
                    			<div class="modal-body" style="background:#f5f5f5">
                    	
                        			<div class="container">
                                    	
                                        <div class="row pb-5 mt-4 mb-5" style="border:solid #FFF 3px; 
                                        	background-color:#f5f5f5; border-radius:50px;margin:0px 75px 0px 75px; 
                                        	-webkit-box-shadow: 0px 5px 8px #333333;">
                                            
                                            <div class="col-lg-8 m-auto" align="center">
                                            	
                                                <form action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $row[0];?>" method="post">
                                            	
                                            	<div class="feild">
            										<div>
            											<label class="flb">Service Name</label>
                									</div>
													<input type="text" class="p_input" name="txtServiceName" 
                                                    required="required" placeholder="Service" 
                                                    value="<?php echo $row[1]; ?>" maxlength="50"/>
								
												</div>
                                                
                                                <div class="feild">
            										<div>
            											<label class="flb">Category of Service</label>
                									</div>
													<input type="text" class="s_category_input" name="txtServiceCategory" 
                                                    placeholder="Service" value="<?php echo $row[2]; ?>" readonly="readonly"/>
                                                    
                                                    <select name="cmbSCategory" class="s_categoryBox" >
                    									<option value="Not_Set">Not Set</option>
    													<option value="beverages">beverages</option>
        												<option value="Waxing">Waxing</option>
        												<option value="Bleaching">Bleaching</option>
        												<option value="Facials">Facials</option>
    												</select>
								
												</div>
                                                
                                                <div class="feild">
            										<div>
            											<label class="flb">Price</label>
                									</div>
													<input type="text" class="p_input" name="txtServicePrice" 
                                                    required="required" placeholder="Price" 
                                                    value="<?php echo $row[3]; ?>" maxlength="10" onkeypress="isInputNumber(event)"/>
								
												</div>
                                                
                                                
                                                <div class="mt-4">
                	
                        							<button type="submit" name="btnSUpdate" class=" btn btn-success btnproductUpdate_Delete">			
                                                    Update</button>
                        							<button type="submit" name="btnSDelete" class=" btn btn-danger ml-4  
                                                    btnproductUpdate_Delete">Delete</button>
                                                    
                    							</div>
                                                
                                                </form>
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
       
    </div>
    
</span> 

<span <?php if(isset($_POST['btnMAddService']) || isset($_POST['btnAdd'])){ ?> style="display:block"<?php }else{?> 
	style="display:none" <?php } ?>>

	<div class="row pb-5 mt-4 mb-5" style="border:solid #FFF 3px; background-color:#f5f5f5; 
    			border-radius:50px;margin:0px 75px 0px 75px; -webkit-box-shadow: 0px 5px 8px #333333;">
                                            
         <div class="col-lg-5 m-auto" align="center">
                                            	
             <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                                            	
             	<div class="feild">
           			<div>
            			<label class="flb">Service Name</label>
                	</div>
					<input type="text" class="p_input" name="txtServiceName"required="required" placeholder="Service" 
                	value="<?php echo $name;?>" maxlength="50"/>
								
				</div>
                                                
                <div class="feild">
            		<div>
            			<label class="flb">Category of Service</label>
                	</div>                             
                    <select name="cmbSCategory" class="si_categoryBox" >
                   		<option value="Not_Set">Not Set</option>
    					<option value="beverages">beverages</option>
        				<option value="Waxing">Waxing</option>
        				<option value="Bleaching">Bleaching</option>
        				<option value="Facials">Facials</option>
    				</select>
								
				</div>
                                                
                <div class="feild">
            		<div>
            			<label class="flb">Price</label>
                	</div>
					<input type="text" class="p_input" name="txtServicePrice" 
                     required="required" placeholder="Price" 
                     value="<?php echo $price;?>" maxlength="10" onkeypress="isInputNumber(event)"/>
								
				</div>
                                                
                                                
                <div class="mt-5">
                	
                     <button type="submit" class="btn btn-danger" name="btnAdd" style="height:45px;width:100%; font-weight:500">
                	 <i class="fas fa-plus">&nbsp;Add</i></button> 
                                                    
                </div>
                                                
            </form>
     </div>
                                    
  </div>





    
</span>   
    
</div>











<script>
 function isInputNumber(evt){             
    var ch = String.fromCharCode(evt.which);       
      if(!(/[0-9]/.test(ch))){
         evt.preventDefault();
      }             
 }
</script>

<script src="../js/jquery-3.3.1.min.js"></script> 
<script src="../js/main.js"></script>
</body>
</html>