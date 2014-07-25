<?php

$page = substr($_SERVER['REQUEST_URI'], -1);
$reredirect = 0;
if ($page == "?")
{
	header("Location: redirect");
	$reredirect = 1;
}
/*if ($reredirect == 1)
{
	header("Location: redirect");
	$redirect = 0;
	unset($_POST['savebases']);
}*/

include '../dblogin.php';
include 'tablereturn.php';
include 'baserow.php';
include 'formula.php';	


try 			//CHANGE: to use new database; change QUERY and following statements for shorthands
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
    while ($temp = $stmt->fetch())
    {	

		$serviceid[] = 'i'.$temp['id'];
		$servicename[] = $temp['strfibreservice'];
	}

//print_r($servicename);

foreach ($serviceid as $sid)
{
	if (isset($_POST[$sid]) && $_POST[$sid] != "")
	{
		$form[$sid] = $_POST[$sid.'ann'];
	}
}


$bandwidths = array(10,20,30,40,50,100);		

global $quotearray;

$basevals = array();

try 			//CHANGE: to use new database; change QUERY and following statements for shorthands
{					
	$basequery = 'SELECT * FROM sales2.fbr_template WHERE booldefault = 1';
	$stmt = $pdo2->query($basequery);
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
}

catch (PDOException $e)
{
    $output = 'Error getting pricing info:' . $e->getMessage();
    include'output.html.php';
    exit();
}

while ($temps = $stmt->fetch())
{
	$basevals = $temps;
}
$basekeys = array_keys($basevals);





foreach ($bandwidths as $bw)
{
	foreach ($basekeys as $bk)
	{	//echo $bw;
		if (empty($_POST[$bk]))
		{
			$baseformval[$bk] = $basevals[$bk];
		}
		else 
		{
			$baseformval[$bk] = $_POST[$bk];

		}
	}

	


	//print_r($_POST);
	$totalcost = array();
	foreach ($serviceid as $s)
	{	
			$form = array();
			$providers = array();
		if (isset($_POST[$s."ann".$bw]) && $_POST[$s."ann".$bw] != "")
		{

			$form[$s] = $_POST[$s."ann".$bw];
			$providers[] = $s;
		}
		if (isset($_POST['i4ann'.$bw]) && $_POST["i4ann".$bw] != "")
		{
			if ($_POST['i4ins'.$bw] != "")
					{
						$providers [] = 'i5';
						$form['i5'] = $_POST['i4ann'.$bw];
					}
		}


			$iterator = 0;
			foreach ($form as $f)//
			{
				
				$index = $providers[$iterator];
				//echo $index;
				if ($index == "i2" || $index == "i3")
				{
					$btcheck = True;
				}
				else
				{
					$btcheck = False;
				}
				if ($index == "i4" || $index == "i5")
				{
					$i4check = True;
				}
				else 
				{
					$i4check = False;
				}
				if ($index == "i5")
				{
					$i5check = True;
				}
				else 
				{
					$i5check = False;
				}
				
				
				//print_r($basevals);
				$totalcost[$index] = calculate($basevals, $f, $bw /*$cost, */);
				$btcheck = False;
				$totalprice[$index] = calculate($baseformval, $f, $bw);

				//echo "it: ".$iterator;
				$iterator += 1;
			}
			//print_r($totalprice);	
			if (isset($totalprice))
			{
			$testarray[$bw] = $totalprice;
			}
			//echo $completeform;
			$quotearray[$bw] = $totalcost;
	}
}


include 'form.html.php';
/*echo "<br>total:";
print_r($quotearray);*/