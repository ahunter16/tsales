<?php
mb_internal_encoding("UTF-8");

function table_populate()
{
	global $indices;
	$bwidths = array(10,20,30,40,50,100);
	$years = array(1,2,3,4,5);
	$snames = array("ttb" => "TTB", "bts" => "BT 21CN Standard", "btp" => "BT 21CN Premium", "ead" => "BT Openreach EAD", "spd" => "EAD Spread Install");

	echo '<table style = "font-family:\'Tahoma\'; border-collapse:collapse;border:1px solid black; font-size: 13px;">';
	
	echo '
	<td style = "text-align:center; font-family: \'Calibri\'; background-color: rgb(31, 73, 125); color: white; font-size:15px" colspan = ';
	echo (1+2*count($indices)).' >Annual Rental</td></tr>';
	/*echo '<tr>
	<th style = " border: 0px; height: 24px;" class = "side"></th>';*/

	foreach ($indices as $s)
	{	

		$nameindex = substr($s, 0,3);
		//print_r($snames);
		//echo '<th style = "height: 24px; border: 1px solid black; padding: 7px;" colspan = "2">'.$snames[$nameindex].'</th>'."\n";
	}
	
	echo '</tr>
	<tr>
	<th style = "font-family:\'Tahoma\'; background-color: rgb(217,217,217); border-right: 0px; padding: 7px;" class = "side" >Internet (Mbps)</th>';

	foreach($indices as $s)
	{
		echo '
		<th style = "font-family:\'Tahoma\'; background-color: rgb(217,217,217); border-right: 0px; padding: 7px; width: 200px;" ><label > 12 month term </label></th>'."\n".'
		<th style = "font-family:\'Tahoma\'; background-color: rgb(217,217,217); border-left: 0px; padding: 7px; width: 200px;" ><label >36 month term </label></th>';
	}

		foreach ($bwidths as $bdw)
		{	
			echo '<tr>
			<th style = " border-bottom: 1px; border-bottom-color: rgb(217,217,217); padding: 7px;" class = "side"><label>'.$bdw.' Mbps</label></th>'."\n".'</th>';
			
			foreach ($indices as $s)
			{ 
				$yrs = array(1, 3);

				foreach ($yrs as $ys)
				{	$marginindex = array('l', 'm', 'h');

					$y1 = $s.$ys;

					echo'<td 
					style = "border: 1px solid black; padding: 7px;">£
					<label>
					'.$_GET[$y1.$bdw].'
					</label></td>
					'."\n";
				}
			};
		echo "</tr>";
	}
	echo '</table><br>';
}
