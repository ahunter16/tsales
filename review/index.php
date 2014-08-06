<?php
include "../dblogin.php";
include "validate.php";

$staffpermission = array(8 => "Andy Neve", 5 => "Neil Christie");
$staffid = 8;

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


function reviewdefine($statusquote, $option)
{

	global $staffid;
	echo '<input type = "hidden" value = "'.$staffid.'" name = "staffid">';

	$revtable = '<table><tr>';
	foreach (array_keys($statusquote[0]) as $key)
	{
		$revtable .= '<th>'.$key.'</th>';
	}
	$revtable .= '</tr>';
	foreach ($statusquote as $index => $sq)
	{	$revtable .= '<tr>';
		foreach ($sq as $field)
		{
			$revtable .= '<td name ="'.$index.$sq['id'].'" >'.$field.'</td>'."\n";
		}
		global $staffpermission;
		
		if ($option == 10)
		{
			$tut = "Quotes which are either in the process of being built or have been denied validation and may need to be tweaked";
			$revtable .= '<td><button type = "submit" value = "'.$sq['id'].'" name = "edit" >Edit</button></td>'."\n";			
		}
		if ($option == 20 && array_key_exists($staffid, $staffpermission))
		{
			$tut = "Quotes that have been submitted for validation but not reviewed yet";
			$revtable .= '<td><button type = "submit" value = "'.$sq['id'].'" name = "val" >Validate</button></td>'."\n";
			$revtable .= '<td><button type = "submit" value = "'.$sq['id'].'" name = "deny" >Deny Validation</button></td>'."\n";
		}
		if ($option == 30)
		{
			$tut = "Quotes that have been validated; click \"Export\" to generate a Word doc containing the prices";
			$revtable .= '<td><button id = "export'.$sq['id'].'" value = "'.$sq['id'].'" name = "export" onclick = "expform(this)">Export</button></td>'."\n";
		}
		if ($option == 40)
		{
			$tut = "Quotes that have been sent off to clients and are currently being reviewed. Click \"Accepted\" if a quote has been accepted by the client";
			$revtable .= '<td><button type = "submit" value = "'.$sq['id'].'" name = "accept" >Accepted</button></td>'."\n";
			$revtable .= '<td><button type = "submit" value = "'.$sq['id'].'" name = "reject" >Rejected</button></td>'."\n";
		}
		if ($option == 50)
		{
			$tut = "Quotes that have been accepted by clients";
		}
		if ($option == 60)
		{
			$tut = "Quotes that have been rejected by clients";
		}
		if ($option == 70)
		{
			$tut = "Quotes that have been cancelled";
		}
		if (empty($option))
		{
			$tut = "All Quotes";
		}
		if ($option ==10 || $option ==20 || $option ==30 || $option ==40 )
		{
			$revtable .= '<td><button type = "submit" value = "'.$sq['id'].'" name = "cancel" >Cancel</button></td>'."\n";
		}


		$revtable .= '<td><button type = "submit" value = "'.$sq['id'].'" name = "display">Show Pricing</button>'."\n";
		$revtable .= '<td><button type = "submit" value = "'.$sq['id'].'" name = "history">Show History</button></tr>'."\n";
	}
	global $option;

	$revtable .= '<input type = "hidden" name = "hiddenstatusid" value ="'.$option.'">'."\n";

	$revtable .='</table>';
	echo '<p style = "font-size: 1.2em">'.$tut.'</p><br>';
	echo $revtable;




	if (isset($_POST['display']))
	{
		/*$revtable .= '<label><strong>Quote Pricing:</strong></label>';*/
		viewquote($_POST['display']);
	}

	if (isset($_POST['val']))
	{
		statusupdate($_POST['val'], 30);
		historyupdate($_POST['val'], 30, $staffid);
	}

	if (isset($_POST['deny']))
	{
		statusupdate($_POST['deny'], 10);
		historyupdate($_POST['deny'], 10, $staffid);
	}

	if (isset($_POST['cancel']))
	{
		statusupdate($_POST['cancel'], 70);
		historyupdate($_POST['cancel'], 70, $staffid);
	}

	if (isset($_POST['delete']))
	{
		remove($_POST['delete']);
	}

	if (isset($_POST['accept']))
	{
		statusupdate($_POST['accept'], 50);
		historyupdate($_POST['accept'], 50, $staffid);
	}

	if (isset($_POST['reject']))
		{
			statusupdate($_POST['reject'], 60);
			historyupdate($_POST['reject'], 60, $staffid);
		}

	if (isset($_POST['history']))
	{
		showhistory($_POST['history']);
	}

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
