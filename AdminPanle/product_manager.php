<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Product Manager</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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



// prepare order Id 
$product_ID = 0;
$P_ID ="";


$SQl="SELECT * FROM `values` where v_id = '100'; "; 

$result =mysqli_query($con,$SQl);
		
		 
	if($row= mysqli_fetch_row($result)){
			 
		$product_ID = $row[3];
			 
	}




	$p_name = "";
	$p_price = "";
	$description="";



$ViewProducts="active";
$Addroducts ="";


$all ="active";
$beverages = "";
$Foods = "";
$meat = "";
$Frozen = "";

	$sql ="SELECT * FROM products";

if(isset($_POST['btnAll'])){
	
	$all ="active";
	$beverages = "";
	$Foods = "";
	$meat = "";
	$Frozen = "";
	
	$sql = $sql;
	
}

if(isset($_POST['btnbeverages'])){
	
	$all ="";
	$beverages = "active";
	$Foods = "";
	$meat = "";
	$Frozen = "";
	
	$sql ="SELECT * FROM products where category = 'beverages'";
	
}

if(isset($_POST['btnFoodsCare'])){
	
	$all ="";
	$beverages = "";
	$Foods = "active";
	$meat = "";
	$Frozen = "";
	
	$sql ="SELECT * FROM products where category = 'FoodsCare'";
	
}

if(isset($_POST['btnmeat'])){
	
	$all ="";
	$beverages = "";
	$Foods = "";
	$meat = "active";
	$Frozen = "";
	
	$sql ="SELECT * FROM products where category = 'meat'";
	
}


if(isset($_POST['btnFrozen'])){
	
	$all ="";
	$beverages = "";
	$Foods = "";
	$meat = "";
	$Frozen = "active";
	
	$sql ="SELECT * FROM products where category = 'Frozen'";
}




if(isset($_POST['btnLogout'])){

	?>
    <script>
    
    	location.replace("../index.php")
    
    </script>
    <?php 

}





if(isset($_POST['btnViewProducts'])){
	
	$ViewProducts="active";
	$Addroducts ="";
	
	
}


if(isset($_POST['btnAddproducts'])){
	
	$ViewProducts="";
	$Addroducts ="active";
	
	
}







// product search 

if(isset($_POST['btnProductSearch'])){
	
	
	
	$sql ="SELECT * FROM products where p_id = '".$_POST['txtProductSearch']."'";
	
	$result =mysqli_query($con,$sql);
		
		if($row= mysqli_fetch_row($result)){
			
			if($row[4]=="beverages"){
				
				$all ="";
				$beverages = "active";
				$Foods = "";
				$meat = "";
				$Frozen = "";
			
			}
			else if($row[4]=="FoodsCare"){
				
				$all ="";
				$beverages = "";
				$Foods = "active";
				$meat = "";
				$Frozen = "";
			
			}
			else if($row[4]=="meat"){
				
				$all ="";
				$beverages = "";
				$Foods = "";
				$meat = "active";
				$Frozen = "";
			
			}
			else if($row[4]=="Frozen"){
				
				$all ="";
				$beverages = "";
				$Foods = "";
				$meat = "";
				$Frozen = "active";
			
			}
			
			
			
			 
		}
		else{
			
			$all ="";
			$beverages = "";
			$Foods = "";
			$meat = "";
			$Frozen = "";
			
			?>	
            
				<script> swal("No Product !", "Press Ok", "warning");</script>
           			
			<?php
		}
	
}



// product update 

