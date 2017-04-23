<?php

$con = mysqli_connect("localhost", "root", "", "ecommerce");

if (mysqli_connect_errno())
{
	echo "Нет подключения к MySQL: " . mysqli_connect_error();
}

?>