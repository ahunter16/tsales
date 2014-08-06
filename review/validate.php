<?php



function viewquote($quoteid)	//echoes HTML table containing all quotes with a given status id ($quoteid)
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
		$output = 'Error fetching quote info: '. $e->getMessage();
		include "output.html.php";
		exit();
	}

	while($temp = $stmt->fetch())
	{
		$displayed[] = $temp;
	}
	//print_r($displayed);
	echo '<p id = "quotelabel"><strong>Quote Pricing:</strong></p> 
	<table id = "quoteview">'."\n";
	if (!empty($displayed) && isset($displayed))
{		echo '<tr>';
		foreach (array_keys($displayed[0]) as $key)
		{
			echo '<th>'.$key.'</th>'."\n";
		}
		echo '</tr>';
		foreach ($displayed as $displayrecord)
		{

			echo '<tr>'."\n";
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



function historyupdate($quote, $status, $staff)		//adds a record to fbr_quote_history to reflect any change in status for a quote
{
	global $pdo2;
	try
	{
		$sql = 'INSERT INTO sales2.fbr_quote_history SET'.'
		intquoteid = :quoteid,
		intstaffid = :staffid,
		intquotestatusid = :statusid';

		$s = $pdo2 -> prepare($sql);

		$s-> bindValue(':quoteid', $quote);
		$s-> bindValue(':staffid', $staff);
		$s-> bindValue(':statusid', $status);

		$s->execute();

	}

	catch (PDOException $e)
	{
        $output = 'Error inserting into quote history' . $e->getMessage();

        include'output.html.php';
        exit();
    }
}



function statusupdate($quote, $option)		//updates a given quote record with a new status
{
	global $pdo2;
	try
	{
		$sql = 'UPDATE sales2.fbr_quote SET intquotestatusid = '.$option.' WHERE id = '.$quote;
		$s = $pdo2 -> prepare($sql);
		$s-> execute();
	}

	catch(PDOException $e)
	{
		$output = 'Error changing quote status: '. $e->getMessage();
		include "output.html.php";
		exit();
	}
}

function showhistory($quote)
{
	global $pdo2;
	try
	{
		//LEFT OUTER JOIN cnv_staff ON s.intstaffid=c.intstaffid 
		$sql = 'SELECT s.intquoteid, s.datchange, c.strsurname,  c.strfirstname 
		FROM (sales2.fbr_quote_history s, sales2.cnv_staff c) 
		
		WHERE s.intstaffid=c.intstaffid AND s.intquoteid = '.$quote;
		$stmt = $pdo2->query($sql);
		$result = $stmt -> setFetchMode(PDO::FETCH_ASSOC);
	}

	catch(PDOException $e)
	{
		$output = 'Error fetching quote history: '. $e->getMessage();
		echo $sql;
		include "output.html.php";
		exit();
	}

	while($temp = $stmt->fetch())
	{
		$history[] = $temp;
	}

	echo '<p id = "historylabel"><strong>Quote History:</strong></p> <br>
	<table id = "historyview">'."\n";
	if (!empty($history) && isset($history))
	{	echo '<tr>';
		foreach (array_keys($history[0]) as $key)
		{
			echo '<th>'.$key.'</th>'."\n";
		}
		foreach ($history as $hist)
		{

			echo '<tr>'."\n";
			foreach ($hist as $value)
			{
				echo '<td>'.$value.'</td>'."\n"; 
			}
			echo'</tr>';
		}
	}
	else 
	{
		echo 'Error: Histort not found.'."\n";
	}
	echo '</table>';
}