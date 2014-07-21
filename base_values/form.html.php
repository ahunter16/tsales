<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "utf-8">
		<title>Modify Model</title>
		<link rel="stylesheet" type="text/css" href="modify.css">


	</head>
	<img src="http://www.converged.co.uk/images/page/converged-logo.gif" alt="Image not found">	<br>
	<hr>
	<body>
	<div id = "bases">
		<br><label id = "title">View/Modify Active Base Values:</label><br>


		</div>
		<div id = "bvform">
				<form action = "?" method = "post">
					<br>
				<input type = "submit" value = "Submit">
				<br>
				<br>
				<?php $tablerows = "";
		 		include 'baserow.php';?>
		 		</table>
		 	</form>
		 	<p><a href = "..">Back to Calculator</a></p>
		</div>


			<p> </p>
	</div>


	</body>
	
</html>