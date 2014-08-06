<?php

include '../../dblogin.php';
include 'tablereturn.php';




try 	//retrieves quote details for a given quote in fbr_quote
{
	$sql = 'SELECT * FROM sales2.fbr_quote_detail WHERE intquoteid = '.$_REQUEST['export'];
	$stmt = $pdo2->query($sql);
	$result = $stmt-> setFetchMode(PDO::FETCH_ASSOC);
}

catch(PDOException $e)
{
	$output = 'Error fetching quote detail info: '. $e->getMessge();
	include "output.html.php";
	exit();
}

while($temp = $stmt->fetch())
{
	$quotes[] = $temp;
}



try 	//updates a given quote record to the "Under Review" status (id of 40)
{
	$sql = 'UPDATE sales2.fbr_quote SET intquotestatusid = 40 WHERE id = '.$_REQUEST['export'];
	$s = $pdo2 -> prepare($sql);
	$s-> execute();
}

catch(PDOException $e)
{
	$output = 'Error changing quote status: '. $e->getMessge();
	include "output.html.php";
	exit();
}



try 		//adds a record to fbr_quote_history to reflect change in status
{
	$sql = 'INSERT INTO sales2.fbr_quote_history SET'.'
	intquoteid = :quoteid,
	intstaffid = :staffid,
	intquotestatusid = :statusid';

	$s = $pdo2 -> prepare($sql);

	$s-> bindValue(':quoteid', $_REQUEST['export']);
	$s-> bindValue(':staffid', $_REQUEST['staffid']);
	$s-> bindValue(':statusid', 40);

	$s->execute();

}

catch (PDOException $e)
{
    $output = 'Error inserting into quote history' . $e->getMessage();

    include'output.html.php';
    exit();
}

header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=LES_Prices_Table.doc");


include 'form.html.php';

