<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "utf-8">
		<title>Export Values</title>
		


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
		<br>
	<form action = "export" method = "get">
		<?php 
		global $duplicate;

		if (!empty($indices) && $duplicate == 0)
		{
			table_populate();
		}
			else if($duplicate == 1)
			{
				echo "<strong>WARNING:</strong> you have chosen to display the same supplier multiple times. 
				<br>Please go <a href = 'javascript:history.back()'>back</a> and make sure only one instance of each supplier is selected.";
			}
			else
			{
				echo "Error: no table columns selected. <br>Please go <a href = 'javascript:history.back()'>back</a> and select at least one column.";
			}
			 ?>

	</form>



	</body>
</html>