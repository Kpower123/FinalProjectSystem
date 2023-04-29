<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Cart</title>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

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

include('db_Connection.php');


include('Cart.php');

$Home = "";
$Products = "";
$styles = "";
$about = "";
$page = "";
$contact = "";



?>


<!-- Page Preloder -->
<div id="preloder">
        <div class="loader"></div>
</div>



<div style="padding-bottom:100px">
<?php include('Nav_Bar.php');


if(isset($_POST['btnContinueCart'])){
	
?>	
<script> 
  		location.replace("Products.php")		
</script>	
<?php	
}





?>
</div>

<div class="container">
<div class="row" align="center">
   <div class="col-lg-12 m-auto">
       <h2 class="mt-5 mb-1">Shop Cart</h2>
   </div>
</div>
</div>

  
 <!-- Shop Cart Section Begin -->
    <section class="shop-cart spad">
        <div class="container pb-5" style="border-bottom:solid 1px #CCC">
        <?php
   			if(!empty($_SESSION['cart'])){
	  		$subtotal=0; 
	 	?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop__cart__table">
                        <table class="m-auto">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Sub Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                             <?php
							 		$total =0;
	   								foreach($_SESSION['cart'] as $key => $value){
		 					 ?>
                             <form action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $value['id'];?>" method="post">
                                <tr>
                                    <td class="cart__product__item" align="left">
                                        <img src="<?php echo $value['productImage'];?>" alt="" width="120" height="120" style="
                                        -webkit-box-shadow: 0px 5px 8px #333333; margin-left:5px;">
                                        <div class="cart__product__item__title" style="width:100%">
                                            <h6><?php echo $value['name']; ?></h6>
                                        </div>
                                        <div class="cart__item_corde">
                                        	Item Corde : <?php echo $value['id']; ?>
                                        </div>
                                    </td>
                                    <td class="cart__price">Rs.<?php echo $value['price'];?>.0</td>
                                    <td class="cart__quantity">
                                        <div class="pro-qty">
                                            <?php echo $value['qty']; ?>
                                        </div>
                                    </td>
                                    <td class="cart__subtotal">
                                    	Rs.<?php echo $value['price']* $value['qty'];?>.0
                                           
                                    </td>
                                    <td class="cart__close">
                                    	<button type="submit" name="btnRemove" class="iconn_close" style="outline:none">
											<svg width="25px" height="25px"viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns=
											"http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 
											7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 
											2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        </button>
                                    </td>
                                    <?php 
										$total = $total +($value['price']* $value['qty']);
										$_SESSION['total']=$total;
		 							 	$subtotal=0; 
		 						    ?>
                                </tr>
                                </form>
                                <?php 
								  }
								?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
            	
                
                
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn">
                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                        <button class="cancel_btn mt-4 ml-2" name="btnCancelCart">Cart Cancel</button>
                        <button class="continue_btn mt-4 ml-2" name="btnContinueCart">Continue Shopping</button>
                    </div>
                </div>
                
                <div class="col-lg-4 offset-lg-2">
                    <div class="cart__total__procced">
                        <h6 align="center" style="padding:10px 0px 10px 0px; background-color:#303; color:#FFF">Cart total</h6>
                        <ul>
                            <li>Total <span>Rs.<?php echo $total;?>.0</span>
                            	<input type="hidden" name="txtTotal" value="<?php echo $_SESSION['total']; ?>" />
                            </li>
                        </ul>
                        <div al align="center">
                        <button name="btnCheckOut" class="primary-btn">Proceed to checkout</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
             
        <?php

   		}
  		 else{
		?>	
    		<div class="row" align="center">
            	<div class="col-lg-12">
                <div style="height:300px; width:400px; background-color:#FCC; padding-top:50px; border-radius:25px">
                	<span style="color:#333"><svg cowidth="6em" height="6em" viewBox="0 0 16 16" class="bi bi-exclamation-circle" fill=
					"currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8
					0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 
					3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/></svg>
                    </span>
					<h2 class="pt-5" style="text-transform:lowercase; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; color:#333; 
                    font-weight:600">No Items are In</h2>
                </div>
                </div>
     </div>
           
	<?php
	
		}
	?>

 </div>
 
</section>
 <!-- Shop Cart Section End -->

<!-- Footer Section Begin -->
<?php include('Footer.php');?>
<!-- Footer Section End -->   
	   
	
	





<script src="js/jquery-3.3.1.min.js"></script> 
<script src="js/main.js"></script>
</body>
</html>