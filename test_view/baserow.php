
<?php 		//A file for displaying the most recent sets of base values

function basevals()
{
	include '../dblogin.php';
	$bandwidths = array(10,20,30,40,50,100);	
	foreach ($bandwidths as &$b)
	{
		try
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
		echo $tablehead;
	}
	echo '<form>';
	$i = 0;
	tabledefine($modbasevals[0]);
	foreach ($modbasevals as &$modtable)
	{	
		echo'<tr>';
		$tablerows = '';
		$tablekeys = array_keys($modtable);
		$ki = 0;
		foreach ($tablekeys as $key)
			
			{	

				if ( $key == 'Base_ID' || $key =='Last_Updated')
				{
					$insert = $modtable[$key];
				}
				elseif ($key == 'Bandwidth_Mbps')
				{
					$insert = '<input name = "'.$modtable['Bandwidth_Mbps'].$key.'"type = "hidden" value = "'.$modtable[$key].'" >'.$modtable[$key];
				}
				elseif ($ki >= 3 &&$ki < 10)
				{
					$insert = '&pound <input class = "baseinput" name = "'.$modtable['Bandwidth_Mbps'].$key.'"type = "text" value = "'.$modtable[$key].'" >';
				}
				else 
				{
					$insert = '<input class = "baseinput" name = "'.$modtable['Bandwidth_Mbps'].$key.'"type = "text" value = "'.$modtable[$key].'" > %';
				}
				$ki += 1;
				$tablerows .= '<td>'.$insert.'</td>'."\n";
			}
		$i += 1;
		echo $tablerows;
		echo'</tr></form>';
	}
}			
?>