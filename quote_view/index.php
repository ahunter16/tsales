<?php

include "../dblogin.php";

if (isset($_POST['statusid']))
{
	$statusid = $_POST['statusid'];
}

else
{
	$statusid = 10;
}

function statusselect()
{
	try
	{
		$sql = 'SELECT id FROM sales2.fbr_quote_status';
		$stmt = pdo2->query($sql);
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	}
	catch (PDOException $e)
		{
	        $output = 'Error getting pricing info:' . $e->getMessage();
	        include'output.html.php';
	        exit();
	    }


	while ($temp = $stmt->fetch())
	{
		$statusarray[] = $temp;
	}

	foreach ($statusarray as $st)
	{
		echo '<option value ="'.$st.'">'.$st.'</option>';
	}
}


try
{
	$sql = 'SELECT * FROM sales2.fbr_quote WHERE intquotestatusid = '.$statusid;
    $stmt = $pdo2->query($sql);
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);	
}
catch (PDOException $e)
	{
        $output = 'Error getting pricing info:' . $e->getMessage();
        include'output.html.php';
        exit();
    }

$quotes = array()

while ($temp = $stmt->fetch())
{
	$quotes[] = $temp;
}


function tablemake($quotes)
{
	foreach($quotes as $quote)
	{	echo '<tr>';
		{
			foreach($quote as $key => $col)
				echo '<td>'
		}
	}
}