<!DOCTYPE>
<?php

include("functions/functions.php");

?>
<html>
 <head>

  <title>My online shop</title>
 
 <link rel="stylesheet" href="styles/style.css" media="all"/>
 </head>
 
 <body>
	
 <div class="main_wrapper">
	

 <div class="header_wrapper"> 
 <a href="index.php"><img id="logo" src="images/banner-shop.gif" /></a>
	<img id="banner" src="images/200.gif" />
		<img id="dop" src="images/pic.jpg" />
	</div>
	
	<div class="menubar">
	<ul id="menu">
		<li><a href="index.php">Home</a></li>
		<li><a href="all_products.php">All products</a></li>
		<li><a href="customer/my_account.php">My Account</a></li>
		<li><a href="checkout.php">Sign up</a></li>
		<li><a href="cart.php">Shopping cart</a></li>
		<li><a href="contact1.php">Contact us</a></li>
	</ul>
	<div id="form">
		<form method="get" action="results.php" enctype="multipart/form-data">
			<input type="text" name="user_query" placeholder="Search a Product"/>
			<input type="submit" name="search" value="Search"/>
		</form>
	</div>
 </div>
	
	<div class="content_wrapper">
	
     <div id="slidebar">
		<div id="sidebar_tittle">Categories</div>
		<ul id="cats">		
	
		<?php getCats(); ?>
		
		<ul>
		<div id="sidebar_tittle">Brands</div>
		<ul id="cats">
		
		<?php getBrands(); ?>
		
		<ul>
		
	</div>


   <div id="content_area"> 
		
		<div id="shopping_cart">
		
			<span style="float:right; font-size:18px; padding:5px; line-height:40px;">
			
			<?php
			if(isset($_SESSION['customer_email']))
			{
				echo "<b>Welcome:</b>" . $_SESSION['customer_email'] . "<b style='color:yellow;'>Your</b>";
			}
			else
			{
				echo "<b>Welcome Guest!</b>";
			}
			
			?>	
			
				<b style="color:yellow">Cart: </b><a style="color:skyblue">Total Items: <?php total_items(); ?></a> Price: <?php total_price(); ?><a href="cart.php" style="color:yellow">Go to cart</a>
			
			<?php
			if(!isset($_SESSION['customer_email']))
			{
				
				echo "<a href='checkout.php' style='color:red;'>Login</a>";
				
			}
			else
			{
				echo "<a href='logout.php' style='color:red;'>Logout</a>";
			}		
			
			?>
			
			
			
			</span>
		
		</div>
		
		
		<div id="products_box">
<?php
		if(isset($_GET['pro_id'])){			
		$product_id = $_GET['pro_id'];
		
$get_pro = "select * from products where product_id='$product_id'";
	
$run_pro = mysqli_query($con, $get_pro);
	
	while($row_pro=mysqli_fetch_array($run_pro)){
		
		$pro_id = $row_pro['product_id'];
		$pro_title = $row_pro['product_title'];
		$pro_price = $row_pro['product_price'];		
		$pro_image = $row_pro['product_image'];
		$pro_desc = $row_pro['product_desc'];
		
		echo "
				<div id='single_product'>
				
					<h3>$pro_title</h3>
					
					<img src='admin_area/product_images/$pro_image' width='400' height='300'/>
					
					<p><b>  $pro_price руб.</b></p>
					<p>$pro_desc </p>
					
					<a href='index.php' style='float:left;'>Go Back</a>
					
					<a href='index.php?add_cart=$pro_id'><button style='float:right'>ADD</button></a>
				
				</div>
		
		";
	}
		}
?>
   
   </div>
   </div>  
   
   
     <div id="footer"> 

	<h2 style="text-align:center; padding-top:30px;">&copy; TUSUR 2016 MMI</h2>


	 </div>
   </div>    
 </body>
</html>