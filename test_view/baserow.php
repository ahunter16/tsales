
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
				if ($modkeys != "booldefault")
				{
					$tablehead .= '<th>'.$modkeys. '</th>'."\n";
				}
			}
		echo $tablehead;	//NECESSARY, DO NOT REMOVE
	}

	$changes = array();
	echo '<form>';
	$i = 0;
	tabledefine($modbasevals[0]);

	$tablekeys = array_keys($modbasevals[0]);
	foreach ($modbasevals as $modtable)
	{	
		echo'<tr>';
		$tablerows = '';

		$altered = 0;								//CHANGE: update names of base value columns
		foreach ($tablekeys as $key)
			
			{	
				if ($key != "id" && $key !="booldefault" && isset($_POST[$key]) && $_POST[$key] != "")
				{
					if ($_POST[$key] != $modtable[$key])
					{

						$altered = 1;
					}

					$active = $_POST[$key];					
				}

				else
				{
					$active = $modtable[$key];
				}

				if ( $key == 'id')
				{
					$insert = ">".$active/*modtable[$key]*/;
				}

				else 
				{
					$insert = '><input class = "baseinput" name = "'.$key.'" type = "text" value = "'.$active.'" placeholder = "'.$active.'"> ';
				}
				
				$tablerows .= '<td'.$insert.'</td>'."\n";
			}
		$i += 1;
		echo $tablerows;	//NECESSARY, DO NOT REMOVE
		echo'</tr></form>';
	}


		foreach ($tablekeys as $keys)
		{	
			if (!empty($_POST[$keys]) && !is_null($_POST[$keys]))
			{	
				if (!empty($keys) && !is_null($keys) && $keys != "id" && $keys != "booldefault")
				{
					$changes[$keys] = $_POST[$keys];

				}
				$changes['booldefault'] = 1;
	
			}
			
		}

//print_r($changes);
	if (!empty($_POST['savebases']))
	{
		if ($altered == 1)
		{
			if ($_POST['savebases'] == "default")
			{	
				$changes['booldefault'] = 1;
				try
				{
					
						$baseupdate = "UPDATE sales2.fbr_template SET booldefault = 0 WHERE booldefault = 1 ";
						$s = $pdo2 -> prepare($baseupdate);
						$s-> execute();
				}

				catch (PDOException $e)
			    {
			        $output = 'Error unsetting old default fbr_template values' . $e->getMessage();
			        include'output.html.php';
			        echo $baseinsert;
			        exit();
			    }
			}
			elseif($_POST['savebases'] == "copy")
			{
				$changes['booldefault'] = 0;
			}

			try
			{
				$baseinsert = 'INSERT INTO sales2.fbr_template SET ';		
				foreach ($changes as $keys => $values)					   
				{	
					$baseinsert .= $keys.' = :'.$keys.', ';

				}
				$baseinsert = substr($baseinsert, 0, -2);

				$s = $pdo2 -> prepare($baseinsert);
				foreach ($changes as $keys => $values)
				{
					$s -> bindValue(':'.$keys, $values);
				}
				$s -> execute();
				echo "New base values added and set as copy.";
			}

			catch (PDOException $e)
		    {
		        $output = 'Error updating '.$key. ' field of base_values table:' . $e->getMessage();
		        include'output.html.php';
		        echo $baseinsert;
		        exit();
		    }
			}
		
		else 
		{
			echo "No base value fields have been changed; record not saved.";
		}
	}


}			
?>