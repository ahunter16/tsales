<?php
mb_internal_encoding("UTF-8");
function Tablegenerate ($serviceid, $servicename)
{	$bwidths = array(10,20,30,40,50,100);
	$margins = array('Low Margin', 'Medium Margin', 'High Margin');
	//$supp = $serviceid;	
	$servicearray = array_combine($serviceid, $servicename);								



	echo 												//CHANGE: zebra stripe the tables
	'<table><tr>
	<th class = "side">Supplier</th>';
	foreach ($servicearray as $id => $name)
	{	
		
		if($id != "i5" && $id != "i4")
		{
			echo '<td align = "center" class = "i'.$id.'" colspan = "3"><strong>'.$name.'</strong></td>';
		}
		else if ($id == "i4")
		{
			echo '<td align = "center" class = "i'.$id.'" colspan = "2"><strong>'.$name.'</strong></td>';
		}


	}
	function colcheck($colno)
	{
		if ($colno == 0)
		{
			$colno = 1;
		}
		else
		{
			$colno = 0;
		}
	}

	echo'</tr>
	<tr>
	<th class = "side" >Bandwidth Mbps</th>';
	$colno = 0;
	foreach ($servicearray as $id => $name)
	{
		if ($id != "i4" && $id != "i5")
		{
			echo '<td align = "center"><strong>Annual Rental</strong></td>';

			echo '<td align = "center"><strong>1 Year Install</strong></td>';
			echo '<td align = "center"><strong>3 Year Install</strong></td>';
		}
		else if ($id != "i5")
			echo '
				<td align = "center"><strong>Annual Rental</strong></td>
				<td align = "center"><strong>Install</strong></td>';
		
	}
	echo '</tr>';
							


		foreach ($bwidths as $b)			
		{ 	
			foreach ($servicearray as $id => $name)
			{
				$columns = array();
				if ($id != "i5" && $id != "i4")
				{
					$columns = array("ann", "1yr", "3yr");
				}

				else if ($id == "i4")
				{
					$columns = array("ann", "ins");
				}
				foreach ($columns as $colhead)
				{
					$cellval = $id.$colhead;
					if (isset($_POST[$id.$colhead.$b]) && $_POST[$id.$colhead.$b] != "" )
					{
						$$cellval = $_POST[$id.$colhead.$b];

					}
					else {$$cellval = "";}

				}
			}


								//CHANGE: Variable suppliers
		echo '<tr>				
			<th class = "side">'.$b.'</th>';
			foreach ($servicearray as $id => $name)
			{
				$columns = array();
				if ($id != "i5" && $id != "i4")
				{
					$columns = array("ann", "1yr", "3yr");
				}

				else if ($id == "i4")
				{
					$columns = array("ann", "ins");
				}
				$colno = 0;
				foreach ($columns as $colhead)
				{	
					$cellval = $id.$colhead;
					echo '<td>&pound<input type = "text" class = "inputtext bg'.$colno.'" name = "'.$id.$colhead.$b.'" value = "' .$$cellval.'" ></td>';
					colcheck($colno);
				}
			}

		};
			echo '</table><br>';
}
function table_populate($serviceid, $servicename)		//CHANGE: variable bandwidths, Years, suppliers THROUGHOUT
{	$bwidths = array(10,20,30,40,50,100);
	$margins = array('l' => 'Low Margin', 'm' => 'Medium Margin', 'h' => 'High Margin');
	$marginindex = array('l', 'm', 'h');
	$supp = array("i1", "i2", "i3", "i4", "i5");
	$servicearray = array_combine($serviceid, $servicename);								
	global $quotearray;

	foreach ($marginindex as $m)
	{echo '<br><table><tr>
			<th class = "side">'.$margins[$m].'</th>';
			foreach ($servicearray as $id => $name)
			{
				echo '<th colspan = "2"><label>'.$name.'<input type = "checkbox" name = "'.$id.$m.'" value = "'.$id.$m.'"></label></th>';
			}

			echo '</tr>
			<tr>
			<th class = "side" >Term</th>';
			foreach($servicename as $s){echo '
				<td align = "center" class = "'.$s.$m.'1 '.$s.'i1"><strong><label for = "'.$s.$m.'1"> 1 Year </label></strong></td>'."\n".'
				<td align = "center" class = "'.$s.$m.'3 '.$s.'i3"><strong><label for = "'.$s.$m.'3">3 Years </label></strong></td>
			';}

		foreach ($bwidths as $bdw)
		{	global $quotearray;

			echo '<tr>
			<th class = "side">'.$bdw.' Mbps</th>';
			foreach ($serviceid as $s){ 
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

					if (isset($quotearray[$bdw]))
					{
						if (array_key_exists($s, $quotearray[$bdw]))
						{

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
					echo'<td class = "'.$s.'i'.$ys.'">&pound<input type = "text" name = "'.$s.$y1.$bdw.'" value = "'.$sub1.'" class = "bg'.$colno.'" ></td>'."\n";
					if ($colno == 0)
					{
						$colno = 1;
					}
					else
					{
						$colno = 0;
					}
				}
		};
		echo "</tr>";}
		echo '</table><br>';
	}
	}
