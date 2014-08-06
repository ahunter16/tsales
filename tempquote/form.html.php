<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "utf-8">
		<title>Test Base Values</title>
		<link rel="stylesheet" type="text/css" href="calc.css">


	</head>
	<img src="http://www.converged.co.uk/images/page/converged-logo.gif" alt="Image not found">	<br>
	<hr>
	<body>
<!-- 		<iframe src = "../base_values">
			<p> Unsupported</p>
		</iframe> -->
		<form action = "" method = "post" id = "inputform">
			
<!-- 			<iframe id = "baseframe" seamless  height = "122" width = "1400" sandbox = "" src = "iframe" onload = "loadform()"></iframe>
			<br>
 -->
 			<?php basevals(); ?>
			<br>
<!-- 			<input action = "?" type = "submit" value = "Save as Defaults" name = "savebases">
			<input action = "?" type = "submit" value = "Save as Copy" name = "savebases"> -->
			<button type = "submit" value = "default" name = "savebases" >Save As Defaults</button>
			<button type = "submit" value = "copy" name = "savebases" >Save As Copy</button>
			<br>

			<table>
				<br>
				<?php tablegenerate($serviceid, $servicename);?>
			</table>
			<label class = "martable" >Fill all Price Cells With: <input id = "fillcells" type = "text" onblur = "pricefill()"></label> 
			<br>
			<input class = "martable" type = "submit" Value = "Calculate" >
			<input class = "martable" type = "button" value = "Clear" onclick = "loadform()">

			<br>

		</form>
		<!-- <p id = "pform">Hi</p> -->
		<br>
	 	<br>
	 	<form action = "../confirm/conindex.php" method = "post">
 		<input type = "submit" value = "Save" name = "save"> <br><br>
		<label class = "martable1t"><strong>Prices Using Test Base Values:</strong></label><br><br>


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
		<?php global $quotearray;
		global $testarray;
		//table_populate($serviceid, $servicename, $quotearray, $x); 

		//print_r($testarray);
		$x = 1;
		table_populate($serviceid, $servicename, $testarray, $x);
		
		?>
		<input type = "hidden" name = "templateid" value = <?php echo $lasttemplate['id'];?> >
		<!-- <input type = "hidden" value = "" name = "templateid"> -->
		</form>
		<script>

		
		function pricefill()
		{
			var fillval = document.getElementById("fillcells").value;
			var suppliers = <?php echo json_encode($serviceid); ?>;
			var colname = ["ann", "1yr", "3yr"];
			var colname1 = ["ann", "ins"];
			var bandwidths = ["10","20","30","40","50","100"];
			var bw = bandwidths.length;
			var supp = suppliers.length;
			var cols = colname.length;
			var cols1 = colname1.length;
			if (fillval || fillval == 0)
			{

				for(var i = 0; i < bw; i++)
				{
					for (var j = 0; j < supp; j++)
					{	
						if (suppliers[j] != "i4" && suppliers[j] != "i5")
						{
							for (var k = 0; k < cols; k ++)
							{
								var joined = suppliers[j].concat(colname[k]);
								var index = joined.concat(bandwidths[i]);
								document.getElementById(index).value = fillval;
								document.getElementById(index).value = fillval;
							}
						}
						else if (suppliers[j] != "i5")
						{
							for (var k = 0; k < cols1; k ++)
							{
								var joined = suppliers[j].concat(colname1[k]);
								var index = joined.concat(bandwidths[i]);
								document.getElementById(index).value = fillval;
								document.getElementById(index).value = fillval;
							}
						}
					}
				}
			}
		}
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
		//functions to highlight cells in neighbouring tables; these tables no longer exist, but functions may be altered and recycled
		/*function cellhighlight(x)
		{
			//document.getElementById("btstot10").innerHTML = x.id;
			if ((x.id).slice(-1) == 1)
			{	
				var cellid = (x.id).slice(0,-1) + 0;
			}
			if ((x.id).slice(-1) == 0)
			{	
				var cellid = (x.id).slice(0,-1) + 1;
			}
			document.getElementById(cellid).style.border="3px solid red";
		}
		function cellunhighlight(x)
		{
			if ((x.id).slice(-1) == 1)
			{	
				var cellid = (x.id).slice(0,-1) + 0;
			}
			if ((x.id).slice(-1) == 0)
			{	
				var cellid = (x.id).slice(0,-1) + 1;
			}
			document.getElementById(cellid).style.border="1px solid black";
		}*/
		</script>

	</body>
</html>