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
			<input type = "hidden" name = "postcodeval" value = "" id = "postcodeval">
			<input type = "hidden" name = "ticketval" value = "" id = "ticketval">
			<input type = "hidden" name = "referenceval" value = "" id = "referenceval">
			<input type = "hidden" name = "accountval" value = "" id = "accountval">
		</form>
		<br>
		<form action = "../confirm/conindex.php" method = "post">
		<input type = "submit" value = "Save" name = "save"> <br><br>


		<?php 
		$inputfields = array('postcode', 'ticket', 'reference');
		foreach ($inputfields as $i)
		{
			$n = $i."val";
			if (!empty($_POST[$i]))
			{

				$$n = $_POST[$i];
			}
			else 
			{
				$$n = "";
			}
		}

		echo'<div id = "extrainfo">
			<label id = "postlabel" for = "postcode"> Postcode: </label> <br>
			<input type = "text" name = "postcode" id = "postcode"value = "'.$postcodeval.'" onblur = "copyvalues(this)"><br><br>
			<label id = "ticketlabel" for ="ticket">Ticket Number: </label><br>
			<input type = "text" name = "ticket" id = "ticket"value = "'.$ticketval.'" onblur = "copyvalues(this)"><br><br>
		</div>
		<div id = "extrainfo2">

			<label id = "reflabel" for = "reference">Reference:</label><br>
			<input type = "text" name = "reference" id = "reference"value = "'.$referenceval.'"onblur = "copyvalues(this)"><br><br>'; ?>


			<label>Account:</label><br>
			<select id = "account" name = "account" onblur = "copyvalues(this)">
				<?php accountselect(); ?>
			</select>
		</div>
		<br><br>
		<?php table_populate($serviceid, $servicename); ?>
		<input type = "hidden" value = <?php echo $basevals['id']; ?> name = "templateid">
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

		function copyvalues(x)
		{
			var name = x.name.concat("val");
			if (name == "accountval")
			{
				var intid = x.options[x.selectedIndex].value;
				document.getElementById(name).value = intid;
			}
			else 
			{
				document.getElementById(name).value = x.value;
			}

		}
		</script>
		<div id ="excess">
		</div>
	</body>
</html>
