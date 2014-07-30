<?php

include '../../dblogin.php';

$bandwidths = array(10,20,30,40,50,100);
//print_r($_GET);

$staffid = 1;

if (!empty($_REQUEST['reviewsub']))
{
	//print_r($_REQUEST);
	include 'submission.php';
}


try 		
{					
	
	$servicequery = 'SELECT id, strfibreservice FROM sales2.fbr_service';
	$stmt = $pdo2->query($servicequery);
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
}


catch (PDOException $e)
	{
        $output = 'Error getting pricing info:' . $e->getMessage();
        include'output.html.php';
        exit();
    }


$serviceid = array();
print_r($_REQUEST);

while ($temp = $stmt->fetch())
{
	$serviceid[] = 'i'.$temp['id'];
	$servicename[] = $temp['strfibreservice'];
}
$servicearray = array_combine($serviceid, $servicename);




try
{
	$sql = 'SELECT * FROM sales2.cnv_account';
	$stmt = $pdo2 -> query($sql);
	$result = $stmt -> setFetchMode(PDO::FETCH_ASSOC);
}

catch(PDOException $e)
{
	$output = 'Error getting account info: '. $e->getMessge();
	include "output.html.php";
	exit();
}

$accname = array();
$accid = array();

while ($temp = $stmt->fetch())
{
	$accid[] = $temp['intaccountid'];
	$accname[] = $temp['straccount'];
}
$accounts = array_combine($accid, $accname);
//print_r($_GET);



include 'tablereturn.php';
/*if (!empty($indices) && $duplicate == 0)
{
	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=LES_Prices_Table.doc");
}*/
include 'form.html.php';

