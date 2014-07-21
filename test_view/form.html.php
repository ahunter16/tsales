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
			<br><br>

			<table>

				<?php tablegenerate();?>
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
		table_populate($quotearray, $x); 
		echo '<label class = "martable1t"><strong>Prices Using Test Base Values:</strong></label><br><br>';
		//print_r($testarray);
		$x = 1;
		table_populate($testarray, $x);?>
		
		
		<script>

		function pricefill()
		{
			var fillval = document.getElementById("fillcells").value;
			var suppliers = ["ttbann", "ttb1yr", "ttb3yr", "wayann", "way1yr", "way3yr", "btsann", "btpann", "eadann", "eadins"];
			var bandwidths = ["10","20","30","40","50","100"];
			var bw = bandwidths.length;
			var supp = suppliers.length;
			if (fillval || fillval == 0)
			{
				for(var i = 0; i < bw; i++)
				{
					for (var j = 0; j < supp; j++)
					{
						var index = suppliers[j].concat(bandwidths[i]);
						document.getElementById(index).value = fillval;
						document.getElementById(index).value = fillval;
					}
					var btstot = "btstot".concat(bandwidths[i]);
					var btptot = "btptot".concat(bandwidths[i]);
					document.getElementById(btstot).innerHTML = 2*fillval;
					document.getElementById(btptot).innerHTML = 2*fillval;
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