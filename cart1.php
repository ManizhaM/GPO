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
	<!-- Main container starts here -->
 <div class="main_wrapper">
	
	 <!-- Header starts here -->
 <div class="header_wrapper"> 
 
	<a href="index.php"><img id="logo" src="images/main1.jpg" /></a>
	<img id="banner" src="images/200.gif" />
	<img id="dop" src="images/Снимок1.JPG" />
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
   
   <?php cart(); ?>
		
		<div id="shopping_cart">
		
			<span style="float:right; font-size:17px; padding:5px; line-height:40px;">
			
			<?php
			if(isset($_SESSION['customer_email']))
			{
				echo "<b>Welcome:</b>" . $_SESSION['customer_email'] . "<b style='color:yellow;'>Ваша</b>";
			}
			else
			{
				echo "<b>Welcome Guest!</b>";
			}
			
			?>				


			<b style="color:yellow">Корзина: </b>Всего товаров: <?php total_items(); ?> Цена: <?php total_price(); ?><a href="index.php" style="color:yellow">Назад в магазин</a>
			
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
		
	<form action="" method="post" enctype="multipart/form-data">
		<table align="center" width="700" bgcolor="#bfa0be">
		
			
			<tr align="center">
					<th>Удалить</th>
					<th>Товар(ы)</th>
					<th>Количество</th>
					<th>Общая стоимость</th>
			</tr>
	<?php
			
	$total = 0;
		
		global $con;
		$ip = getIp();
		$sel_price = "select * from cart where ip_add='$ip'";
		
		$run_price = mysqli_query($con, $sel_price);
		while($p_price=mysqli_fetch_array($run_price)){
			
			
			$pro_id = $p_price['p_id'];
			
			$pro_price = "select * from products where product_id='$pro_id'";
			
			$run_pro_price = mysqli_query($con, $pro_price);
			
			while($pp_price = mysqli_fetch_array($run_pro_price)){
				
			$product_price = array($pp_price['product_price']);
			
			$product_title = $pp_price['product_title'];
			
			$product_image = $pp_price['product_image'];
			
			$single_price = $pp_price['product_price'];
			
			$values = array_sum($product_price);
			
			$total +=$values;
									
			
	?>
		<tr align="center">
			<td><input type="checkbox" name="remove[]"value="<?php echo $pro_id; ?>"/></td>
			<td><?php echo $product_title; ?><br><img src="admin_area/product_images/<?php echo $product_image; ?>" width="60" height="60"/></td>
			<td><input type="text" size="4" name="qty" value="<?php echo $_SESSION['qty']; ?>" /></td>
			<!-- редактируем количество ..начало -->
			<?php
			
			if(isset($_POST['update_cart']))
			{
				$qty = $_POST['qty'];
				
				$update_qty = "update cart set qty='$qty'";
				
				$run_qty = mysqli_query($con, $update_qty);
				
				$_SESSION['qty'] = $qty;
				
				$total = $total*$qty;
			}
			
			
			?>	
			
			
			<td><?php echo $single_price . " руб."; ?></td>
		</tr>			
		
		<?php }} ?>
		
		<tr>
			<td colspan="4" align="right"><b>Промежуточный итог</b></td>
			<td><?php echo $total . "руб";?></td>
		</tr>
		
		<tr align="center">
			<td><input type="submit" name="update_cart" value="Update cart" /></td>			
			<td><button><a href="index.php" style="text-decoration:none; color:black;">Continue shopping</a></button></td>
			<td><button><a href="checkout.php" style="text-decoration:none; color:black;">Checkout</a></button></td>
		</tr>
		
		
		</table>
	</form>
   
  <?php 
  
  function updatecart()
  {
	global $con;
	$ip = getIp();
	
	if(isset($_POST['update_cart']))
	{		
		foreach($_POST['remove'] as $remove_id)
		{
			$delete_product = "delete from cart where p_id='$remove_id' AND ip_add='$ip'";
			$run_delete = mysqli_query($con, $delete_product);
			if ($run_delete)
			{				
				echo "<script>window.open('cart.php','_self')</script>";				
			}
			
		}
		
		
	}
	if (isset($_POST['continue']))// при нажатии на кнопку продолжить покупку переходит на главную страницу
	{
	echo "<script>window.open('index.php','_self')</script>";
	}	

  }  
  echo @$up_cart = updatecart(); //не будет генерировать ошибку без выбора удаления продукта	
  ?>
   
   </div>
   </div>
   <!-- Content wrapper ends here -->
   
   
     <div id="footer"> 

	<h2 style="text-align:center; padding-top:30px;">&copy; TUSUR 2016 by Mirzoeva Manizha</h2>


	 </div>
   </div>
    <!-- Main container ends here -->
 </body>
</html>