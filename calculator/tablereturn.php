<?php
mb_internal_encoding("UTF-8");
function Tablegenerate ($serviceid, $servicename)
{	$bwidths = array(10,20,30,40,50,100);
	$margins = array('Low Margin', 'Medium Margin', 'High Margin');
	$supp = $serviceid;									//TODO: combine serviceid and servicenames??
	$supp[] = "way";


	echo 												//CHANGE: remove classes and simply zebra stripe the tables
	'<table><tr>
	<th class = "side">Supplier</th>';
/*	'<th class = "ttb" colspan = "3">TalkTalk Business</th>				//TODO: foreach $serviceid, echo the corresponding name
	<th class = "bt" colspan = "3">BT 21CN Etherway</th>
	<th class = "bt" colspan = "2">BT 21CN Etherflow Standard CoS</th>
	<th class = "bt" colspan = "2">BT 21CN Etherflow Premium CoS</th>
	<th class = "ead" colspan = "2">BT Openreach EAD</th></tr>*/
	echo'</tr>
	<tr>
	<th class = "side" >Bandwidth Mbps</th>
	<th class = "ttb"> Annual Rental</th>
	<th class = "ttb">1 Year Install</th>
	<th class = "ttb">3 Year Install</th>	
	<th class = "bt"> Annual Rental</th>
	<th class = "bt">1 Year Install</th>
	<th class = "bt">3 Year Install</th>
	<th class = "bt">Annual Rental</th>
	<th class = "bt">Total Price Inc. Etherway</th>
	<th class = "bt">Annual Rental</th>
	<th class = "bt">Total Price Inc. Etherway</th>
	<th class = "ead">Annual Rental</th>
	<th class = "ead">Install</th>
	</tr>'; 								//TODO: foreach $serviceid after (or including) openreach ead, echo their names


		foreach ($bwidths as $b)			//CHANGE: allow for variable number of suppliers
		{ 
			if (isset($_POST['i1ann'.$b]) && $_POST['i1ann'.$b] != "" )
			{
				$i1ann = $_POST['i1ann'.$b];

			}
			else {$i1ann = "";}
			if (isset($_POST['i11yr'.$b]) && $_POST['i11yr'.$b] != "" )
			{
				$i11yr = ($_POST['i11yr'.$b]);
			}
			else {$i11yr = "";}
			if (isset($_POST['i13yr'.$b]) && $_POST['i13yr'.$b] != "" )
			{
				$i13yr = ($_POST['i13yr'.$b]);
			}
			else {$i13yr = "";}
			if (isset($_POST['wayann'.$b]) && $_POST['wayann'.$b] != "" )
			{
				$wayann = ($_POST['wayann'.$b]);
			}
			else {$wayann = "";}
			if (isset($_POST['way1yr'.$b]) && $_POST['way1yr'.$b] != "" )
			{
				$way1yr = ($_POST['way1yr'.$b]);
			}
			else {$way1yr = "";}
			if (isset($_POST['way3yr'.$b]) && $_POST['way3yr'.$b] != "" )
			{
				$way3yr = ($_POST['way3yr'.$b]);
			}
			else {$way3yr = "";}
			if (isset($_POST['i2ann'.$b]) && $_POST['i2ann'.$b] != "" )
			{
				$i2ann = ($_POST['i2ann'.$b]);
			}
			else {$i2ann = "";}
			if (isset($_POST['i3ann'.$b]) && $_POST['i3ann'.$b] != "" )
			{
				$i3ann = ($_POST['i3ann'.$b]);
			}
			else {$i3ann = "";}
			if (isset($_POST['i4ann'.$b]) && $_POST['i4ann'.$b] != "" )
			{
				$i4ann = ($_POST['i4ann'.$b]);
			}
			else {$i4ann = "";}
			if (isset($_POST['i4ins'.$b]) && $_POST['i4ins'.$b] != "" )
			{
				$i4ins = ($_POST['i4ins'.$b]);
			}
			else {$i4ins = "";}

			if (!empty($wayann) || !empty($i2ann) || !empty($i3ann))
			{
				$i2tot = $wayann + $i2ann;
				$i3tot = $wayann + $i3ann;
			}
			else 
			{
				$i2tot = "";
				$i3tot = "";
			}

								//CHANGE: Variable suppliers
		echo '<tr>				
			<th class = "side">'.$b.'</th>
			<td>&pound<input type = "text" class = "inputtext" name = "i1ann'.$b.'" id = "i1ann'.$b.'" value = "'.$i1ann.'"></td>
			<td>&pound<input type = "text" class = "inputtext" name = "i11yr'.$b.'" id = "i11yr'.$b.'" value = "'.$i11yr.'"></td>
			<td>&pound<input type = "text" class = "inputtext" name = "i13yr'.$b.'" id = "i13yr'.$b.'" value = "'.$i13yr.'"></td>
			<td>&pound<input type = "text" class = "inputtext" name = "wayann'.$b.'" id = "wayann'.$b.'" value = "'.$wayann.'"></td>
			<td>&pound<input type = "text" class = "inputtext" name = "way1yr'.$b.'" id = "way1yr'.$b.'" value = "'.$way1yr.'"></td>
			<td>&pound<input type = "text" class = "inputtext" name = "way3yr'.$b.'" id = "way3yr'.$b.'" value = "'.$way3yr.'"></td>
			<td>&pound<input type = "text" class = "inputtext" name = "i2ann'.$b.'" id = "i2ann'.$b.'" value = "'.$i2ann.'" onblur = "ewayadd()"></td>
			<td class = "btsi1" >&pound<label id = "i2tot'.$b.'">'.$i2tot.'</label></input></td>
			<td>&pound<input type = "text" class = "inputtext" name = "i3ann'.$b.'" id = "i3ann'.$b.'" value = "'.$i3ann.'" onblur = "ewayadd()"></td>
			<td class = "btsi1" >&pound<label  id = "i3tot'.$b.'">'.$i3tot.'</label></td>	
			<td>&pound<input type = "text" class = "inputtext" name = "i4ann'.$b.'" id = "i4ann'.$b.'" value = "'.$i4ann.'"></td>				
			<td>&pound<input type = "text" class = "inputtext" name = "i4ins'.$b.'" id = "i4ins'.$b.'" value = "'.$i4ins.'"></td></tr>';
		};
			echo '</table><br>';
}
function table_populate()					//CHANGE: variable bandwidths, Years, suppliers THROUGHOUT
{	$bwidths = array(10,20,30,40,50,100);
	$margins = array('l' => 'Low Margin', 'm' => 'Medium Margin', 'h' => 'High Margin');
	$marginindex = array('l', 'm', 'h');
	$supp = array("i1", "i2", "i3", "i4", "i5");

	global $quotearray;
				//echo "QUOTEARRAY: <br>";
			//print_r($quotearray);
	foreach ($marginindex as $m)
	{echo '<br><table><tr>
			<th class = "side">'.$margins[$m].'</th>
			<th class = "ttb" colspan = "2"><label>TTB<input type = "checkbox" name = "i1'.$m.'" value = "i1'.$m.'"></label></th>
			<th class = "bt" colspan = "2"><label>BT 21CN Standard<input type = "checkbox" name = "i2'.$m.'" value = "i2'.$m.'"></label></th>
			<th class = "bt" colspan = "2"><label>BT 21CN Premium<input type = "checkbox" name = "i3'.$m.'" value = "i3'.$m.'"></label></th>
			<th class = "ead" colspan = "2"><label>BT Openreach EAD<input type = "checkbox" name = "i4'.$m.'" value = "i4'.$m.'"></label></th>
			<th class = "ead" colspan = "2"><label>EAD Spread Install<input type = "checkbox" name = "i5'.$m.'" value = "i5'.$m.'"></label></th>
			</tr>
			<tr>
			<th class = "side" >Term</th>';
			foreach($supp as $s){echo '
				<th class = "'.$s.$m.'1 '.$s.'i1"><label for = "'.$s.$m.'1"> 1 Year </label></th>'."\n".'
				<th class = "'.$s.$m.'3 '.$s.'i3"><label for = "'.$s.$m.'3">3 Years </label></th>
			';}

		foreach ($bwidths as $bdw)
		{	global $quotearray;
/*			echo $bdw;
			echo "<br> BWSWWS: ";
			print_r($quotearray[$bdw]['ttb']['l']);*/
			echo '<tr>
			<th class = "side">'.$bdw.' Mbps</th>';
			foreach ($supp as $s){ 
				$yrs = array(1, 3);

				foreach ($yrs as $ys)
				{	global $bdw;
					$y1 = $m.$ys;
					$sub1 = ' -';
					if ($bdw == "")
					{
						$bdw = 10;
					}

					if (isset($quotearray[$bdw]))
					{
						if (array_key_exists($s, $quotearray[$bdw]))
						{
					//echo "bws: ".$bwnums[$s][$y1]." ";
							if ($quotearray[$bdw][$s][$y1]!= "") 
							{
								$sub1 = $quotearray[$bdw][$s][$y1];
							} 
							else 
							{
								$sub1 = '  --';
							}
						}
						else
						{	
						
							$sub1 = ' ---';
						}	
					}
					else {$sub1 = '  ----';}
					echo'<td class = "'.$s.'i'.$ys.'">&pound<input type = "text" name = "'.$s.$y1.$bdw.'" value = "'.$sub1.'" class = "'.$s.'i'.$ys.'" ></td>'."\n";
				}

		};
		echo "</tr>";}
		echo '</table><br>';
	}
	}
