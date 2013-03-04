<!doctype html>
<html>

	<head>
		<link rel="stylesheet" type="text/css" href="fpstyle.css" />
		<link href='http://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet' type='text/css'>
		<?php 
			require 'fpcommon.php';	
		?>
		<title>Mighty Form</title>
	</head>
	
	<body>
		<div id = 'content'>
			<?= showSearchBox(); ?>
			<?= showHeader(); ?>
			<div id = 'main'>
			
			<?php
				//Check for search
				if(isset($_GET['search'])) {
					searchQuery($_GET['search']);
				} 
				
				if(!empty($_POST)) {
					//Check for the list all data button
					if(!empty($_POST['listInvaders'])) {
						adminListInvaders();
					//Check for add invader button
					} else if(!empty($_POST['addInvader'])) {
						addInvader();
					//Check for cancel
					} else if(!empty($_POST['cancel'])) {
						echo '<script> window.location = "./admin.php" </script>';
					//Check for add invader confirmation
					} else if(!empty($_POST['add'])) {
						addInvaderQuery();
					//Check for change button
					} else if(!empty($_POST['change'])) {
						if(!isset($_POST['type'])) {
							echo '<p> You didn\'t select anything. </p>';
							adminListInvaders();
						} else {
							changeQuery();
						}
					//Check for delete button
					} else if(!empty($_POST['delete'])) {
						if(!isset($_POST['type'])) {
							echo '<p> You didn\'t select anything. </p>';
							adminListInvaders();
						} else {
							deleteQuery();
						}
					//Check for delete confirmation
					} else if (!empty($_POST['confirmDelete'])) {
						runDeleteQuery();
					//Check for change confirmation #1
					} else if(!empty($_POST['submitChanges'])) {
						confirmChangeQuery();
					//Check for change confirmation #2
					} else if(!empty($_POST['confirmChange'])) {
						runChangeQuery();
					}
				} else {
					displayAdminForm($_SERVER['PHP_SELF']);
				}
			?>
		</div>
		
		<?= showFooter(); ?>
		
		</div>
	</body>
	
</html>