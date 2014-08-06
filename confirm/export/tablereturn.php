<?php
mb_internal_encoding("UTF-8");

function table_populate($quotes)
{
	
/*	$bwidths = array(10,20,30,40,50,100);
	
	$snames = array("ttb" => "TTB", "bts" => "BT 21CN Standard", "btp" => "BT 21CN Premium", "ead" => "BT Openreach EAD", "spd" => "EAD Spread Install");*/

	echo '<table style = "font-family:\'Tahoma\'; border-collapse:collapse;border:1px solid black; font-size: 13px;">';
	
	echo '
	<td style = "text-align:center; font-family: \'Calibri\'; background-color: rgb(31, 73, 125); color: white; font-size:15px" colspan = "3" >Annual Rental</td></tr>';

	
	
	echo '</tr>
	<tr>
	<th style = "font-family:\'Tahoma\'; background-color: rgb(217,217,217); border-right: 0px; padding: 7px;" class = "side" >Internet (Mbps)</th>';


		echo '
		<th style = "font-family:\'Tahoma\'; background-color: rgb(217,217,217); border-right: 0px; padding: 7px; width: 200px;" ><label > 12 month term </label></th>'."\n".'
		<th style = "font-family:\'Tahoma\'; background-color: rgb(217,217,217); border-left: 0px; padding: 7px; width: 200px;" ><label >36 month term '.$_REQUEST['export'].'</label></th></tr>';
	

	foreach ($quotes as $qt)
	{	
		echo '<tr>
		<th style = " border-bottom: 1px; border-bottom-color: rgb(217,217,217); padding: 7px;" class = "side"><label>'.$qt['intbandwidth'].' Mbps</label></th>'."\n".'</th>';
		



		echo'<td style = "border: 1px solid black; padding: 7px;">£<label>'.$qt['flo1yearrental'].'</label></td>'."\n";
		echo'<td style = "border: 1px solid black; padding: 7px;">£<label>'.$qt['flo3yearrental'].'</label></td>'."\n";

			
		
		echo "</tr>";
	}
	echo '</table><br>';
}
