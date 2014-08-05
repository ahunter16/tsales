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
		<form action = '' method = 'post' id = 'statusform'>
			<select name = 'statusid' onchange = 'formsubmit()'>

				<?php selectcriteria($statuses, $option); ?>
			</select>
		</form>
		<br>
		<form action = '' method = 'post'>
	
			<?php 
			if (isset($statusquote))
			{
				reviewdefine($statusquote, $status); 
			}
			else
			{
				echo 'No quotes with selected status found';
			}
				?>
		
	</form>
		<br><br>

		<script>
		function formsubmit()
		{
			document.getElementById('statusform').submit();
		}
		</script>
	</body>
</html>