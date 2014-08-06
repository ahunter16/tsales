<?php



include '../dblogin.php';
if (empty($_REQUEST['save']))
{
include 'tablereturn.php';
include 'baserow.php';
include 'formula.php';	

	try 					//gets account names and ids for use in select input
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


	
	 try 			
			{					
				$modbasequery = 'SELECT id FROM sales2.fbr_template ORDER BY id DESC LIMIT 1';
				$stmt = $pdo2->query($modbasequery);
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
				$lasttemplate = $temps;
			}
			include 'form.html.php';
}
else
{
	$oldpath = get_include_path();
	set_include_path('C:\xampp\htdocs\tsales\calculator');
	include "confirm\conindex.php";
	set_include_path($oldpath);
} 
/*echo "<br>total:";
print_r($quotearray);*/