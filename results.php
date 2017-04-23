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
	<!-- Main container starts here -->
 <div class="main_wrapper">
	
	 <!-- Header starts here -->
 <div class="header_wrapper"> 
 
	<a href="index.php"><img id="logo" src="images/main1.jpg" /></a>
	<img id="banner" src="images/200.gif" />
	</div>
	<!-- Header ends here -->
	
	<!-- Navigator bar starts here -->
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
	<!-- Navigator bar ends here -->
	
	<!-- Content wrapper starts here -->
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
			
			Добро пожаловать Гость! <b style="color:yellow">Корзина: </b>Всего товаров: Общая стоимость: <a href="cart.php" style="color:yellow">Перейти в корзину</a>
			
			
			
			</span>
		
		</div>
		
		
		<div id="products_box">
	<?php
		
		if(isset($_GET['search'])){
			
		$search_query = $_GET['user_query'];
		
	$get_pro = "select * from products where product_keywords like '%$search_query%'";
	
	$run_pro = mysqli_query($con, $get_pro);
	
	while($row_pro=mysqli_fetch_array($run_pro)){
		
		$pro_id = $row_pro['product_id'];
		$pro_cat = $row_pro['product_cat'];
		$pro_brand = $row_pro['product_brand'];
		$pro_title = $row_pro['product_title'];
		$pro_price = $row_pro['product_price'];		
		$pro_image = $row_pro['product_image'];
		
		echo "
				<div id='single_product'>
				
					<h3>$pro_title</h3>
					
					<img src='admin_area/product_images/$pro_image' width='180' height='180'/>
					
					<p><b>  $pro_price руб.</b></p>
					
					<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
					
					<a href='index.php?pro_id=$pro_id'><button style='float:right'>ADD</button></a>
				
				</div>
		
		";
	}
	}
   ?>
   
   </div>
   </div>
   <!-- Content wrapper ends here -->
   
   
     <div id="footer"> 

	<h2 style="text-align:center; padding-top:30px;">&copy; TUSUR 2016 MMI</h2>


	 </div>
   </div>
    <!-- Main container ends here -->
 </body>
</html>