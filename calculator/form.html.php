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

				<?php tablegenerate($serviceid, $servicename);?>
			</table>
			<input type = "submit" Value = "Calculate">
			<input type = "button" value = "Clear" onclick = "clearinput()">

		</form>
		<br>
		<form action = "confirm" method = "get">
		<input type = "submit" value = "Save" name = "save"> <br><br>

		<div id = "extrainfo">
			<label id = "postlabel" for = "postcode"> Postcode: </label> <br>
			<input type = "text" name = "postcode" id = "postcode"><br><br>
			<label id = "ticketlabel" for ="ticket">Ticket Number: </label><br>
			<input type = "text" name = "ticket" id = "ticket"><br><br>
		</div>
		<div id = "extrainfo2">

			<label id = "reflabel" for = "reference">Reference:</label><br>
			<input type = "text" name = "reference" id = "reference"><br><br>
			<label>Account:</label><br>
			<select id = "account" name = "account">
				<?php accountselect(); ?>
			</select>
		</div>
		<br><br>
		<?php table_populate($serviceid, $servicename); ?>
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
			{	var stindex = "i2ann".concat(rows[it]);	//CHANGE to work for variable suppliers OR delete & delegate to PHP code
				var ewayindex = "wayann".concat(rows[it]);
				var prindex = "btpann".concat(rows[it]);
				var stotindex = "i2tot".concat(rows[it]);
				var ptotindex = "btptot".concat(rows[it]);
				var i2ann = document.getElementByid(stindex).value;
				var btpann = document.getElementByid(prindex).value;
				var wayann = document.getElementByid(ewayindex).value;
				document.getElementByid("i2tot10").value = "asdf";
				var y = document.getElementByid(ptotindex);
				//
				y.innerHTML = (btpann + wayann);
			}
		
		}
		</script>

	</body>
</html>