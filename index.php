<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Page</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

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


include('db_Connection.php');?>


<?php 

	$Home = "active";
	$Products = "";
	$styles = "";
	$about = "";
	$page = "";
	$contact = "";






// view login Message 
if(isset($_SESSION['LoginMsg'])){
	
	?>	
    
		<script> swal("<?php echo $_SESSION['LoginMsg'];?>", "Press Ok", "success");</script>
        
	<?php
		
	unset($_SESSION['LoginMsg']);
	
}


	
	if(isset($_POST['btnAdd'])){
		
		
		
		$id = $_POST['txtID'];
		
		$temp_image = $_FILES['productImage']['tmp_name'];
		$imageName = $_FILES['productImage']['name'];
	
		$ext = explode(".",$imageName);
		$extType = array("jpg","png","gif","jpeg");
		
		if(in_array($ext[1],$extType)){
			
			$image_base64 = base64_encode(file_get_contents($temp_image));
			$image = "data:image/;base64,".$image_base64;
			
			$Sql = "INSERT INTO home_slider VALUES('".$id."','".$image."')";
			
			
			if(mysqli_query($con,$Sql)){
				
				$msg = "<p>Slider Inserted!<p/>";
			}
			
			
		}else{
			
			echo "<p>Error : ". mysqli_error($con)."</p>";	
			
		}
		
		
		
		
	}




?>

<!-- Page Preloder -->
<div id="preloder">
        <div class="loader"></div>
</div>


<!-- nav bar -->
<div style="padding-bottom:100px">
<?php include('Nav_Bar.php');?>
</div>



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
            
            <div class="carousel-caption d-none d-md-block row">
            	<div class="col">
            		
                </div>
          
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
            
            	<a href="CreateAccount.php"><button class="btn btn-danger" style="font-size:20px;font-weight:700; margin-bottom:40px; padding:
                20px 60px 20px 60px;">Join with Us</button></a>
            	
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
        		<a href="My_Reservation.php"><button class="btn btn-outline-dark" style="font-size:20px;font-weight:700;margin-left:55%; 
                padding:20px 60px 20px 60px;">View</button></a>
                
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

<!-- Footer Section Begin -->
<?php include('Footer.php');?>
<!-- Footer Section End -->




<script src="js/jquery-3.3.1.min.js"></script> 
<script src="js/main.js"></script>
</body>
</html>