<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "utf-8">
		<title>Confirm Quote</title>
		<link rel="stylesheet" type="text/css" href="calc.css">
	</head>
	<img src="http://www.converged.co.uk/images/page/converged-logo.gif" alt="Image not found">	<br>
	<hr>
	<body>
		<form>
			<select name = "statusid">
				<?php statusselect(); ?>
			</select>
		</form>

	<?php tablemake($quotes) ?>