<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Style Manager</title>
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




// logout funtion

if(isset($_POST['btnLogout'])){

	?>
    <script>
    
    	location.replace("../index.php")
    
    </script>
    <?php 

}



	$ViewStyles ="active";
	$AddStyle="";



	$s_name = "";
	$s_price = "";
	$category = "";
	$beveragesTypes = "";
	$dressTypes = "";
	$occasion  =  "";
	$description = "";








if(isset($_POST['btnViewStyles'])){
	
	$ViewStyles ="active";
	$AddStyle="";
	
	
	
	
}

if(isset($_POST['btnAddStyle'])){
	
	$ViewStyles ="";
	$AddStyle="active";
	
	
	
	
}





	$all 	 ="active";
	$Casual  = "";
	$Parties = "";
	$Event   = "";
	
	
	$sql ="SELECT * FROM styles";

if(isset($_POST['btnAll'])){
	
	$all     ="active";
	$Casual  = "";
	$Parties = "";
	$Event   = "";
	
	
	$sql = $sql;
	
}

if(isset($_POST['btnCasual'])){
	
	$all     = "";
	$Casual  = "active";
	$Parties = "";
	$Event   = "";
	
	$sql ="SELECT * FROM styles where category = 'Casual'";
	
}

if(isset($_POST['btnParties'])){
	
	$all     = "";
	$Casual  = "";
	$Parties = "active";
	$Event   = "";
	
	$sql ="SELECT * FROM styles where category = 'Parties'";
	
}

if(isset($_POST['btnEvent'])){
	
	$all     = "";
	$Casual  = "";
	$Parties = "";
	$Event   = "active";
	
	$sql ="SELECT * FROM styles where category = 'Formal Events'";
	
}






if(isset($_POST['AddStyle'])){
	
	$ViewStyles ="";
	$AddStyle="active";



}




// update style 