if(isset($_POST['btnPUpdate'])){
	
	
	$p_id = $_GET['id'];
	$p_name = $_POST['productName'];
	$p_price = $_POST['productPrice'];
	$p_old_price = $_POST['oldProductPrice'];
	$category = $_POST['cmbCategory'];
	$status = $_POST['cmbStatus'];
	$description = $_POST['txtDescription'];
	
	
	if(empty($description)){
			
	?>
		
        <script> swal("Please Add Description!", "Press Ok", "warning");</script> 
             
    <?php

	}else{
		
		
		if(!empty($_FILES['productImage']['name'])){
			
				if($category=="Not_Set"){
	
					$category = $_POST['p_category'];
				}
				if($status== "Not_Set"){
		
					$status = $_POST['p_status'];
				}
			
				$temp_image = $_FILES['productImage']['tmp_name'];
				$imageName  = $_FILES['productImage']['name'];
			
				$ext = explode(".",$imageName);
				$extType = array("jpg","png","gif","jpeg");
			
				if(in_array($ext[1],$extType)){
				
					$image_base64 = base64_encode(file_get_contents($temp_image));
					$image = "data:image/;base64,".$image_base64;
				
					$SQL = "UPDATE `products` SET `p_name`='".$p_name."',`price`=".$p_price.",`p_image`='".$image."',`category`='".                    $category."', `description`='".$description."', `old_price`=".$p_old_price.", `status`='".$status."'  
					where p_id ='".$p_id."'";
						
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
			
			
			$sqll = "select * from products where p_id ='".$p_id."'";
			
			$result =mysqli_query($con,$sqll);
		
			if($row= mysqli_fetch_row($result)){
			
				if($p_name!= $row[1] || $p_price!= $row[2] || $category!="Not_Set" || $status!="Not_Set" || $description!=$row[5] || 
				$p_old_price!=$row[6] ){
					
					
					if($category=="Not_Set"){
	
						$category = $_POST['p_category'];
					}
					if($status== "Not_Set"){
		
						$status = $_POST['p_status'];
					}
			
			
					$SQL = "UPDATE `products` SET `p_name`='".$p_name."', `price`=".$p_price.", `category`='".$category."', `description`='".
					$description."', `old_price`=".$p_old_price.", `status`='".$status."' where p_id ='".$p_id."' ";
					
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


// product delete 

if(isset($_POST['btnDelete'])){
	
	
	$p_id = $_GET['id'];
	
	
	$SQL ="DELETE FROM `products` WHERE p_id = '".$p_id."'";
	
	if(mysqli_query($con,$SQL)){
		
	?>	
       
	<script> swal("Product Has Deleted !", "Press Ok", "success");</script>
        
    <?php 
	
	}




}






// Add product

if(isset($_POST['AddProduct'])){
	
	
	$p_name = $_POST['txtProductName'];
	$p_price = $_POST['txtProductPrice'];
	$p_old_price = 0;
	$category = $_POST['cmbPCategory'];
	$status = "Available";
	$description = $_POST['txtDescription'];
	
	
	
	if(empty($description)){
			
	?>
		
        <script> swal("Please Add Description!", "Press Ok", "warning");</script> 
             
    <?php

	}else{
		
		if($category=="Not_Set"){
		
		?>
        	<script> swal("Please Set Product Category !", "Press Ok", "warning");</script> 
             
   		<?php
		
		}
		else{
			
			
			if($category=="beverages"){
				
				$P_ID ="BEV".$product_ID;
				
			}
			if($category=="FoodsCare"){
				
				$P_ID ="FC".$product_ID;
				
			}
			if($category=="meat"){
				
				$P_ID ="MET".$product_ID;
				
			}
			if($category=="Frozen"){
				
				$P_ID ="FRZ".$product_ID;
				
			}
			
			
			
			if(!empty($_FILES['product_Image']['name'])){
			
				$temp_image = $_FILES['product_Image']['tmp_name'];
				$imageName  = $_FILES['product_Image']['name'];
			
				$ext = explode(".",$imageName);
				$extType = array("jpg","png","gif","jpeg");
			
				if(in_array($ext[1],$extType)){
				
					$image_base64 = base64_encode(file_get_contents($temp_image));
					$image = "data:image/;base64,".$image_base64;
				
					$SQL = "INSERT INTO products VALUES('".$P_ID."','".$p_name."',".$p_price.",'".$image."','".$category."',
					'".$description."',".$p_old_price.",'".$status."')";
						
					if(mysqli_query($con,$SQL)){
					
					
						$product_ID = $product_ID+1;
						
						$SQLU ="UPDATE `values` SET `p_id`= ".$product_ID."";
						if(mysqli_query($con,$SQLU)){
							
						?>	
							<script> swal("Product Has Adding Successfully !", "Press Ok", "success");</script>
                            
           				<?php
						
							$p_name = "";
							$p_price = "";
							$description="";
							
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
        		<script> swal("Please Set Product Image !", "Press Ok", "warning");</script> 
             
   			<?php
			
			}
			
			
			
		}
		
	
		$ViewProducts="";
		$Addroducts ="active";
	
	
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
    	<li><a href="#"><button type="submit" name="btnLogout" style="border:none; background:none; outline:none">
    	<i class="fas fa-sign-out-alt"></i>Log Out</button></a></li>
   	</form>
   
  </ul>
  
</div>


<!-- product manager content -->

<div class="container" style="margin-left:250px; padding-right:50px">

	<div class="row top_slideBar mb-5" align="right" >
    
    	<table class="table table-borderless" style="margin-top:12px;">
        	<tr>
            	<td>
                	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                		<input type="text" name="txtProductSearch" placeholder="Enter Product ID" required="required" />
            			<button type="submit" name="btnProductSearch">Search</button>
                    </form>
                </td>
                
                <td align="right">
                
                	<h2 >Product Manager</h2>
                </td>
              
            
            </tr>
        
        
        
        </table>
    
    </div>
	
    <div class="row" align="center" style="padding-top:100px;" >
   
    	<div class="col-lg-12 mt-4">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
 		 		<button class="revBtn <?php echo $ViewProducts; ?>"  name="btnViewProducts"><i class="fas fa-eye"></i> View Products</button>
  				<button class="revBtn <?php echo $Addroducts; ?>"  name="btnAddproducts" ><i class="fas fa-plus"></i> Add Products</button>
  			</form>
        </div>
        
        
        
  
    </div>
    
  <!-- view products -->
    
<span <?php if(isset($_POST['btnAddproducts']) || isset($_POST['AddProduct'])){ ?> style="display:none"<?php }else{?> style="display:block" <?php } ?>>    
    <div class="row" align="left">
    	<div class="col-lg-12 mt-5">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
 		 		<button class="productBtn <?php echo $all; ?>"  name="btnAll">All</button>
  				<button class="productBtn <?php echo $beverages; ?>"  name="btnbeverages" >beverages</button>
  				<button class="productBtn <?php echo $Foods; ?>"  name="btnFoodsCare" >Foods Care</button>
  				<button class="productBtn <?php echo $meat; ?>"  name="btnmeat" >meat</button>
                <button class="productBtn <?php echo $Frozen; ?>"  name="btnFrozen" >Frozen</button>
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
   			
   			 <div class="col-lg-3 col-md-6 ">
          		
            	<div class="product_item">
                		
                        <div class="prd_item_img">
						<img src="<?php echo $row[3]; ?>" class="img-fluid" alt="Image" data-toggle="modal" 
                        data-target="#<?php echo $row[0];?>">
                        </div>
                        
						<div class="product_item-text"> 
                        	<div style="height:55px;">
							<h5><?php echo $row[1]; ?><input type="hidden" name="productName" value="<?php echo $row[1]; ?>"/></h5>
                            </div>
                            
                            <span <?php if($row[7]=="Sold Out"){?> style="display:none;"  <?php }?>>
								<h6 <?php if(!empty($row[6])){?> style="color:#060;" <?php } ?> >Rs.<?php echo $row[2]; ?>.0 &nbsp; <del 
                                style="color:#666;font-weight:500; font-size:15px"><?php if(!empty($row[6])){ ?>Rs.<?php echo $row[6];?>.0	
								<?php } ?></del></h6>
                            </span>
                            
                            <div <?php if($row[7]=="Sold Out"){?> style="display:block;background:#900; color:#FFF; border-radius:10px; height
                            :30px;padding-top:4px;"  
							<?php }?> style="display:none;">
                            	Sold Out
                            </div>
                            
						</div>
                
				</div>         
         		
   			</div>
            
            
            
            <div class="modal fade bd-example-modal-lg" id="<?php echo $row[0];?>" role="dialog">
  				<div class="modal-dialog modal-lg">
 					 <form action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $row[0];?>" method="post" enctype="multipart/form-data">
  
    				<div class="modal-content update_product" style="background-color:#f5f5f5; border-radius:10px">
      					<div class="modal-header">
       						 <h5 class="modal-title" style="padding-left:15px;"></h5>
        					<input type="text" name="productName" value="<?php echo $row[1]; ?>" style="width:100%;" required="required"/>
        
        					<button type="button" class="close close_btn" data-dismiss="modal" aria-label="Close" style="outline:none;">
          					<span aria-hidden="true">&times;</span>
        					</button>
      					</div>
      			<div class="modal-body" style="border-bottom:solid #603 25px; border-radius:9px;">
     	
        	 <div class="container">
             
        		<div class="row">
             
            		<div class="col-lg-6 mb-1" align="center">
                
                		<img src="<?php echo $row[3]; ?>" class="img-fluid" alt="Image"/ 
                        style="-webkit-box-shadow: 0px 5px 8px #333333;" width="300" height="300">
                		<p class="item__corde mt-3">Item Corde : <?php echo $row[0];?></p>
                    	<input type="hidden" name="productIMG" value="<?php echo $row[3]; ?>"/>
                    
                     	<input type="hidden" name="itiem_code" value="<?php echo $row[0]; ?>"/>
              
                    	<label class=" flb">change product image (400 x 400)</label>
						<input type="file" name="productImage" class="product_file_uploadBox" style="border:none;height:45px;"/>	
                    
                    
                	</div>
                
                	<div class="product__details col-lg-6" style="text-align:center">
                		<h6 style=""> Description</h6>
                    	<p class=" mt-2">
                    		<textarea type="text" name="txtDescription" maxlength="300" ><?php echo $row[5]; ?></textarea>
                    	</p>
                    
                    	<label>Price</label>
                    		<input type="text" name="productPrice" value="<?php echo $row[2]; ?>" style="width:100px;" 
                            onkeypress="isInputNumber(event)" required="required"/>
                    
                    		<input type="text" name="oldProductPrice" value="<?php echo $row[6]; ?>" style="width:100px;" 
                            onkeypress="isInputNumber(event)" required="required"/>
                    	<label  style="border-radius:0px 25px 25px 0px">Old Price</label>
                    
                    	<div class="mt-3">
                   			 <label>Category :</label>
                    			<input type="text" name="p_category" value="<?php echo $row[4]; ?>" style="width:138px;" readonly="readonly"/>
    							<select name="cmbCategory" class="category_box" >
                    				<option value="Not_Set">Not Set</option>
    								<option value="beverages">beverages</option>
        							<option value="FoodsCare">FoodsCare</option>
        							<option value="meat">meat</option>
        							<option value="Frozen">Frozen</option>
    							</select>
                    	</div>
                    
                    	<div class="mt-3">
                    		<label>Status :</label>
                   				 <input type="text" name="p_status" value="<?php echo $row[7]; ?>" style="width:152px;" readonly="readonly"/>
    							<select name="cmbStatus" class="category_box" >
                    				<option value="Not_Set">Not Set</option>
    								<option value="Available">Available</option>
        							<option value="Sold Out">Sold Out</option>
    							</select>
                   		 </div>
                   
                		<div class="mt-4">
                	
                        	<button type="submit" name="btnPUpdate" class=" btn btn-success btnproductUpdate_Delete">Update</button>
                        	<button type="submit" name="btnDelete" class=" btn btn-danger ml-4  btnproductUpdate_Delete">Delete</button>
                    	</div>
                	</div>
               
            		</div>
       
        		</div>
        
      		</div>
      
    	</div>
    </form>
  </div>
  </div> 

                      
            
 <?php 
		   
	} 
	    
 ?> 
    
 </div>

</span>



<!-- Add Product -->  


<span <?php if(isset($_POST['btnAddproducts']) || isset($_POST['AddProduct']) ){ ?> 
		style="display:block"<?php }else{?> style="display:none" <?php } ?>>



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
            	<label class=" flb">Choose product Image (400 x 400)</label>
                </div>
				<input type="file" name="product_Image" class="pfile_uploadBox" accept="image/*" onchange="showPreview(event);"/>
								
			</div>
            
            <div class="feild">
            	<div>
            	<label class=" flb">product Name</label>
                </div>
				<input type="text" class="p_input" name="txtProductName" required="required" placeholder="Product Name" value="<?php echo 
				$p_name; ?>" maxlength="50"/>
								
			</div>
            
            <div class="feild">
            	
                <div>
            	<label class=" flb">Price</label>
                </div>
            	
				<input type="text" class="p_input" name="txtProductPrice" required="required" placeholder="Price" value="<?php echo $p_price; 
				?>"  maxlength="10" 
                onkeypress="isInputNumber(event)" />
								
			</div> 
            
            <div class="feild">
            
            	<div>
            		<label class=" flb">Category</label>
             	</div>
            	
				<select name="cmbPCategory" class="p_categoryBox" >
                    	<option value="Not_Set">Not Set</option>
    					<option value="beverages">beverages</option>
        				<option value="FoodsCare">FoodsCare</option>
        				<option value="meat">meat</option>
        				<option value="Frozen">Frozen</option>
    				</select>
								
			</div>
            
            <div class="feild">
            	<div>
            	<label class=" flb">Description</label>
                </div>
				<textarea type="text" class="p_textarea" name="txtDescription"  
                placeholder="Description"><?php echo $description; ?></textarea>				
			</div>      
            
            <div class="feild mb-4 mt-5" align="center">
            
            	<button type="submit" class="btn btn-danger" name="AddProduct" style="height:45px;width:100%; font-weight:500">
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