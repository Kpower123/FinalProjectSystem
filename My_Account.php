


<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<?php 



// logout 

if(isset($_POST['btnLogOut'])){
	
	unset($_SESSION['user_details']);
	unset($_SESSION['order_details']);
	unset($_SESSION['booking_details']);
	
	?>
    <script> 
  		location.replace("index.php")		
	</script>
	
	<?php
	
}


// edite account
if(isset($_POST['btnEditAccount'])){
	?>
	<script> 
  		location.replace("Edit_Account.php")		
	</script>
	
<?php

}
?>




<div class="modal fade" tabindex="-1" id="My_Account">
  <div class="modal-dialog">
    <div class="modal-content" style="background-color:#f5f5f5; border-radius:0px 0px 25px 25px">
      <div class="modal-header">
        <h5 class="modal-title">My Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="border-bottom:solid #333 10px; border-top:solid #666 2px; border-radius:0px 0px 25px 25px">
      <?php
    	foreach($_SESSION['user_details'] as $key => $value){
		?>
    	<div class="container" >
        	<div class="row" align="center">
            	<div class="col-md-3 mb-1">
                	<img src="<?php echo $value['profile_img'];?>" height="130" width="130" id="nav_logo" 
                    style="border:double #FFF 5px; border-radius:50%;-webkit-box-shadow: 0px 5px 10px rgba(91, 91, 91, 0.1);
					box-shadow: 0px 5px 10px #333333;"/>
                </div>
                <div class="col-md-7 m-auto">
                	<h3 style="color:#000;"><?php echo $value['uname'];?></h3>
                    <p><?php echo $value['email'];?></p>
                    
                    <button class="btn btn-success" data-toggle="collapse" aria-expanded="false" 
                    data-target="#My_Info" style="width:100px;">More</button>
                    
                </div>
        	</div>
           
            
            
            <div class="row" align="center" style="margin-top:10px;">
            	<div class="col-md-12 collapse" id="My_Info">
            		<label>Contact : &nbsp; <?php echo $value['contact']?> </label>
           	 	</div>
                <div class="col-md-12 collapse" id="My_Info">
            		<label>Address : &ensp; <?php echo $value['address']?></label>
           	 	</div>
            </div>
            <div class="row mb-2" align="center" style="margin-top:10px;">
           
            	<div class="col-md-12 collapse" id="My_Info">
                	
                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        			<button type="submit" class="btn btn-secondary" name="btnEditAccount" style="font-weight:600">Edit Account</button>
        			<button type="submit" class="btn btn-danger" name="btnLogOut" style="font-weight:600">Log Out</button>
       				</form>
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
