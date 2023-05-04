
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>About</title>

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


	$Home = "";
	$Products = "";
	$styles = "";
	$about = "active";
	$page = "";
	$contact = "";



?>






<!-- Page Preloder -->
<div id="preloder">
        <div class="loader"></div>
</div>

<div style="padding-bottom:100px">
<?php include('Nav_Bar.php');?>
</div>


 <!--  Start about us-->
<div class="container" style="background:url(img/about_background.jpg)">

	 <div class="row pt-5">
    	<div class="heading-title text-center col-lg-7" >
			<h2>ABOUT US</h2>
			
		</div>
    
    </div>
    
	<div class="row">
    
    
        <div class="col-lg-7 col-md-6"  align="justify">
        	<p>Our staff wants to make sure that you get best possible experience, greeting every customer with a smile. We strive to provide 		
            a pleasurable atmosphere and encourage you to give us feedback about your experience. At Cute Cuts Salon, we listen to our 
            customers. All of our trained technicians are state licensed, and we guarantee that you will get quality, consistent service each 
            time you visit our salon. Our face waxing is done by licensed and certified estheticians.</p>
        </div>
        
    </div>
    
    <div class="row m-auto">
    	<div class="col-lg-7  mt-3 mb-3" style="border-top:#ccc solid 1px"></div>
    </div>
    
    <div class="row mb-5 mt-4">
    	<div class="col-lg-12 m-auto text-center">
        	<h3 class="h3_VM">Vision </h3>
        	<p class="p_VM">To make your life smart through better hair.</p>
        </div>
        <div class="col-lg-12 m-auto text-center">
        	<h3 class="h3_VM mt-4">Mission</h3>
        	<p class="p_VM pb-5">To build a salon that would offer the finest services available for hair in the world.</p>
        </div>
    </div>
    
    
    
    
</div>


<!-- End About-->




<!-- Footer Section Begin -->
<?php include('Footer.php');?>
<!-- Footer Section End -->


<script src="js/jquery-3.3.1.min.js"></script> 
<script src="js/main.js"></script>

</body>
</html>