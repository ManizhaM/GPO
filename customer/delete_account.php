
<br>

<h2 style="text-align:center; color:red;">Do you really want to DELETE your account?</h2>
<form action="" method="post">

<br>
<input type="submit" name="yes" value="Yes I will delete!!!"/>
<input type="submit" name="no" value="No I am just joking!!!"/>


</form>

<?php
include("includes/db.php");

	$user = $_SESSION['customer_email'];
	
	if(isset($_POST['yes']))
	{
		$delete_customer = "delete from customers where customer_email='$user'";
		
		$run_customer = mysqli_query($con, $delete_customer);
		
		echo "<script>alert('Your account has been deleted, bye my dear friend!')</script>";
		echo "<script>window.open('../index.php', '_self')</script>";
	}
	if(isset($_POST['no']))
	{
		echo "<script>alert('It is so pity that you take us alone!')</script>";
		echo "<script>window.open('my_account.php', '_self')</script>";
	}

?>