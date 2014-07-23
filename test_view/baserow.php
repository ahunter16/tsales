
<?php 		//A file for displaying the most recent sets of base values

function basevals()
{
	include '../dblogin.php';
	$bandwidths = array(10,20,30,40,50,100);	
	foreach ($bandwidths as &$b)
	{
		try 					//CHANGE change query to new database
		{
			$modbasequery = 'SELECT * FROM sales.base_value AS b WHERE b.Bandwidth_Mbps = '.$b.' ORDER BY last_updated DESC LIMIT 1';
			$modstmt = $pdo->query($modbasequery);
			$modresult = $modstmt->setFetchMode(PDO::FETCH_ASSOC);
		}

		catch (PDOException $e)
		{
		    $output = 'Error getting pricing info:' . $e->getMessage();
		    include'output.html.php';
		    exit();
		}
		while ($modrow = $modstmt->fetch())
		{
			$modbasevals[] = $modrow;
		}
		
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
				if ($key != "Base_ID" && $key !="Last_Updated" && isset($_POST[$modtable['Bandwidth_Mbps'].$key]) && $_POST[$modtable['Bandwidth_Mbps'].$key]!= "")
				{
					if ($_POST[$modtable['Bandwidth_Mbps'].$key] != $modtable[$key])
					{

						$changes[$modtable['Bandwidth_Mbps']][$key] = $_POST[$modtable['Bandwidth_Mbps'].$key];
					}

					$active = $_POST[$modtable['Bandwidth_Mbps'].$key];					
				}

				else
				{
					$active = $modtable[$key];
				}

				if ( $key == 'Base_ID' || $key =='Last_Updated')
				{
					$insert = $active/*modtable[$key]*/;
				}
				elseif ($key == 'Bandwidth_Mbps')
				{
					$insert = '<input name = "'.$modtable['Bandwidth_Mbps'].$key.'" type = "hidden" value = "'.$active/*$modtable[$key]*/.'" >'.$modtable[$key];
				}
				elseif ($ki >= 3 &&$ki < 10)
				{
					$insert = '&pound <input class = "baseinput" name = "'.$modtable['Bandwidth_Mbps'].$key.'" type = "text" value = "'.$active/*$modtable[$key]*/.'" >';
				}
				else 
				{
					$insert = '<input class = "baseinput" name = "'.$modtable['Bandwidth_Mbps'].$key.'" type = "text" value = "'.$active/*$modtable[$key]*/.'" > %';
				}
				$ki += 1;
				$tablerows .= '<td>'.$insert.'</td>'."\n";
			}
		$i += 1;
		echo $tablerows;	//NECESSARY, DO NOT REMOVE
		echo'</tr></form>';
	}
	/*echo "changearray: ";
	print_r($changes);*/

	foreach ($changes as $bw => $values)	//CHANGE column name
	{
		foreach ($tablekeys as $keys)
		{
			if (empty($values[$keys]) && $keys != "Last_Updated" && $keys != "Base_ID")
			{
				$changes[$bw][$keys] = $_POST[$bw.$keys];
			}
		}
	}

	if (!empty($_POST['savebases']))
	{
		try
		{
			
			foreach ($changes as $bw)
			{	
				$baseinsert = 'INSERT INTO sales.base_value SET ';		//CHANGE: find out about how base values are 
																	   // to be used, THEN change this
				foreach ($bw as $keys => $values)					   
				{	
					$baseinsert .= $keys.' = :'.$keys.', ';
				}
				$baseinsert = rtrim($baseinsert, ", ");
				$s = $pdo -> prepare($baseinsert);
				foreach ($bw as $keys => $values)
				{
					$s -> bindValue(':'.$keys, $values);
				}
				$s -> execute();
			}



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