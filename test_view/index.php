<?php

include '../dblogin.php';

include 'tablereturn.php';

include 'formula.php';	

include 'baserow.php';




$bandwidths = array(10,20,30,40,50,100);
global $quotearray;
foreach ($bandwidths as $bw)
{
	$totalcost = array();
	if (!empty($_POST['ttbann'.$bw]) || !empty($_POST['btsann'.$bw]) || !empty($_POST['btpann'.$bw]) || !empty($_POST['eadann'.$bw]))
		
	{	
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
			$basekeys = array_keys($basevals);

			$quotearray[$bw] = formfill($basevals, $bw);

		//print_r($_POST);
		$comleteform = 1;
		foreach ($basekeys as $bk)
		{	//echo $bw;
			if (empty($_POST[$bw.$bk]))
			{
				$completeform = 0;
			}
			else 
			{
				$baseformval[$bk] = $_POST[$bw.$bk];
			}
		}
		if ($completeform == 1);
		{	
			$testarray[$bw] = formfill($baseformval, $bw);
		}
	}

}	print_r($testarray);
echo "TEST";


include 'form.html.php';
function formfill($baseformval, $bw)
{	/*echo "PASS";
	print_r($baseformval);*/
	$form = array();
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
		$testcost[$index] = calculate($baseformval, $f);
		$iterator += 1;
	}
	return($testcost);

}




/*$form = array();
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
		}*/
		/*echo "<br>Providers: ";
		print_r($providers);
		echo "<br>Formstuff:";
		print_r($form);*/
/*			$iterator = 0;
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
				$totalcost[$index] = calculate($basevals, $f //$cost, );
				$btcheck = False;
				//echo "it: ".$iterator;
				$iterator += 1;
			}*/