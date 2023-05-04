<!-- Style CSS -->
<link rel="stylesheet" href="css/ss.css">

<?php 

//include('Cart.php');

include('My_Account.php');

//go to sing in page 
if(isset($_POST['btnSingIn'])){
?>

<script> 
  		location.replace("Login.php")		
</script>

<?php	
		
}


?>
<!-- Strat Nav-Bar -->

<header class="top-navbar container-fluid">
<nav class="navbar navbar-expand-lg navbar-light row m-auto" role="navigation">

			
        	
				<a class="navbar-brand" href="index.php">
					<img src="img/Logo.png" height="75" width="auto" id="nav_logo"/>
            	</a>
                
                <button class="navbar-toggler ml-5" data-toggle="collapse" aria-expanded="false" data-target="#contentID" id="navbar-toggler">
            	<span class="navbar-toggler-icon"></span> </button>	
           		
			<div class="col-lg-1  m-auto"></div>
            
			
            
			<span class="collapse navbar-collapse nav-right-side col-lg-9" id="contentID">

			<div class="col-lg-7  m-auto" align="center">
				<ul class="navbar-nav">

					<li class="nav-item border-bottom-0 nav-item <?php echo $Home; ?>" id="nav_tabs">
    					<a class="nav-link nav-link " href="index.php">Home</a>
    				</li>
    
					<li class="nav-item border-bottom-0 nav-item <?php echo $Products; ?>" id="nav_tabs">
    					<a class="nav-link nav-link" href="Products.php">Products</a>
    				</li >
    
					<li class="nav-item border-bottom-0 nav-item <?php echo $about; ?>" id="nav_tabs">
    					<a class="nav-link nav-link" href="About_Page.php">About</a>
        			</li>
        			
    				<li class="nav-item dropdown border-bottom-0 nav-item <?php echo $page; ?>"  id="nav_tabs">
    					<a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="My_Orders_Page.php">My Orders</a>
                              <a class="dropdown-item" href="Cart_Page.php">Shop Cart</a>
                         </div>
    				</li>
    
   		 			<li class="nav-item border-bottom-0 nav-item <?php echo $contact;?>"  id="nav_tabs">
    					<a class="nav-link nav-link" href="Contact_Page.php">Contact</a>
    				</li>
                    
				</ul>
			</div>
            
            <div class="col-lg-6 m-auto">
            	<ul class="navbar-nav">
                	
                	<li  class="nav-item border-bottom-0" style="margin:auto">
                    <a href="Cart_Page.php" style="color:#333">
                    <svg width="40px" height="40px" viewBox="0 0 16 16" class="bi bi-cart4" fill="currentColor" xmlns=
					"http://www.w3.org/2000/svg">
  					<path fill-rule="evenodd" d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 
					1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 
					0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 
					1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
					</svg></a>
                        
                        
					<?php 
						if (isset($_SESSION['items'])) {
					?>
	 					<span style="font-weight:600; color:#FFF;background-color:#C03;padding-left:9px;padding-right:9px; padding-bottom:3px;
                        border-radius:100%;"> <?php echo $_SESSION['items']?></span>
                        
      				<?php 
					
						}
						
					?> 
                         
                    </li>

					<li class="nav-item border-bottom-0" style="margin:30px 15px 30px 15px" >
                    	
						<?php if (isset($_SESSION['user_details'])) {  ?>
							<form action="imgocr.php" method="post" enctype="multipart/form-data">
								<input class="btn btn-warning" style="font-weight:600;  border-radius:30px;" type="file" name="fileToUpload" id="fileToUpload"> 
								<button class="btn btn-warning" style="font-weight:600;  border-radius:30px;" type="submit" >
									Submit</button>
							</form>

						<?php
						
						}
						
						?>
                        </span>
                    </li>
                    
                    <li class="nav-item border-bottom-0" style="margin:30px 50px 30px 15px" >
                    	
						<?php if (isset($_SESSION['user_details'])) {  ?>
						
                        	<button class="btn btn-success" data-toggle="modal" data-target="#My_Account" 
                            	style="font-weight:600;  border-radius:30px;">My Account</button>
						<?php
						
						}
						else{
						?>
                        	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                            	<button type="submit" class="btn btn-danger" name="btnSingIn" 
                            	style="font-weight:600; padding-left:25px; padding-right:25px; border-radius:30px;">Sign In</button>
                            </form>
						<?php
						
						} 
						
						?>
                        </span>
                    </li>
                
                </ul>
            
            </div>
              
	</span>                    
	
</nav>

</header>