if(isset($_POST['btnSUpdate'])){
	
	
	$s_id = $_GET['id'];
	$s_name = $_POST['txtstyleName'];
	$s_price = $_POST['txtstylePrice'];
	$category = $_POST['cmbSCategory'];
	$beveragesTypes = $_POST['txtbeveragesType'];
	$dressTypes = $_POST['txtDressType'];
	$occasion = $_POST['txtOccasion'];
	$description = $_POST['txtDescription'];
	
	
	if(empty($description)){
			
	?>
		
        <script> swal("Please Add Description!", "Press Ok", "warning");</script> 
             
    <?php

	}else{
		
		
		if(!empty($_FILES['styleImage']['name'])){
			
				if($category=="Not_Set"){
	
					$category = $_POST['styleCategory'];
				}
				
				$temp_image = $_FILES['styleImage']['tmp_name'];
				$imageName  = $_FILES['styleImage']['name'];
			
				$ext = explode(".",$imageName);
				$extType = array("jpg","png","gif","jpeg");
			
				if(in_array($ext[1],$extType)){
				
					$image_base64 = base64_encode(file_get_contents($temp_image));
					$image = "data:image/;base64,".$image_base64;
				
					$SQL = "UPDATE `styles` SET `name`='".$s_name."',`price`=".$s_price.",`style_img`='".$image."',`category`='".                    $category."', `description`='".$description."', `suitable_beverages_types`='".$beveragesTypes."', 
					`matching_dresses`='".$dressTypes."', `best_occasion`='".$occasion."' where style_id ='".$s_id."'";
						
					if(mysqli_query($con,$SQL)){
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
		else{
			
			
			$sqll = "select * from styles where style_id ='".$s_id."'";
			
			$result =mysqli_query($con,$sqll);
		
			if($row= mysqli_fetch_row($result)){
			
				if($s_name!= $row[1] || $s_price!= $row[2] || $category!="Not_Set" || $description!=$row[5] || $beveragesTypes!=$row[6] 
				
				|| $dressTypes!=$row[7] || $occasion!=$row[8]){
					
					
					if($category=="Not_Set"){
	
						$category = $_POST['styleCategory'];
						
					}
					
			
			
					$SQL = "UPDATE `styles` SET `name`= '".$s_name."',`price`= ".$s_price.", 
					`category`='".$category."', `description`= '".$description."', 
					`suitable_beverages_types`= '".$beveragesTypes."', `matching_dresses`= '".$dressTypes."', 
					`best_occasion`= '".$occasion."' where style_id ='".$s_id."'";
					
					if(mysqli_query($con,$SQL)){
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
		
		
	}
	

}





// add a style 


if(isset($_POST['AddStyle'])){
	
	
	$style_ID = 0;
	$ST_ID ="";


	$SQl="SELECT * FROM `values` where v_id = '100'; "; 

	$result =mysqli_query($con,$SQl);
		
		 
	if($row= mysqli_fetch_row($result)){
			 
		$style_ID = $row[5];
			 
	}
	
	
	
	
	$s_name = $_POST['txtStyleName'];
	$s_price = $_POST['txtStylePrice'];
	$category = $_POST['cmbSCategory'];
	$beveragesTypes = $_POST['txtbeveragesTypes'];
	$dressTypes = $_POST['txtDressTypes'];
	$occasion = $_POST['txtOccasion'];
	$description = $_POST['txtDescription'];
	
	
	
	if(empty($description)){
			
	?>
		
        <script> swal("Please Add Description!", "Press Ok", "warning");</script> 
             
    <?php

	}else{
		
		if($category=="Not_Set"){
		
		?>
        	<script> swal("Please Set Style Category !", "Press Ok", "warning");</script> 
             
   		<?php
		
		}
		else{
			
			
			if($category=="Casual"){
				
				$ST_ID ="CAL".$style_ID;
				
			}
			if($category=="Formal Events"){
				
				$ST_ID ="FEL".$style_ID;
				
			}
			if($category=="Parties"){
				
				$ST_ID ="PTY".$style_ID;
				
			}
			
			
			
			if(!empty($_FILES['style_Image']['name'])){
			
				$temp_image = $_FILES['style_Image']['tmp_name'];
				$imageName  = $_FILES['style_Image']['name'];
			
				$ext = explode(".",$imageName);
				$extType = array("jpg","png","gif","jpeg");
			
				if(in_array($ext[1],$extType)){
				
					$image_base64 = base64_encode(file_get_contents($temp_image));
					$image = "data:image/;base64,".$image_base64;
				
					$SQL = "INSERT INTO styles VALUES('".$ST_ID."','".$s_name."',".$s_price.",'".$image."','".$category."',
					'".$description."', '".$beveragesTypes."', '".$dressTypes."', '".$occasion."')";
						
					if(mysqli_query($con,$SQL)){
					
					
						$style_ID = $style_ID+1;
						
						$SQLU ="UPDATE `values` SET `st_id`= ".$style_ID."";
						if(mysqli_query($con,$SQLU)){
							
						?>	
							<script> swal("Style Has Adding Successfully !", "Press Ok", "success");</script>
                            
           				<?php
						
							$s_name = "";
							$s_price = "";
							$category = "";
							$beveragesTypes = "";
							$dressTypes = "";
							$occasion  =  "";
							$description = "";
							
						}
					    
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
        		<script> swal("Please Set Style Image !", "Press Ok", "warning");</script> 
             
   			<?php
			
			}
			
			
			
		}
		
	
		$ViewStyles ="";
		$AddStyle="active";;
	
	
	}
	
	
	
	

}




// delete style 

if(isset($_POST['btnDelete'])){
	
	
	$st_id = $_GET['id'];
	
	
	$SQL ="DELETE FROM `styles` WHERE style_id = '".$st_id."'";
	
	if(mysqli_query($con,$SQL)){
		
	?>	
       
	<script> swal("Style Has Deleted !", "Press Ok", "success");</script>
        
    <?php 
	
	}




}







// search style

if(isset($_POST['btnStyleSearch'])){
	
	
	
	$sql ="SELECT * FROM styles where style_id = '".$_POST['txtStyleSearch']."'";
	
	$result =mysqli_query($con,$sql);
		
		if($row= mysqli_fetch_row($result)){
			
			if($row[4]=="Casual"){
				
				$all 	 ="";
				$Casual  = "active";
				$Parties = "";
				$Event   = "";
			
			}
			else if($row[4]=="Formal Events"){
				
				$all 	 ="";
				$Casual  = "";
				$Parties = "";
				$Event   = "active";
			
			}
			else if($row[4]=="Parties"){
				
				$all 	 ="";
				$Casual  = "";
				$Parties = "active";
				$Event   = "";
			
			}
			
			
			
			
			 
		}
		else{
			
				$all 	 ="";
				$Casual  = "";
				$Parties = "";
				$Event   = "";
			
			?>	
            
				<script> swal("No Style !", "Press Ok", "warning");</script>
           			
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


<!-- User manager content -->

<div class="container" style="margin-left:250px; padding-right:50px">

	<div class="row top_slideBar mb-5" align="right" >
    
    	<table class="table table-borderless" style="margin-top:12px;">
        	<tr>
            	<td>
                	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                		<input type="text" name="txtStyleSearch" placeholder="Enter Style ID" required="required" />
            			<button type="submit" name="btnStyleSearch">Search</button>
                    </form>
                </td>
                
                <td align="right">
                
                	<h2>Style Manager</h2>
                    
                </td>
              
            
            </tr>
        
        
        
        </table>
    
    </div>
    
    <div class="row" align="center" style="padding-top:100px;" >
   
    	<div class="col-lg-12 mt-4">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
 		 		<button class="revBtn <?php echo $ViewStyles; ?>"  name="btnViewStyles"><i class="fas fa-eye"></i> View Styles</button>
  				<button class="revBtn <?php echo $AddStyle; ?>"  name="btnAddStyle" ><i class="fas fa-plus"></i> Add Style</button>
  			</form>
        </div>
        
        
        
  
    </div>
    

<!-- style manager content -->  

	<span <?php if(isset($_POST['btnAddStyle']) || isset($_POST['AddStyle'])){ ?> style="display:none"<?php }else{?> style="display:block" <?php } ?>>   
    
    <div class="row" align="left">
    	<div class="col-lg-12 mt-5">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            
 		 		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
 		 		<button class="stylesBtn <?php echo $all; ?>"  name="btnAll">All</button>
  				<button class="stylesBtn <?php echo $Casual; ?>"  name="btnCasual" >Casual</button>
  				<button class="stylesBtn <?php echo $Parties; ?>"  name="btnParties" >Parties</button>
  				<button class="stylesBtn <?php echo $Event; ?>"  name="btnEvent" >Formal Events</button>
                
  			</form>	
  		</div>
        
        <div class="col-lg-12 mt-3 mb-3">
            
            		<div style="border-bottom:solid #CCC 1px;"></div>
        </div>
    
    
    </div>
    
    
     <div class="row m-auto">
    
  
   	<?php
  
	 	$result =mysqli_query($con,$sql);
		
		while($row= mysqli_fetch_row($result)){
   
   	?>
   			
   		<div class="col-lg-4 col-md-6 ">
          		
           <div class="style_item">
                		
                <div class="style_item_img">
					<img src="<?php echo $row[3]; ?>" class="img-fluid" alt="Image" data-toggle="modal" 
                    data-target="#<?php echo $row[0];?>">
               </div>
                        
			   <div class="style_item-text"> 
                   	<div style="height:55px;">
						<h5><?php echo $row[1]; ?></h5>
                   	</div>
                            
					<h6>Rs.<?php echo $row[2]; ?>.0 &nbsp;</h6>
                            
				</div>
                
			</div>
                
		</div>   
                
 		<div class="modal fade bd-example-modal-lg" id="<?php echo $row[0];?>" role="dialog">
        
  		<div class="modal-dialog modal-lg">
        
  		<form action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $row[0];?>" method="post" enctype="multipart/form-data">
    		<div class="modal-content update_style" style="background-color:#f5f5f5; border-radius:10px">
      			<div class="modal-header">
        			<h5 class="modal-title" style="padding-left:15px;"></h5>
                    <input type="text" name="txtstyleName" value="<?php echo $row[1]; ?>" style="width:100%;" required="required"/>
        			<button type="button" class="close close_btn" data-dismiss="modal" aria-label="Close" style="outline:none;">
          			<span aria-hidden="true">&times;</span>
        			</button>
     			</div>
      			<div class="modal-body" style="border-bottom:solid #603 25px; border-radius:9px;">
     	
        			<div class="container">
                    
        				<div class="row">
             
            				<div class="col-lg-6 mb-1">
                				
                					<img src="<?php echo $row[3]; ?>" class="img-fluid" alt="Image"/ 
                                	style="-webkit-box-shadow: 0px 5px 8px #333333;">
                					<p class="stlye__corde mt-3">Style Corde : <?php echo $row[0];?></p>
                                    
                                    <label class=" flb">change product image (400 x 400)</label>
									<input type="file" name="styleImage" class="product_file_uploadBox" style="border:none;height:45px;"/>
                    				
                			</div>
                
                			<div class="style__details col-lg-6" style="text-align:right">
                				<h6 style="" align="center"> Description</h6>
                   				<p class="mb-1 mt-2">
                                
                                	<textarea type="text" name="txtDescription" maxlength="300" ><?php echo $row[5]; ?></textarea>
                                
                                </p>
                    
                    			<label>Price</label>
                    			<input type="text" name="txtstylePrice" onkeypress="isInputNumber(event)" maxlength="10" 
                                value="<?php echo $row[2]; ?>" style="width:61%;" required="required"/>
                    
                    			<div>
                                
                                	<label>Category</label>
                    				<input type="text" name="styleCategory" value="<?php echo $row[4]; ?>" readonly="readonly"/>
                                    <select name="cmbSCategory" class="styleCategoryBox">
                    					<option value="Not_Set">Not Set</option>
    									<option value="Casual">Casual</option>
        								<option value="Parties">Parties</option>
        								<option value="Formal Events">Formal Events</option>
    								</select>
                                  
                        			<label>beverages Types</label> 
                                    <input type="text" name="txtbeveragesType" value="<?php echo $row[6]; ?>" 
                                    style="width:61%;" required="required"/>
                                    
                                    <label>Dress Types</label> 
                                    <input type="text" name="txtDressType" value="<?php echo $row[7]; ?>" 
                                    style="width:61%;" required="required"/>
                                    
                                    <label>Occasion </label> 
                                    <input type="text" name="txtOccasion" value="<?php echo $row[8]; ?>" 
                                    style="width:61%;" required="required"/>
                          
                    
                    			</div>
                                
                                
                                <div class="mt-3">
                	
                        			<button type="submit" name="btnSUpdate" class=" btn btn-success btnproductUpdate_Delete">Update</button>
                        			<button type="submit" name="btnDelete" class=" btn btn-danger ml-4  
                                    btnproductUpdate_Delete">Delete</button>
                                    </form>
                    			</div>
                
                			</div>
      	
           
            			</div>
       
       				 </div>
        
      			</div>
      
    		</div>
   
  		</div>
		</div> 
                          
    <?php
		
	  }
			
	?>
            
	</div>
    
   </span> 
   
   
   <!-- Add Style --> 
   
   
   <span <?php if(isset($_POST['btnAddStyle']) || isset($_POST['AddStyle'])){ ?> style="display:block"<?php }else{?> style="display:none" 
   <?php } ?>>
   
   		
        <div class="row pt-5 pb-5 mt-4 mb-5" style="border:solid #FFF 3px; background-color:#f5f5f5; 
    	border-radius:50px;margin:0px 75px 0px 75px; -webkit-box-shadow: 0px 5px 8px #333333;">
    
    	<div class="col-lg-12 m-auto" align="center">
        
        	<span class="preview feild">
            	<img id="file-ip-1-preview" width="150" height="150"/>
    		</span>
    
    	</div>
    	<div class="col-lg-5 col-md-8 col-sm-12 m-auto" align="center">

    		<div class="felid">
            	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                <div>
            	<label class=" flb">Choose Style Image (400 x 400)</label>
                </div>
				<input type="file" name="style_Image" class="pfile_uploadBox" accept="image/*" onchange="showPreview(event);"/>
								
			</div>
            
            <div class="feild">
            	<div>
            	<label class=" flb">Style Name</label>
                </div>
				<input type="text" class="p_input" name="txtStyleName" required="required" placeholder="Style Name" 
                value="<?php echo $s_name;?>" maxlength="50"/>
								
			</div>
            
            <div class="feild">
            	
                <div>
            	<label class=" flb">Price</label>
                </div>
            	
				<input type="text" class="p_input" name="txtStylePrice" required="required" placeholder="Price" 
                value="<?php echo $s_price;?>"  maxlength="10" 
                onkeypress="isInputNumber(event)" />
								
			</div> 
            
            <div class="feild">
            
            	<div>
            		<label class=" flb">Category</label>
             	</div>
            	
				<select name="cmbSCategory" class="p_categoryBox" >
                    	<option value="Not_Set">Not Set</option>
    					<option value="Casual">Casual</option>
        				<option value="Parties">Parties</option>
        				<option value="Formal Events">Formal Events</option>
    				</select>
								
			</div>
            
            <div class="feild">
            	<div>
            	<label class=" flb">Suitable beverages Types</label>
                </div>
				<input type="text" class="p_input" name="txtbeveragesTypes" required="required" placeholder="beverages Types" 
                value="<?php echo $beveragesTypes;?>" maxlength="50"/>
								
			</div>
            
            <div class="feild">
            	<div>
            	<label class=" flb">Matching Dresses</label>
                </div>
				<input type="text" class="p_input" name="txtDressTypes" required="required" placeholder="Dress Types" 
                value="<?php echo $dressTypes;?>" maxlength="50"/>
								
			</div>
            
            <div class="feild">
            	<div>
            	<label class=" flb">Best Occasion</label>
                </div>
				<input type="text" class="p_input" name="txtOccasion" required="required" placeholder="Best Occasion" 
                value="<?php echo $occasion;?>" maxlength="50"/>
								
			</div>
            
            
            <div class="feild">
            	<div>
            	<label class=" flb">Description</label>
                </div>
				<textarea type="text" class="p_textarea" name="txtDescription"  
                placeholder="Description"><?php echo $description;?></textarea>				
			</div>      
            
            <div class="feild mb-4 mt-5" align="center">
            
            	<button type="submit" class="btn btn-danger" name="AddStyle" style="height:45px;width:100%; font-weight:500">
                <i class="fas fa-plus">&nbsp;Add</i></button> 
                 </form>
            </div>
                            
         
 		</div>
      
	</div>

   
  
   
   
   </span>
    

</div>







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




<script src="../js/jquery-3.3.1.min.js"></script> 
<script src="../js/main.js"></script>

</body>
</html>