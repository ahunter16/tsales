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
			<?php basevals(); ?>
			<br>
			<input action = "?" type = "submit" value = "Save" name = "savebases">
			<br>

			<table>
				<br>
				<?php tablegenerate($serviceid, $servicename);?>
			</table>
			<label class = "martable" >Fill all Price Cells With: <input id = "fillcells" type = "text" onblur = "pricefill()"></label> 
			<br>
			<input class = "martable" type = "submit" Value = "Calculate">
			<input class = "martable" type = "button" value = "Clear" onclick = "clearinput()">

			<br>

		</form>
		<br>
	 	<br>
	 	<label class = "martable0t"><strong>Prices Using Active Base Values (Default):</strong></label><br>
	 	<br>
		<?php global $quotearray;
		global $testarray;
		$x = 0;
		table_populate($serviceid, $servicename, $quotearray, $x); 
		echo '<label class = "martable1t"><strong>Prices Using Test Base Values:</strong></label><br><br>';
		//print_r($testarray);
		$x = 1;
		table_populate($serviceid, $servicename, $testarray, $x);?>
		
		
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
				
/*				function fillit(element, index, array)
				{
					element.value = fillval;
				}
				suppliers.forEach(fillit());*/
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

		function cellhighlight(x)
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
		}
		</script>

	</body>
</html>