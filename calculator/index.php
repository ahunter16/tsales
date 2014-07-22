<?php

include '../dblogin.php';
include 'tablereturn.php';

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

print_r($servicename);

foreach ($serviceid as $sid)
{
	if (!empty($_POST[$sid]) && !is_null($_POST[$sid]))
	{
		$form[$sid] = $_POST[$sid.'ann'];
	}
}


$bandwidths = array(10,20,30,40,50,100);		//CHANGE: Variable supplier shorthands

global $quotearray;

foreach ($bandwidths as $bw)
{
	$totalcost = array();
	foreach ($serviceid as $s)
	{	
			$form = array();
			$providers = array();
		if (!empty($_POST[$s."ann".$bw]) && !is_null($_POST[$s."ann".$bw]))
		{

			$form[$s] = $_POST[$s."ann".$bw];
			$providers[] = $s;
		}
		if (!empty($_POST['i4ann'.$bw]) && !is_null($_POST['i4ann'.$bw]))
		{
			if ($_POST['i4ins'.$bw] != "")
					{
						$providers [] = 'i5';
						$form['i5'] = $_POST['i4ann'.$bw];
					}
		}

		$basevals = array();

			try 			//CHANGE: to use new database; change QUERY and following statements for shorthands
			{					
				
				$basequery = 'SELECT * FROM sales.active_base_values WHERE Bandwidth_Mbps = '.$bw.' ORDER BY last_updated DESC LIMIT 1';
				$stmt = $pdo->query($basequery);
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

			}
			catch (PDOException $e)
			{
		        $output = 'Error getting pricing info:' . $e->getMessage();
		        include'output.html.php';
		        exit();
		    }

			$basevals = $stmt->fetch();

			$iterator = 0;
			foreach ($form as $f)
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
				$totalcost[$index] = calculate($basevals, $f /*$cost, */);
				$btcheck = False;
				//echo "it: ".$iterator;
				$iterator += 1;
			}
			$quotearray[$bw] = $totalcost;

	}
}


include 'form.html.php';
/*echo "<br>total:";
print_r($quotearray);*/