<!DOCTYPE>
<?php
session_start();
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
 
	<a href="index.php"><img id="logo" src="images/banner.png" /></a>
	<img id="banner" src="images/200.gif" />
	<img id="dop" src="images/Снимок1.JPG" />
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
   
   <?php cart(); ?>
		
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
		
		if(!isset($_SESSION['customer_email']))
		{
			include("customer_login.php");
		}
			else
			{
				include("payment.php");
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