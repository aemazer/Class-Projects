<!doctype html>
<html>

	<head>
		<link rel="stylesheet" type="text/css" href="fpstyle.css" />
		<link href='http://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet' type='text/css'>
		<?php 
			require 'fpcommon.php'; 
		?>
		<title>Invader</title>
	</head>
	
	<body>
		<div id = 'content'>
			<?= showSearchBox() ?>
			<?= showHeader() ?>
			<div id = 'main'>
				<!-- GENERATE TABLE -->
			</div>
			<?= showFooter(); ?>
		</div>
	</body>
	
</html>