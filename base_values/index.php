<?php

include '../dblogin.php';
$page = substr($_SERVER['REQUEST_URI'], -1);
$reredirect = 0;
if ($page == "?")
{
	header("Location: redirect");
	$reredirect = 1;
}
/*if ($reredirect == 1)
{
	header("Location: ../base_values");
	$reredirect = 0;
}*/

$mbps = array(10,20,30,40,50,100);
$unset = 0;
include 'form.html.php';
if (!empty($_POST))
{
	foreach($_POST as $p)
	{
		if (empty($p))
		{
			$unset = 1;
		}
	}	
}
//echo "<br><br><br><br>";
//echo "<br> POST: ";
//print_r($_POST);


if ($unset == 0)
{
	$sql = 'INSERT INTO sales.base_value SET ';
	$baseinsert = array();
	foreach ($tablekeys as $key)
		{	
			
			if ( substr($key, -7) != 'Base_ID' && substr($key, -12) !='Last_Updated')
			{
				$sql .= $key.' = :'.$key.', ';
				$baseinsert[] = $key;
			}
		}

	//echo "<br><br> KEYS";
	//print_r($baseinsert);
	$sql = rtrim($sql, ", ");
	//print_r($bandwidths);
	if (!empty($_POST))
	{
		foreach ($mbps as $b)
		{
			try
			{	echo $b;
		        $s = $pdo -> prepare($sql);
		        foreach ($baseinsert as $colname)
		        {
		        	$s -> bindValue(':'.$colname, $_POST[$b.$colname]);
		        }
		        $s -> execute();
		        $output = 'Table updated successfully.';
		        //include 'output.html.php';
			}

		    catch (PDOException $e)
		    {
		        $output = 'Error updating '.$key. ' or '.$colname.' field of base_values table:' . $e->getMessage();
		        include'output.html.php';
		        echo $sql;
		        exit();
		    }
		}
	}
}

?>