<?php 
include 'form.html.php';

/*print_r($_GET); 
echo '<br>';
$values = $_GET;
ksort($values, SORT_NATURAL);
print_r($values);*/
$titlerow = "";
$yearrow = "";
$bwrows = array();
$suppliers = array();

if (!empty($_GET))
{
	$quotes = $_GET;
	$ksort($quotes, SORT_NATURAL);
	foreach ($quotes as $q)
	{
		$data[] = array();
	}
}