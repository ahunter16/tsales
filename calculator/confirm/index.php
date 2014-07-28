<?php

include '../../dblogin.php';

$margins = array("l", "m", "h");
$supps = array("ttb", "bts", "btp", "ead", "spd");
//print_r($_GET);
$duplicate = 0;

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
 print_r($_POST);

while ($temp = $stmt->fetch())
{
	$serviceid[] = 'i'.$temp['id'];
	$servicename[] = $temp['strfibreservice'];
}
$servicearray = array_combine($serviceid, $servicename);
foreach ($serviceid as $s)
{	
	global $margins;

	foreach ($margins as $m)
	{
		if (!empty($_POST[$s.$m]))
		{	
			if (!empty($indices))
			{	
				foreach ($indices as $in)
				{	
					$hist = substr($in, 0, -1);

					if ($hist == $s)
					{
						$duplicate = 1;
					}			
				}

				if ($duplicate != 1)
				{
					$indices[] = $s.$m;
				}
			}
			else
			{
				$indices[] = $s.$m;
			}
		}

	}
}
//print_r($_GET);
include 'tablereturn.php';
if (!empty($indices) && $duplicate == 0)
{
	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=LES_Prices_Table.doc");
}
include 'form.html.php';

