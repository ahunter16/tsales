<?php
mb_internal_encoding("UTF-8");

function table_populate()
{
	global $indices;
	$bwidths = array(10,20,30,40,50,100);
	$years = array(1,2,3,4,5);
	$snames = array("ttb" => "TTB", "bts" => "BT 21CN Standard", "btp" => "BT 21CN Premium", "ead" => "BT Openreach EAD", "spd" => "EAD Spread Install");

	echo '<table style = "border-collapse:collapse;border:1px solid black; font-size: 10px;">';
	echo '<tr>
	<th style = " height: 24px;" class = "side"></th>';

	foreach ($indices as $s)
	{	

		$nameindex = substr($s, 0,3);
		//print_r($snames);
		echo '<th style = "border: 1px solid black; padding: 5px;" colspan = "2">'.$snames[$nameindex].'</th>'."\n";
	}
	
	echo '</tr>
	<tr>
	<th style = "border: 1px solid black; padding: 5px;" class = "side" >Term</th>';

	foreach($indices as $s)
	{
		echo '
		<th style = "border: 1px solid black; padding: 5px; width: 70px;" ><label > 1 Year </label></th>'."\n".'
		<th style = "border: 1px solid black; padding: 5px; width: 70px;" ><label >3 Years </label></th>';
	}

		foreach ($bwidths as $bdw)
		{	
			echo '<tr>
			<th style = "border: 1px solid black; padding: 5px;" class = "side"><label>'.$bdw.' Mbps</label></th>'."\n".'</th>';
			
			foreach ($indices as $s)
			{ 
				$yrs = array(1, 3);

				foreach ($yrs as $ys)
				{	$marginindex = array('l', 'm', 'h');

					$y1 = $s.$ys;

					echo'<td 
					style = "border: 1px solid black; padding: 5px;">£
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
