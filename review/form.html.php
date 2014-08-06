<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "utf-8">
		<title>Review Quotes</title>
		<link rel="stylesheet" type="text/css" href="review.css">


	</head>
	<img src="http://www.converged.co.uk/images/page/converged-logo.gif" alt="Image not found">	<br>
	<hr>
	<body>
		<p><?php global $tut; echo $tut; ?></p>
		<form action = '' method = 'post' id = 'statusform'>
			Choose a status to filter quotes by: 
			<select name = 'statusid' onchange = 'formsubmit()'>

				<?php selectcriteria($statuses, $option); ?>
			</select>
		</form>
		<br>
		<form action = '' method = 'post' id = "mainform">
	
			<?php 
			if (isset($statusquote))
			{
				reviewdefine($statusquote, $option); 
			}
			else
			{
				echo 'No quotes with selected status found';
			}
			?>
		
	</form>
		<br><br>

<!-- 	<form action = "" method = "get" id = "exportform">../confirm/export/index.php
	<input type = "text" id = "exportid" name = "exported">
	</form> -->
		<script>
		document.getElementById("mainform").action = "";
		function formsubmit()
		{
			document.getElementById('statusform').submit();
		}


/*		function copyvalues(x)
		{

			document.getElementById("exportid").value = x.value;
			document.getElementById("testp").innerHTML = x.value;

		}*/
		function expform(x)
		{

			var form = document.getElementById("mainform");
			form.action = "../confirm/export/index.php";
			form.submit();

		}

		</script>
		<p id = "testp"></p>
	</body>
</html>