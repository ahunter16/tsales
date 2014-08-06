<?php

function calculate($base, $f, $band /*$cost, */)
{	/*echo "BASE";
	print_r($base);
	echo "	END";*/
	global $i4check;
	global $i5check;
	global $btcheck;
	

	//echo "formula: ".$bw;
	$cost = 0;
	if ($band < 100)
	{

		$discount = (($band/10) -1)*$base['flodiscount']/100;
	}
	else 
	{
		$discount = 5 * $base['flodiscount']/100;
	}
	
	$discount3 = $discount + $base['flo3yeardiscount']/100;


	if ($i4check)
	{
		$cost += ($base['floatlasbackboneppm']*$band) + $base['floatlasinfrastructure'] + $base['floatlassupport'];
	}

	if ($i5check)
	{ 
		$spread1 = $_POST['i4ins'.$band];
		$spread3 = $spread1/3;
	}

	else
	{
		$spread1 = 0;
		$spread3 = 0;
	}

	$margin = ($band-10)*($base['flomarginratio']/1000);

/*	if ($btcheck && isset($_POST['wayann'.$bw]))
	{
		$cost += $_POST['wayann'.$bw];
	}*/
	//echo " SPREAD ".$spread1;
	$cost += $f + ($base['flointernetbandwidthppm']*$band) + $base['flolessupport'];
	
	$startmargin = $base['flo1yearstartingmargin']*(1+$margin);
	$startmargin3 = $base['flo3yearstartingmargin']*(1+$margin);
	$marginbands = array(
		"h" => ($base['flo1yearhighmargin']/100)-$discount,
		"m" => ($base['flo1yearmediummargin']/100)-$discount,
		"l" => ($base['flo1yearlowmargin']/100)-$discount, 
		"h3" => ($base['flo3yearhighmargin']/100)-$discount3,
		"m3" => ($base['flo3yearmediummargin']/100)-$discount3,
		"l3" => ($base['flo3yearlowmargin']/100)-$discount3);
	
	$calcresult = array(
		"l1" => round (($cost + $startmargin*$marginbands['l'] + $spread1), 2),
		"m1" => round (($cost + $startmargin*$marginbands['m'] + $spread1), 2), 
		"h1" => round (($cost + $startmargin*$marginbands['h'] + $spread1), 2),
		"l3" => round (($cost + $startmargin3*$marginbands['l3'] + $spread3), 2),
		"m3" => round (($cost + $startmargin3*$marginbands['m3'] + $spread3), 2), 
		"h3" => round (($cost + $startmargin3*$marginbands['h3'] + $spread3), 2));
	
	return($calcresult);

}
;
?>