<?php





/*if (array_key_exists('eway_price', $form))
{
	$cost = $form['eway_price'];
}*/

function calculate($base, $f /*$cost, */)
{
	global $eadcheck;
	global $spdcheck;
	global $btcheck;
	global $bw;
	//echo "formula: ".$bw;
	$cost = 0;
	$discount = $base['Discount']/100;
	$discount3 = $base['Discount']/100 + $base['3_Year_Discount']/100;

	if ($eadcheck)
	{
		$cost += ($base['Atlas_Backbone']) + $base['Atlas_Infrastructure'] + $base['Atlas_Support'];
	}

	if ($spdcheck)
	{ 
		$spread1 = $_POST['eadins'.$bw];
		$spread3 = $spread1/3;
	}

	else
	{
		$spread1 = 0;
		$spread3 = 0;
	}

	if ($btcheck && isset($_POST['wayann'.$bw]))
	{
		$cost += $_POST['wayann'.$bw];
	}



	$cost += $f + $base['Internet_Bandwidth'] + $base['LES_Support'];
	$initmargin = /*(($base['Margin_Ratio']/100) +1) * */$base['1_Year_Margin'];

	$initmargin3 = /*(($base['Margin_Ratio']/100) +1) * */$base['3_Year_Margin'];
	$marginbands = array("h" => ($base['High_Margin']/100) - $discount, "m" => ($base['Med_Margin']/100)-$discount, "l" => ($base['Low_Margin']/100)-$discount, 
		"h3" => ($base['High_Margin']/100) - $discount3, "m3" => ($base['Med_Margin']/100)-$discount3, "l3" => ($base['Low_Margin']/100)-$discount3);
	
	$calcresult = array("l1" => round(($cost + $initmargin*$marginbands['l'] + $spread1), 2), "m1" => round (($cost + $initmargin*$marginbands['m'] + $spread1), 2), 
		"h1" => round (($cost + $initmargin*$marginbands['h'] + $spread1), 2), "l3" => round (($cost + $initmargin3*$marginbands['l3'] + $spread3), 2), "m3" => round (($cost + $initmargin3*$marginbands['m3'] + $spread3), 2), 
		"h3" => round (($cost + $initmargin3*$marginbands['h3'] + $spread3), 2));
	

	return($calcresult);

}
;
?>