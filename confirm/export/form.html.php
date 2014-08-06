<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "utf-8">
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
		<meta name=ProgId content=Word.Document>
		<meta name=Generator content="Microsoft Word 9">
		<meta name=Originator content="Microsoft Word 9">
		<title>Export Values</title>
		<style>	
		@page Section1 {size:595.45pt 841.7pt; margin:1.0in 1.25in 1.0in 1.25in;mso-header-margin:.5in;mso-footer-margin:.5in;mso-paper-source:0;}
		div.Section1 {page:Section1;}
		@page Section2 {size:841.7pt 595.45pt;mso-page-orientation:landscape;margin:1.25in 1.0in 1.25in 1.0in;mso-header-margin:.5in;mso-footer-margin:.5in;mso-paper-source:0;}
		div.Section2 {page:Section2;}
		</style>
	</head>
	<img src="http://www.converged.co.uk/images/page/converged-logo.gif" alt="Image not found">	<br>
	<hr>
	<body>

		<br><div class = "Section2">
	<form action = "index.php" method = "post">
		<?php 

			global $quotes;
		if (!empty($quotes))
		{
			table_populate($quotes);
		}

		else
		{
			echo "Error: no matching pricing info. <br>Please go <a href = 'javascript:history.back()'>back</a> and select a different quote to export.";
		}
			 ?>

	</form>
</div>



	</body>
</html>