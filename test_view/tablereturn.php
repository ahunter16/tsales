<?php

mb_internal_encoding("UTF-8");
function accountselect()
{
	global $accounts;
	foreach ($accounts as $id => $aname)
	{
		echo '<option value = "'.$id.'">'.$aname.'</option>'."\n";
	}
}
function Tablegenerate ($serviceid, $servicename)
{	$bwidths = array(10,20,30,40,50,100);
	$margins = array('Low Margin', 'Medium Margin', 'High Margin');
	//$supp = $serviceid;	
	$servicearray = array_combine($serviceid, $servicename);								



	echo 												//CHANGE: zebra stripe the tables
	'<table id = "starttable"><tr>
	<th class = "side">Supplier</th>';
	foreach ($servicearray as $id => $name)
	{	
		
		if($id != "i5" && $id != "i4")
		{
			echo '<th align = "center" class = "i'.$id.'" colspan = "3"><strong>'.$name.'</strong></th>';
		}
		else if ($id == "i4")
		{
			echo '<th align = "center" class = "i'.$id.'" colspan = "2"><strong>'.$name.'</strong></th>';
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
					else 
					{
						$$cellval = "";
					}


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
					echo '<td>&pound <input type = "text" class = "inputtext bg'.$colno.'" id ="'.$id.$colhead.$b.'" name = "'.$id.$colhead.$b.'" value = "' .$$cellval.'" ></td>';
					colcheck($colno);
				}
			}

		};
			echo '</table><br>';
}
function table_populate($serviceid, $servicename, $valuearray, $x)
{	
	$bwidths = array(10,20,30,40,50,100);
	$margins = array('l' => 'Low Margin', 'm' => 'Medium Margin', 'h' => 'High Margin');
	$marginindex = array('l', 'm', 'h');
	$supp = array("i1", "i2", "i3", "i4", "i5");
	$servicearray = array_combine($serviceid, $servicename);								
	//global $valuearray;

	foreach ($marginindex as $m)
	{echo '<br><table id = "'.$m.$x.'t" class = "resulttable"><tr>
			<th class = "side">'.$margins[$m].'</th>'; //<input type = "radio" id = "'.$m.$x.'r" style = "display:none;">
			foreach ($servicearray as $id => $name)
			{
				echo '<th colspan = "2"><label>'.$name.'<input type = "radio" name = "supplier" value = "'.$id.$m.'"></label></th>'; //'<input type = "checkbox" name = "'.$id.$m.'" value = "'.$id.$m.'">
			}

			echo '</tr>
			<tr>
			<th class = "side" >Term</th>';
			foreach($servicename as $s){echo '
				<td align = "center" class = "'.$s.$m.'1 '.$s.'i1"><strong><label for = "'.$s.$m.'1"> 1 Year </label></strong></td>'."\n".'
				<td align = "center" class = "'.$s.$m.'3 '.$s.'i3"><strong><label for = "'.$s.$m.'3">3 Years </label></strong></td>
			';}

		foreach ($bwidths as $bdw)
		{	//global $valuearray;

			echo '<tr>
			<th class = "side">'.$bdw.' Mbps</th>';
			foreach ($serviceid as $s)
			{ 
				$yrs = array(1, 3);
				$colno = 0;
				if ($s == "i4")	
				{	
					if (isset($_POST[$s.'ins'.$bdw]))
					{
						$inscost = $_POST[$s.'ins'.$bdw];
					}
					else 
					{
						$inscost = "--";
					}	
					echo '<input type = "hidden" value ="'.$inscost.'"" name = '.$s.'ins'.$bdw.'>';
					

				}
				elseif($s == "i5")
				{
					echo '<input type = "hidden" value = "included in price" name = '.$s.'ins'.$bdw.'>';
				}
				else 
				{
					if (isset($_POST[$s.'1yr'.$bdw]))
					{
						$inscost1 = $_POST[$s.'1yr'.$bdw];
					}
					else 
					{
						$inscost1 = "--";

					}

					if (isset($_POST[$s.'3yr'.$bdw]))
					{
						$inscost3 = $_POST[$s.'3yr'.$bdw];
					}
					else 
					{
						$inscost3 = "--";

					}		

					echo '<input type = "hidden" value = "'.$inscost1.'" name = '.$s.'1yr'.$bdw.'>';
					echo '<input type = "hidden" value = "'.$inscost3.'" name = '.$s.'3yr'.$bdw.'>';
				}
				foreach ($yrs as $ys)
				{	//global $bdw;
					$y1 = $m.$ys;
					$sub1 = ' -';
					if ($bdw == "")
					{
						$bdw = 10;
					}

					if (isset($valuearray[$bdw]))
					{
						if (array_key_exists($s, $valuearray[$bdw]))
						{

							if ($valuearray[$bdw][$s][$y1]!= "") 
							{
								$sub1 = $valuearray[$bdw][$s][$y1];
								if ($s != "i5")
								{
									$rentmargin = ($sub1 - $_POST[$s."ann".$bdw]);
									$cost = ($_POST[$s."ann".$bdw]);
								}
								elseif (isset($_POST["i4ann".$bdw]) && isset($_POST['i4ins'.$bdw]))
								{
									$rentmargin = ($sub1 - $_POST["i4ann".$bdw]) - $_POST['i4ins'.$bdw];
									$cost = ($_POST["i4ann".$bdw]-$_POST['i4ins'.$bdw]);
								}
								else 
								{
									$rentmargin = 0;
									$cost = 0;
								}
							} 
							else 
							{
								$sub1 = '  --';
								$rentmargin = 0;
								$cost = 0;
							}
						}
						else
						{	
						
							$sub1 = ' ---';
							$rentmargin = 0;
							$cost = 0;
						}	
					}
					else 
					{
						$sub1 = '  ----';
						$rentmargin = 0;
						$cost = 0;
					}
					echo'<td class = "'.$s.'i'.$ys.'" id = "'.$s.$y1.$bdw.'"> 
					&pound <input type = "text" value = "'.$sub1.'" name = "'.$s.$y1.$bdw.'"></td>'."\n"; //onmouseenter = "cellhighlight(this)" onmouseleave = "cellunhighlight(this)"
					echo '<input type = "hidden" value = "'.$rentmargin.'" name = '.$s.$y1.'mar'.$bdw.'>';
					echo '<input type = "hidden" value = "'.$cost.'" name = '.$s.$y1.'cost'.$bdw.'>';
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
