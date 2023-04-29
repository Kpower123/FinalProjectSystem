
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin_Index</title>
    
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



// logout 
if(isset($_POST['btnLogout'])){

	?>
    <script>
    
    	location.replace("../index.php")
    
    </script>
    <?php 

}




// loging message 
if(isset($_SESSION['LoginMsg'])){
	
	?>	
    
		<script> swal("<?php echo $_SESSION['LoginMsg'];?>", "Press Ok", "success");</script>
        
	<?php
		
	unset($_SESSION['LoginMsg']);
	
}








// home slider change 
if(isset($_POST['btnSliderChange'])){
	
	if(!empty($_FILES['sliderImage']['name'])){
			
		$temp_image = $_FILES['sliderImage']['tmp_name'];
		$imageName  = $_FILES['sliderImage']['name'];
			
		$ext = explode(".",$imageName);
		$extType = array("jpg","png","gif","jpeg");
			
			if(in_array($ext[1],$extType)){
				
				$image_base64 = base64_encode(file_get_contents($temp_image));
				$image = "data:image/;base64,".$image_base64;
				
				$sql = "UPDATE `home_slider` SET `slider_img`='".$image."' where slider_id = ".$_GET['id']."";
						
				if(mysqli_query($con,$sql)){
						
				?>	
					<script> swal("Slider Image Has Changed!", "Press Ok", "success");</script>
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
	?>
            
       <script> swal("Please Choose a Image", "Press Ok", "warning");</script>
            
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
    	<li><a href="#"><button type="submit" name="btnLogout" style="border:none; background:none; outline:none">
    	<i class="fas fa-sign-out-alt"></i>Log Out</button></a></li>
   	</form>
  </ul>
  
</div>



<div class="container" style="margin-left:250px; padding-right:50px">

	<div class="row top_slideBar mb-5" align="right" >
    
    	<table class="table table-borderless" style="margin-top:12px;">
        	<tr>
            	<td>
                	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                		<input type="text" name="txtProductSearch" placeholder="Search" required />
            			<button type="submit" name="btnProductSearch">Search</button>
                    </form>
                </td>
                
                <td align="right">
                
                	<h2>Dashboard</h2>
                </td>
              
            
            </tr>
        
        
        
        </table>
    
    </div>

</div>

<!-- dashborad content -->

<div class="container" style="margin-left:260px; padding-right:60px; padding-top:100px">
 	
   
    <div class="row">
    		
    		<!-- Start Slider -->

	<div class="carousel slide" data-ride="carousel" id="carouseledemo" data-interval="5000">

		<ol class="carousel-indicators">
			<li data-target="#carouseledemo" data-slide-to="0" class="active"></li>
    		<li data-target="#carouseledemo" data-slide-to="1"></li>
			<li data-target="#carouseledemo" data-slide-to="2"></li>
	
		</ol>
		<div class="carousel-inner">
    	
    
    		<div class="carousel-item active">
        	<?php 
		
			$sql = "select * from home_slider where slider_id = 1 ";
		
			$result =mysqli_query($con,$sql);
		
			if($row= mysqli_fetch_row($result)){
			
		
			?>
        		<img src="<?php echo $row[1];?>" class="d-block w-100 img-fluid "/>
            
      		<?php
		
			}
			
			?>
            	<div class="carousel-caption d-none d-md-block row m-auto" align="center">
            
            		<button type="button" class="btn btn-danger" style="font-size:20px; margin-bottom:40px; padding:20px 60px 20px 60px;" 
                		data-toggle="modal" data-target="#slider_1">
                		Change
               		</button>
            	
            	</div>
          
            
        	</div>
        
       
        
    		<div class="carousel-item">
        
        	<?php 
		
			$sql = "select * from home_slider where slider_id = 2 ";
		
			$result =mysqli_query($con,$sql);
		
			if($row= mysqli_fetch_row($result)){
		
			?>
        		<img src="<?php echo $row[1];?>" class="d-block w-100 img-fluid"/>
                
        	<?php
		
			}
			
			?>   
            	<div class="carousel-caption d-none d-md-block row m-auto" align="center">
            
            		<button class="btn btn-danger" style="font-size:20px; margin-bottom:40px; padding:20px 60px 20px 60px;" data-toggle=
                    "modal" data-target="#slider_2">
                	Change
               		</button>
            	
            	</div>
            
        	</div>
            
            
        
        	<div class="carousel-item">
       	 	<?php 
		
			$sql = "select * from home_slider where slider_id = 3 ";
		
			$result =mysqli_query($con,$sql);
		
			if($row= mysqli_fetch_row($result)){
			?>
        		<img src="<?php echo $row[1];?>" class="d-block w-100 img-fluid"/> 
            
        	<?php
		
			}
			
			?>   
            
        		<div class="carousel-caption d-none d-md-block">
            
        			<button class="btn btn-danger" style="font-size:20px; margin-bottom:40px; padding:20px 60px 20px 60px;" data-toggle=
                    "modal" data-target="#slider_3">
                		Change
               		</button>
                
            	</div>
    
        	</div>
    
    
    		<div class="slide-btn">
   				<a class="carousel-control-prev"role="button" data-slide="prev" href="#carouseledemo">
   					<span class=" carousel-control-prev-icon" aria-hidden="true"</span>
   					<span class="sr-only">Previous</span>
  				</a> 
   
   				<a class="carousel-control-next" role="button" data-slide="next" href="#carouseledemo">
  					<span class=" carousel-control-next-icon" aria-hidden="true"</span>
   					<span class="sr-only">Next</span>
   				</a> 
  	    	</div>
       
		</div>
        
	</div>
  
<!-- End Slider -->



<!-- slider 1   -->

	<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="slider_1">
        
  		<div class="modal-dialog modal-lg">
    		<div class="modal-content">
             	<div class="modal-header" style="background:#C03 ;color:#FFF;">
        			<h5 class="modal-title" style="padding-left:15px;">Slider 01</h5>
        			<button type="button" class="close close_btn" data-dismiss="modal" aria-label="Close" style="outline:none;color:
                    #FFF"><span aria-hidden="true">&times;</span>
        			</button>
      			</div>
                <div class="modal-body" style="background:#f5f5f5">
                   
                   <div class="container">
                    
                    	<div class="row">
                        	<div class="col-lg-12 m-auto" align="center">
        
        						<span class="preview feild">
            						<img id="file-ip-1-preview" class="img-fluid"/>
    							</span>
    
    						</div>
                            
                            <div class="col-lg-4 col-md-8 col-sm-12 m-auto" align="center">
                            	
                                <div class="felid mt-3 mb-3">
            						<form action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo 1;?>" method="post" enctype=
                                    "multipart/form-data">
            						<label class=" mb-3">Choose a Image (1920 x 750)</label>
									<input type="file" name="sliderImage" class="file_uploadBox" accept="image/*" onchange=
                                    "showPreview(event);"/>
                                    
								
								</div>
                                
                                	<button type="submit" name="btnSliderChange" class="btn btn-danger mt-4 mb-3" style="font-size:20px; 
                                    padding:
                                    10px 60px 10px 60px;">		 												
                                    Change
               						</button>
                                	</form>
                               
                            
                            </div>
                        
                        </div>
                 
                    </div>
                    
                </div>
                    
    	  </div>
                
 		</div>
        
	</div>
            


<!-- slider 2   -->

	<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="slider_2">
        
  		<div class="modal-dialog modal-lg">
    		<div class="modal-content">
             	<div class="modal-header" style="background:#C03 ;color:#FFF;">
        			<h5 class="modal-title" style="padding-left:15px;">Slider 02</h5>
        			<button type="button" class="close close_btn" data-dismiss="modal" aria-label="Close" style="outline:none;color:
                     #FFF"><span aria-hidden="true">&times;</span>
        			</button>
      			</div>
                <div class="modal-body" style="background:#f5f5f5">
                    	
               		<div class="container">
                    
                    	<div class="row">
                        	<div class="col-lg-12 m-auto" align="center">
        
        						<span class="preview feild">
            						<img id="file-ip-1-preview" class="img-fluid"/>
    							</span>
    
    						</div>
                            
                            <div class="col-lg-4 col-md-8 col-sm-12 m-auto" align="center">
                            	
                                <div class="felid mt-3 mb-3">
            						<form action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo 2;?>" method="post" enctype=
                                    "multipart/form-data">
            						<label class="mb-3">Choose a Image (1920 x 750)</label>
									<input type="file" name="sliderImage" class="file_uploadBox" accept="image/*" onchange=
                                    "showPreview(event);"/>
                                    
								
								</div>
                                
                                	<button type="submit" name="btnSliderChange" class="btn btn-danger mt-4 mb-3" style="font-size:20px; 
                                    padding:
                                    10px 60px 10px 60px;">		 												
                                    Change
               						</button>
                                	</form>
                               
                            
                            </div>
                        
                        </div>
                 
                    </div>
                </div>
                    
    	  </div>
                
 		</div>
        
	</div>




<!-- slider 3   -->

	<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="slider_3">
        
  		<div class="modal-dialog modal-lg">
    		<div class="modal-content">
             	<div class="modal-header" style="background:#C03 ;color:#FFF;">
        			<h5 class="modal-title" style="padding-left:15px;">Slider 03</h5>
        			<button type="button" class="close close_btn" data-dismiss="modal" aria-label="Close" style="outline:none;color:
                     #FFF"><span aria-hidden="true">&times;</span>
        			</button>
      			</div>
                <div class="modal-body" style="background:#f5f5f5">
                
                    <div class="container">
                    
                    	<div class="row">
                        	<div class="col-lg-12 m-auto" align="center">
        
        						<span class="preview feild">
            						<img id="file-ip-1-preview" class="img-fluid"/>
    							</span>
    
    						</div>
                            
                            <div class="col-lg-4 col-md-8 col-sm-12 m-auto" align="center">
                            	
                                <div class="felid mt-3 mb-3">
            						<form action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo 3;?>" method="post" enctype=
                                    "multipart/form-data">
            						<label class="  mb-3">Choose a Image (1920 x 750)</label>
									<input type="file" name="sliderImage" class="file_uploadBox" accept="image/*" onchange=
                                    "showPreview(event);"/>
                                    
								
								</div>
                                
                                	<button type="submit" name="btnSliderChange" class="btn btn-danger mt-4 mb-3" style="font-size:20px; 
                                    padding:
                                    10px 60px 10px 60px;">		 												
                                    Change
               						</button>
                                	</form>
                               
                            
                            </div>
                        
                        </div>
                 
                    </div>
                </div>
                    
    	  </div>
                
 		</div>
        
	</div>






    
    </div>
           
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
