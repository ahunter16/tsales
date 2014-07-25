<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "utf-8">
		<link rel="stylesheet" type="text/css" href="calc.css">
	</head>
	<body>
	<form id = "iform" target = "top">
	<?php basevals(); ?>
	<input action = "" type = "submit" value = "Save" name = "savebases">

	</form>
	<script>
	function submitbases()
	{
		document.getElementById("iform").submit();

	}
	</script>
</body>