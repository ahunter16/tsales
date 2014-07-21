<?php

$bandwidths = array(10, 20, 30, 40, 50, 100);
$form = $_POST;
$cost = 0;

$yrmargin = $basevals['1_yr_margin'];
$discount = $basevals['Discount']/100;

$yrmargin3 = $basevals['3_yr_margin'];
$discount3 = $basevals['Discount']/100 + $basevals['3_year_discount']/100;

if (array_key_exists('eway_price', $form))
{
	$cost = $form['eway_price'];
}
/*if ($form['infoselect'] <= 50)
{
	$discount += (($form['infoselect']/10)-1)/100;
}
else 
{
	$discount += 0.05;
}*/

 
function calculate($base, $form, $ymg, $discount, $cost, $discount3, $ymg3)
{
	if ($_POST['supplier'] == "btopenead")
	{
		$cost = $cost + ($base['Atlas_back']*$form['infoselect']) + $base['Atlas_infrastructure'] + $base['Atlas_support'];
	}
	$cost = $cost + $form['ann_price'] + $base['internet_bandwidth'] * $form['infoselect'] + $base['LES_support'];
	$initmargin = (((($form['infoselect']-10)/10) * $base['margin_ratio']/100) +1) * $ymg;
	//echo $initmargin;
	$initmargin3 = (((($form['infoselect']-10)/10) * $base['margin_ratio']/100) +1) * $ymg3;
	$marginbands = array("h" => ($base['high_margin']/100) - $discount, "m" => ($base['med_margin']/100)-$discount, "l" => ($base['low_margin']/100)-$discount, 
		"h3" => ($base['high_margin']/100) - $discount3, "m3" => ($base['med_margin']/100)-$discount3, "l3" => ($base['low_margin']/100)-$discount3);
	
	$calcresult = array("l" => ($cost + $initmargin*$marginbands['l']), "m" => ($cost + $initmargin*$marginbands['m']), 
		"h" => ($cost + $initmargin*$marginbands['h']), "l3" => ($cost + $initmargin3*$marginbands['l3']), "m3" => ($cost + $initmargin3*$marginbands['m3']), 
		"h3" => ($cost + $initmargin3*$marginbands['h3']));
	


	//print_r($calcresult);
	//echo "<br>";
	return($calcresult);

}
$totalcost = calculate($basevals, $form, $yrmargin, $discount, $cost, $discount3, $yrmargin3);
?>