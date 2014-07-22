<?php 
try
{
	$pdo = new PDO('mysql:host = localhost; dbname = sales', 'huntera', 'pricetool123'); //sales, huntera, pricetool123 sales2 admins pMbQ2BxeJy6NLxGD
	$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo -> exec('SET NAMES "utf8"');

}

catch (PDOException $e)
{
	$output = 'Unable to connect to the database server:' . 
	$e -> getMessage();
	include 'output.html.php';
	exit();
}

try
{
	$pdo2 = new PDO('mysql:host = localhost; dbname = sales2', 'admins', 'pricetool'); //sales, huntera, pricetool123 sales2 admins pMbQ2BxeJy6NLxGD
	$pdo2 -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo2 -> exec('SET NAMES "utf8"');

}

catch (PDOException $e)
{
	$output = 'Unable to connect to the database server: ' . 
	$e -> getMessage();
	include 'output.html.php';
	exit();
}

?>