<?php

include '../dblogin.php';
include 'tablereturn.php';

include 'formula.php';	


if (isset($_POST['ttbann'])) 
{
	$form['ttb'] = $_POST['ttbann'];
}

if (isset($_POST['btsann'])) 
{
	$form['bts'] = $_POST['btsann'];
}

if (isset($_POST['btpann'])) 
{
	$form['btp'] = $_POST['btpann'];
}

if (isset($_POST['eadann'])) 
{
	$form['ead'] = $_POST['eadann'];
}


$bandwidths = array(10,20,30,40,50,100);
global $quotearray;
foreach ($bandwidths as $bw){
	$totalcost = array();
	if (!empty($_POST['ttbann'.$bw]) || !empty($_POST['btsann'.$bw]) || !empty($_POST['btpann'.$bw]) || !empty($_POST['eadann'.$bw]))
		
	{	$form = array();
		$providers = array();
		if ($_POST['ttbann'.$bw] != "") 
		{
			$form['ttb'] = $_POST['ttbann'.$bw];
			$providers[] = 'ttb';
		}

		if ($_POST['btsann'.$bw] != "") 
		{
			$form['bts'] = $_POST['btsann'.$bw];
			$providers[] = 'bts';

		}

		if ($_POST['btpann'.$bw] != "") 
		{
			$form['btp'] = $_POST['btpann'.$bw];
			$providers[] = 'btp';
		}

		if ($_POST['eadann'.$bw] != "") 
		{
			$form['ead'] = $_POST['eadann'.$bw];
			$providers[] = 'ead';
			if ($_POST['eadins'.$bw] != "")
			{
				$providers [] = 'spd';
				$form['spd'] = $_POST['eadann'.$bw];
			}
		}
/*		echo "<br>Providers: ";
		print_r($providers);
		echo "<br>Formstuff:";
		print_r($form);*/
		$basevals = array();

			try
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
				if ($index == "bts" || $index == "btp")
				{
					$btcheck = True;
				}
				else
				{
					$btcheck = False;
				}
				if ($index == "ead" || $index == "spd")
				{
					$eadcheck = True;
				}
				else 
				{
					$eadcheck = False;
				}
				if ($index == "spd")
				{
					$spdcheck = True;
				}
				else 
				{
					$spdcheck = False;
				}
				$totalcost[$index] = calculate($basevals, $f /*$cost, */);
				$btcheck = False;
				//echo "it: ".$iterator;
				$iterator += 1;
			}
			$quotearray[$bw] = $totalcost;

	}
}
/*$fmargins = array("l", "m", "h");
$fsupliers = array("ttb", "bts", "btp", "ead", "spd");
$fyears = array(1,3);
$fbwidths = array(10,20,30,40,50,100);
$final = array();
$foreach*/


include 'form.html.php';
/*echo "<br>total:";
print_r($quotearray);*/