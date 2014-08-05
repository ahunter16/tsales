<?php

include '../dblogin.php';

if (empty($_REQUEST['save']))
{
	echo $_POST['accountval']."BLAH";
	include 'tablereturn.php';
	include 'formula.php';	

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
	natcasesort($accounts);


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
	    while ($temp = $stmt->fetch())
	    {
			$serviceid[] = 'i'.$temp['id'];
			$servicename[] = $temp['strfibreservice'];
		}



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

	//$_GET['templateid'] = $basevals['id'];

	foreach ($bandwidths as $bw)
	{
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
					$totalcost[$index] = calculate($basevals, $f, $bw);
					$btcheck = False;
					//echo "it: ".$iterator;
					$iterator += 1;
				}
				$quotearray[$bw] = $totalcost;
		}
	}


/*	if (isset($_POST['save']) && $_POST['save'] == 'Save')
	{	
		$save = 1;
		$fields = array("postcode", "ticket", "account");
		foreach ($fields as $f)
		{
			if (empty($_POST[$f]))
			{
				echo $f." field empty, please make sure it is filled in and try again.";
				$save = 0;
				echo $save;

				break;
			}
			echo $_POST['postcode'];
			echo $save;
		}
		global $save;
		if ($save == 1)
		{
			//include "quotesave.php";
			
		}
	}*/

	//print_r($_POST);

	include 'form.html.php';
}
else 
{
	include 'confirmbackup/conindex.php';
}