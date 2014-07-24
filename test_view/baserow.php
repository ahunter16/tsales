
<?php 		//A file for displaying the most recent sets of base values

function basevals()
{
	include '../dblogin.php';
	$bandwidths = array(10,20,30,40,50,100);	

	$modbasevals = array();

	try 			//CHANGE: to use new database; change QUERY and following statements for shorthands
	{					
		$modbasequery = 'SELECT * FROM sales2.fbr_template WHERE booldefault = 1';
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
		$modbasevals[] = $temps;
	}

	//print_r($modbasevals);
	function tabledefine($modbasevals)		//creates a table with headings using base_valuesx column names
	{
		echo '<table id = "baseinputs"><tr>';

		$tablerows = "";
		$tablehead = "";
		foreach (array_keys($modbasevals) as $modkeys)
			{	
				$tablehead .= '<th>'.$modkeys. '</th>'."\n";
			}
		echo $tablehead;	//NECESSARY, DO NOT REMOVE
	}

	$changes = array();
	echo '<form>';
	$i = 0;
	tabledefine($modbasevals[0]);
/*	echo " MODBASEVALS ";
	print_r($modbasevals);*/
	$tablekeys = array_keys($modbasevals[0]);
	foreach ($modbasevals as $modtable)
	{	
		echo'<tr>';
		$tablerows = '';

		$ki = 0;								//CHANGE: update names of base value columns
		foreach ($tablekeys as $key)
			
			{	
				if ($key != "id" && $key !="booldefault" && isset($_POST[$key]) && $_POST[$key] != "")
				{
					if ($_POST[$key] != $modtable[$key])
					{

						$changes[$key] = $_POST[$key];
					}

					$active = $_POST[$key];					
				}

				else
				{
					$active = $modtable[$key];
				}

				if ( $key == 'id')
				{
					$insert = $active/*modtable[$key]*/;
				}
				elseif ($key == 'booldefault')
				{
					$insert = '<input name = "'.$key.'" type = "hidden" value = "'.$active/*$modtable[$key]*/.'" >'.$modtable[$key];
				}
/*				elseif ($ki >= 3 &&$ki < 10)
				{
					$insert = '&pound <input class = "baseinput" name = "'.$modtable['Bandwidth_Mbps']$key.'" type = "text" value = "'.$active/*$modtable[$key].'" >';
				}*/
				else 
				{
					$insert = '<input class = "baseinput" name = "'.$key.'" type = "text" value = "'.$active.'" > ';
				}
				$ki += 1;
				$tablerows .= '<td>'.$insert.'</td>'."\n";
			}
		$i += 1;
		echo $tablerows;	//NECESSARY, DO NOT REMOVE
		echo'</tr></form>';
	}


		foreach ($tablekeys as $keys)
		{
			if (empty($keys) && $keys != "booldefault" && $keys != "id")
			{
				$changes[$keys] = $_POST[$keys];
			}
		}
	

	if (!empty($_POST['savebases']))
	{
		try
		{
			

				$baseinsert = 'INSERT INTO sales.base_value SET ';		//CHANGE: find out about how base values are 
																	   // to be used, THEN change this
				foreach ($changes as $keys => $values)					   
				{	
					$baseinsert .= $keys.' = :'.$keys.', ';
				}
				$baseinsert = rtrim($baseinsert, ", ");
				$s = $pdo -> prepare($baseinsert);
				foreach ($changes as $keys => $values)
				{
					$s -> bindValue(':'.$keys, $values);
				}
				$s -> execute();
			


		}

		catch (PDOException $e)
	    {
	        $output = 'Error updating '.$key. ' field of base_values table:' . $e->getMessage();
	        include'output.html.php';
	        echo $baseinsert;
	        exit();
	    }
	}
}			
?>