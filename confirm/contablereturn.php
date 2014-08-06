<?php
mb_internal_encoding("UTF-8");

function accountselect()
{
	global $accounts;
	foreach ($accounts as $id => $aname)
	{
		echo '<option value = "'.$id.'">'.$aname.'</option>';
	}
}



function table_populate($servicearray)		//CHANGE: variable bandwidths, Years, suppliers THROUGHOUT
{	$bwidths = array(10,20,30,40,50,100);
	
	global $quotearray;
	$s = substr($_REQUEST['supplier'], 0, -1);
	$m = substr($_REQUEST['supplier'], -1);
	$name = $servicearray["i".substr($s, -1)];

	echo '<br><table id = "confirmtable"><tr>';
				echo '<th colspan = "5"><label>'.$name.'</label></th>';
			

			echo '</tr>
			<tr>
			<th class = "side" >Term</th>';
			echo '
				<td align = "center" class = "'.$s.$m.'1 '.$s.'i1"><strong><label> 1 Year </label></strong></td>'."\n".'
				<td align = "center" class = "'.$s.$m.'3 '.$s.'i3"><strong><label>3 Years </label></strong></td>
			';
		if ($s != "i5")
		{
			echo '
			<th align = "center" class = "'.$s.$m.'1"<label> 1 Year Install</label></th>'."\n".'
			<th align = "center" class = "'.$s.$m.'3"<label> 3 Year Install</label></th>';
		}
		foreach ($bwidths as $bdw)
		{	
			
			echo '<tr>
			<th class = "side">'.$bdw.' Mbps</th>';
			 
				$yrs = array(1, 3);
				$colno = 0;
				foreach ($yrs as $ys)
				{	global $bdw;
					$y1 = $m.$ys;
					$sub1 = ' -';
					if ($bdw == "")
					{
						$bdw = 10;
					}


					if ($_REQUEST[$s.$y1.$bdw]!= "") 
					{
						$sub1 = $_REQUEST[$s.$y1.$bdw];
					} 
					else 
					{
						$sub1 = '  --';
					}
					
					echo'
					<td class = "'.$s.'i'.$ys.'"  >&pound <label name = "'.$s.$y1.$bdw.'"> '.$sub1.'</label></td>'."\n".'
					<input type = "hidden" value = "'.$sub1.'" name = "'.$s.$y1.$bdw.'">
					<input type = "hidden" value = "'.$_REQUEST[$s.$y1."mar".$bdw].'" name = "'.$s.$y1."mar".$bdw.'">
					<input type = "hidden" value = "'.$_REQUEST[$s.$y1."cost".$bdw].'" name = "'.$s.$y1."cost".$bdw.'">';



					/*$_POST['values'][$s.$y1.$bdw] = $sub1;*/
					if ($colno == 0)
					{
						$colno = 1;
					}
					else
					{
						$colno = 0;
					}
				}
				if ($s != "i4" && $s != "i5")
				{
					echo '
					<td class = "'.$s.'i1" >&pound '.$_REQUEST[$s."1yr".$bdw].'<label name = "'.$s.'1yr'.$bdw.'">'."\n".'
					<td class = "'.$s.'i3" >&pound '.$_REQUEST[$s."3yr".$bdw].'<label name = "'.$s.'3yr'.$bdw.'">
					<input type = "hidden" value = "'.$_REQUEST[$s."1yr".$bdw].'" name = "'.$s.'1yr'.$bdw.'">
					<input type = "hidden" value = "'.$_REQUEST[$s."3yr".$bdw].'" name = "'.$s.'3yr'.$bdw.'">';

				}
				elseif ($s == "i4")
				{
					echo '
					<td class = "'.$s.'i1" name = "'.$s.'1yr'.$bdw.'"">&pound '.$_REQUEST[$s."ins".$bdw].'
					<td class = "'.$s.'i1" name = "'.$s.'3yr'.$bdw.'">&pound --';
					echo '<input type = "hidden" value = "'.$_REQUEST[$s."ins".$bdw].'" name = "'.$s.'1yr'.$bdw.'">
					<input type = "hidden" value = "0" name = "'.$s.'3yr'.$bdw.'">';
/*
					$_POST['values'][$s.'1yr'.$bdw] = $_REQUEST[$s."ins".$bdw];
					$_POST['values'][$s.'3yr'.$bdw] = 0;*/

				}
		};
		echo "</tr>";
		echo '<input type = "hidden" value = "'.$_REQUEST['supplier'].'" name = "supplier">';
}
		echo '</table><br>';
		
/*		$_POST['values']['supplier'] = $_REQUEST['supplier'];*/

	
	
