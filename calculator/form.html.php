<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "utf-8">
		<title>Calculator</title>
		<link rel="stylesheet" type="text/css" href="calc.css">


	</head>
	<img src="http://www.converged.co.uk/images/page/converged-logo.gif" alt="Image not found">	<br>
	<hr>
	<body>

		<form action = "" method = "post" id = "inputform">
			<br><br>
			<table>

				<?php tablegenerate();?>
			</table>
			<input type = "submit" Value = "Calculate">
			<input type = "button" value = "Clear" onclick = "clearinput()">

		</form>
		<br>
		<form action = "export" method = "get">
		<input type = "submit" value = "Export to Word" name = "export"> <br>
		<?php table_populate(); ?>
		
		</form>
		<script>
		function formsub()
		{
			document.getElementById("inputform").submit();
		}
		function clearinput()
		{	var inputbox = document.getElementsByClassName("inputtext");
			var arraylength = inputbox.length;
			for (var i = 0; i< arraylength; i++)
			{
				inputbox[i].value = "";
			}
		}
		function ewayadd()
		{	var rows = [10,20,30,40,50,100];

			for (var it = 0; it < 5; it++)
			{	var stindex = "btsann".concat(rows[it]);
				var ewayindex = "wayann".concat(rows[it]);
				var prindex = "btpann".concat(rows[it]);
				var stotindex = "btstot".concat(rows[it]);
				var ptotindex = "btptot".concat(rows[it]);
				var btsann = document.getElementByid(stindex).value;
				var btpann = document.getElementByid(prindex).value;
				var wayann = document.getElementByid(ewayindex).value;
				document.getElementByid("btstot10").value = "asdf";
				var y = document.getElementByid(ptotindex);
				//
				y.innerHTML = (btpann + wayann);
			}
		
		}
		</script>

	</body>
</html>