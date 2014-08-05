<?php
include "../dblogin.php";
include "validate.php";

if (!isset($_POST['statusid']) && !isset($_POST['hiddenstatusid']))
{
	$status = "WHERE intquotestatusid = 10";
	$option = 10;
}
elseif(isset($_POST['hiddenstatusid']) && !empty($_POST['hiddenstatusid']))
{
	$status = "WHERE intquotestatusid = ".$_POST['hiddenstatusid'];
	$option = $_POST['hiddenstatusid'];
}
elseif (empty($_POST['statusid']) && empty($_POSt['hiddenstatusid']))
{
	$status = "";
	$option = "";
}
else 
{
	$status = "WHERE intquotestatusid = ".$_POST['statusid'];
	$option = $_POST['statusid'];
}

//echo $option." || ".$status."<br>";
try
{
	$sql = 'SELECT id, strquotestatus  FROM sales2.fbr_quote_status';
	$stmt = $pdo2->query($sql);
	$result = $stmt -> setFetchMode(PDO::FETCH_ASSOC);
}

catch(PDOException $e)
{
	$output = 'Error getting account info: '. $e->getMessage();
	include "output.html.php";
	exit();
}

while ($temp = $stmt->fetch())
{
	$statuses[] = $temp;
}

try
{
	$sql = 'SELECT * FROM sales2.fbr_quote '.$status;
	$stmt = $pdo2->query($sql);
	$result = $stmt -> setFetchMode(PDO::FETCH_ASSOC);
}

catch(PDOException $e)
{
	echo $sql;
	$output = 'Error getting account info: '. $e->getMessage();
	include "output.html.php";
	exit();
}




$accname = array();
$accid = array();

while ($temp = $stmt->fetch())
{
	$statusquote[] = $temp;
}


function reviewdefine($statusquote, $status)
{

	echo '<table><tr>';
	foreach (array_keys($statusquote[0]) as $key)
	{
		echo '<th>'.$key.'</th>';
	}
	echo '</tr>';
	foreach ($statusquote as $index => $sq)
	{	echo '<tr>';
		foreach ($sq as $field)
		{
			echo '<td name ="'.$index.$sq['id'].'" >'.$field.'</td>'."\n";
		}
		if ($status == 20)
		{
			echo '<td><button type = "submit" value = "'.$sq['id'].'" name = "val" >Validate</button></td>'."\n";
			echo '<td><button type = "submit" value = "'.$sq['id'].'" name = "revert" >Deny Validation</button></td>'."\n";
		}
		if ($status ==10 || $status ==20 || $status ==30 || $status ==40 )
		{
			echo '<td><button type = "submit" value = "'.$sq['id'].'" name = "cancel" >Cancel</button></td>'."\n";
		}
		echo '<td><button type = "submit" value = "'.$sq['id'].'" name = "display">Show Pricing</button></tr>'."\n";
	}
	global $option;

	echo '<input type = "hidden" name = "hiddenstatusid" value ="'.$option.'">'."\n";

	if (isset($_POST['display']))
	{
		/*echo '<label><strong>Quote Pricing:</strong></label>';*/
		viewquote($_POST['display']);
	}

	if (isset($_POST['val']))
	{
		validate($_POST['val']);
	}

	if (isset($_POST['revert']))
	{
		revert($_POST['revert']);
	}

	if (isset($_POST['cancel']))
	{
		cancel($_POST['cancel']);
	}

	echo'</table>';

}
//print_r($_POST);
function selectcriteria($statuses, $option)
{global $equal;
	$equal = "false";

	foreach ($statuses as $record)
	{

		if ($record['id'] == $option)
		{

			echo '<option value = '.$record['id'].' selected >'.$record['id'].' - '.$record['strquotestatus'].'</option>'."\n";
		}
		else
		{
			echo '<option value = '.$record['id'].'>'.$record['id'].' - '.$record['strquotestatus'].'</option>'."\n";					
		}
	}
	if (empty($option))
	{
		echo '<option value = "" selected>All Quotes</option>';
	}
	else 
	{
		echo '<option value = "">All Quotes</option>';	
	}
	
}


include "form.html.php";