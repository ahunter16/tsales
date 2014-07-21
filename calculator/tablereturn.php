<?php
mb_internal_encoding("UTF-8");
function Tablegenerate ()
{	$bwidths = array(10,20,30,40,50,100);
	$margins = array('Low Margin', 'Medium Margin', 'High Margin');
	$years = array(1,2,3,4,5);

	echo 
	'<table><tr>
	<th class = "side">Supplier</th>
	<th class = "ttb" colspan = "3">TalkTalk Business</th>
	<th class = "bt" colspan = "3">BT 21CN Etherway</th>
	<th class = "bt" colspan = "2">BT 21CN Etherflow Standard CoS</th>
	<th class = "bt" colspan = "2">BT 21CN Etherflow Premium CoS</th>
	<th class = "ead" colspan = "2">BT Openreach EAD</th></tr>
	</tr>
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
	</tr>';


		foreach ($bwidths as $b)
		{ 
			if (isset($_POST['ttbann'.$b]) && $_POST['ttbann'.$b] != "" )
			{
				$ttbann = $_POST['ttbann'.$b];

			}
			else {$ttbann = "";}
			if (isset($_POST['ttb1yr'.$b]) && $_POST['ttb1yr'.$b] != "" )
			{
				$ttb1yr = ($_POST['ttb1yr'.$b]);
			}
			else {$ttb1yr = "";}
			if (isset($_POST['ttb3yr'.$b]) && $_POST['ttb3yr'.$b] != "" )
			{
				$ttb3yr = ($_POST['ttb3yr'.$b]);
			}
			else {$ttb3yr = "";}
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
			if (isset($_POST['btsann'.$b]) && $_POST['btsann'.$b] != "" )
			{
				$btsann = ($_POST['btsann'.$b]);
			}
			else {$btsann = "";}
			if (isset($_POST['btpann'.$b]) && $_POST['btpann'.$b] != "" )
			{
				$btpann = ($_POST['btpann'.$b]);
			}
			else {$btpann = "";}
			if (isset($_POST['eadann'.$b]) && $_POST['eadann'.$b] != "" )
			{
				$eadann = ($_POST['eadann'.$b]);
			}
			else {$eadann = "";}
			if (isset($_POST['eadins'.$b]) && $_POST['eadins'.$b] != "" )
			{
				$eadins = ($_POST['eadins'.$b]);
			}
			else {$eadins = "";}

			if (!empty($wayann) || !empty($btsann) || !empty($btpann))
			{
				$btstot = $wayann + $btsann;
				$btptot = $wayann + $btpann;
			}
			else 
			{
				$btstot = "";
				$btptot = "";
			}

		//echo "ttbann".$b." ".$ttbann;
			//onblur = "formsub()"
		echo '<tr>
			<th class = "side">'.$b.'</th>
			<td>£<input type = "text" class = "inputtext" name = "ttbann'.$b.'" id = "ttbann'.$b.'" value = "'.$ttbann.'"></td>
			<td>£<input type = "text" class = "inputtext" name = "ttb1yr'.$b.'" id = "ttb1yr'.$b.'" value = "'.$ttb1yr.'"></td>
			<td>£<input type = "text" class = "inputtext" name = "ttb3yr'.$b.'" id = "ttb3yr'.$b.'" value = "'.$ttb3yr.'"></td>
			<td>£<input type = "text" class = "inputtext" name = "wayann'.$b.'" id = "wayann'.$b.'" value = "'.$wayann.'"></td>
			<td>£<input type = "text" class = "inputtext" name = "way1yr'.$b.'" id = "way1yr'.$b.'" value = "'.$way1yr.'"></td>
			<td>£<input type = "text" class = "inputtext" name = "way3yr'.$b.'" id = "way3yr'.$b.'" value = "'.$way3yr.'"></td>
			<td>£<input type = "text" class = "inputtext" name = "btsann'.$b.'" id = "btsann'.$b.'" value = "'.$btsann.'" onblur = "ewayadd()"></td>
			<td class = "btsi1" >£<label id = "btstot'.$b.'">'.$btstot.'</label></input></td>
			<td>£<input type = "text" class = "inputtext" name = "btpann'.$b.'" id = "btpann'.$b.'" value = "'.$btpann.'" onblur = "ewayadd()"></td>
			<td class = "btsi1" >£<label  id = "btptot'.$b.'">'.$btptot.'</label></td>	
			<td>£<input type = "text" class = "inputtext" name = "eadann'.$b.'" id = "eadann'.$b.'" value = "'.$eadann.'"></td>				
			<td>£<input type = "text" class = "inputtext" name = "eadins'.$b.'" id = "eadins'.$b.'" value = "'.$eadins.'"></td></tr>';
		};
			echo '</table><br>';
}
function table_populate()
{	$bwidths = array(10,20,30,40,50,100);
	$margins = array('l' => 'Low Margin', 'm' => 'Medium Margin', 'h' => 'High Margin');
	$years = array(1,2,3,4,5);
	$marginindex = array('l', 'm', 'h');
	$supp = array("ttb", "bts", "btp", "ead", "spd");

	global $quotearray;
				//echo "QUOTEARRAY: <br>";
			//print_r($quotearray);
	foreach ($marginindex as $m)
	{echo '<br><table><tr>
			<th class = "side">'.$margins[$m].'</th>
			<th class = "ttb" colspan = "2"><label>TTB<input type = "checkbox" name = "ttb'.$m.'" value = "ttb'.$m.'"></label></th>
			<th class = "bt" colspan = "2"><label>BT 21CN Standard<input type = "checkbox" name = "bts'.$m.'" value = "bts'.$m.'"></label></th>
			<th class = "bt" colspan = "2"><label>BT 21CN Premium<input type = "checkbox" name = "btp'.$m.'" value = "btp'.$m.'"></label></th>
			<th class = "ead" colspan = "2"><label>BT Openreach EAD<input type = "checkbox" name = "ead'.$m.'" value = "ead'.$m.'"></label></th>
			<th class = "ead" colspan = "2"><label>EAD Spread Install<input type = "checkbox" name = "spd'.$m.'" value = "spd'.$m.'"></label></th>
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
					$sub1 = '--';
					if ($bdw == "")
					{$bdw = 10;}
					if (isset($quotearray[$bdw])){
					if (array_key_exists($s, $quotearray[$bdw])){
					//echo "bws: ".$bwnums[$s][$y1]." ";
					if ($quotearray[$bdw][$s][$y1]!= "") 
					{
						$sub1 = $quotearray[$bdw][$s][$y1];
					} 
					else 
					{
						$sub1 = '  --';
					}
				}}
				else {$sub1 = '  --';}
					echo'<td class = "'.$s.'i'.$ys.'">£<input type = "text" name = "'.$s.$y1.$bdw.'" value = "'.$sub1.'" class = "'.$s.'i'.$ys.'" ></td>'."\n";
				}

		};
		echo "</tr>";}
		echo '</table><br>';
	}
	}
