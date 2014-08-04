<?php



function viewquote($quoteid)
{
	global $pdo2;
	try
	{
		$sql = 'SELECT * FROM sales2.fbr_quote_pricing WHERE intquoteid = '.$quoteid;
		$stmt = $pdo2->query($sql);
		$result = $stmt -> setFetchMode(PDO::FETCH_ASSOC);
	}

	catch(PDOException $e)
	{
		$output = 'Error fetching quote info: '. $e->getMessge();
		include "output.html.php";
		exit();
	}

	while($temp = $stmt->fetch())
	{
		$displayed[] = $temp;
	}
	//print_r($displayed);
	echo '<table id = "quoteview">'."\n";
	if (!empty($displayed) && isset($displayed))
	{	foreach ($displayed as $displayrecord)
		{
			echo '<tr>';
			foreach (array_keys($displayrecord) as $key)
			{
				echo '<th>'.$key.'</th>'."\n";
			}
			echo '</tr><tr>'."\n";
			foreach ($displayrecord as $value)
			{
				echo '<td>'.$value.'</td>'."\n"; 
			}
			echo'</tr>';
		}
	}
	else 
	{
		echo 'Error: matching quote pricing not found.'."\n";
	}
	echo '</table>';
}

function validate($id)
{
	global $pdo2;

	try 
	{
		$sql = 'UPDATE sales2.fbr_quote SET intquotestatusid = 30 WHERE id ='.$id;
		$s = $pdo2 -> prepare($sql);
		$s-> execute();
	}

	catch(PDOException $e)
	{
		$output = 'Error validating quote: '. $e->getMessge();
		include "output.html.php";
		exit();
	}
	

}

function revert($id)
{
	global $pdo2;

	try
	{
		$sql = 'UPDATE sales2.fbr_quote SET intquotestatusid = 10 WHERE id = '.$id;
		$s = $pdo2 -> prepare($sql);
		$s-> execute();
	}

	catch(PDOException $e)
	{
		$output = 'Error reverting quote: '. $e->getMessge();
		include "output.html.php";
		exit();
	}
}

function cancel($id)
{
	global $pdo2;

	try
	{
		$sql = 'UPDATE sales2.fbr_quote SET intquotestatusid = 70 WHERE id = '.$id;
		$s = $pdo2 -> prepare($sql);
		$s-> execute();
	}

	catch(PDOException $e)
	{
		$output = 'Error cancelling quote: '. $e->getMessge();
		include "output.html.php";
		exit();
	}

}