<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "utf-8">
		<title>Confirm Quote</title>
		<link rel="stylesheet" type="text/css" href="calc.css">
	</head>
	<img src="http://www.converged.co.uk/images/page/converged-logo.gif" alt="Image not found">	<br>
	<hr>
	<body>
		<script>
		function checkdown(supply)
		{	var supply1 = supply.concat("1");
			var supply3 = supply.concat("3");
			var scheckbx = document.getElementById(supply);

			var column1 = document.getElementsByClassName(supply1);
			var column3 = document.getElementsByClassName(supply3);

			if (scheckbx.checked == true)
			{
				column1.checked = true;
				column3.checked = true;
			}
			else
			{
				column1.checked = false;
				column3.checked = false;
			}
		}

		function yrcheck(supplyyr)
		{	


			var checkbxyr = document.getElementById(supplyyr);

			/*var column3 = document.getElementByClassName(supply3);*/
			var rows = [10,20,30,40,50,100];

			for (var it = 0; it < 5; it++)
			{	var supplys = supplyyr.concat(rows[it]);
				supplys = "l".concat(supplys);
				var columnyr = document.getElementById(supplys);
				if (checkbx1.checked == true)
				{
					columnyr.checked = true;
				}
				else
				{
					columnyr.checked = false;
				}
			}
	}
		</script>
		<br><div class = "Section2">
	<form action = "" method = "post">
		<?php 
			if (isset($_REQUEST['supplier']) && empty($_REQUEST['reviewsub']))
			{
				table_populate($servicearray);
				echo '		
						<label><strong>Postcode: </strong></label>'.$_REQUEST['postcode'].
						'<br><label><strong>Reference: </strong></label>'.$_REQUEST['reference'].
						'<br><label><strong>Ticket Number: </strong></label>'.$_REQUEST['ticket'].
						'<br><label><strong>Account: </strong></label>'.$accounts[$_REQUEST['account']].'<br>';
						echo '<br> <input id = "reviewbutton" type = "submit" value = "Submit for Review" name = "reviewsub">';


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
</div

	</body>

</html>