<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "utf-8">
		<title>Confirm Quote</title>
		<link rel="stylesheet" type="text/css" href="confirmbackup/concalc.css">
	</head>
	<img src="http://www.converged.co.uk/images/page/converged-logo.gif" alt="Image not found">	<br>
	<hr>
	<body>

		<br><div class = "Section2">
	<form action = "" method = "post">
		<?php 
			if (isset($_REQUEST['supplier']) && empty($_REQUEST['reviewsub']))
			{
				table_populate($servicearray);
				//print_r($_POST);
				echo '		
						<label><strong>Postcode: </strong></label>'.$_REQUEST['postcode'].
						'<br><label><strong>Reference: </strong></label>'.$_REQUEST['reference'].
						'<br><label><strong>Ticket Number: </strong></label>'.$_REQUEST['ticket'].
						'<br><label><strong>Account: </strong></label>'.$accounts[$_REQUEST['account']].'<br>
						<input type = "hidden" name = "postcode" value = "'.$_REQUEST['postcode'].'">
						<input type = "hidden" name = "reference" value = "'.$_REQUEST['reference'].'">
						<input type = "hidden" name = "ticket" value = "'.$_REQUEST['ticket'].'">
						<input type = "hidden" name = "accountname" value = "'.$accounts[$_REQUEST['account']].'">
						<input type = "hidden" name = "account" value = "'.$_REQUEST['account'].'">
						<input type = "hidden" name = "templateid" value ="'.$_POST['templateid'].'" >
						<input type = "hidden" name = "save" value = "Save"><br>
						<input id = "reviewbutton" type = "submit" value = "Submit for Review" name = "reviewsub">';


			}
			
			elseif (!isset($_REQUEST['supplier']))
			{
				echo "Error: no table columns selected. <br>Please go <a href = 'javascript:history.back()'>back</a> and select at least one column.";
			}
			elseif (!empty($_REQUEST['reviewsub']))
			{
				echo "Quote submitted for review.<br>";
				echo "<a href = ../../review>Review Quotes</a><br>";
				echo "<a href = ../>Back</a> to Calculator";

			}
		 ?>

		  
	</form>
</div>		
<div>
</div>

	</body>

</html>