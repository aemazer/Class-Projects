<!doctype html>
<html>

	<head>
		<link rel="stylesheet" type="text/css" href="fpstyle.css" />
		<link href='http://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet' type='text/css'>
		<?php 
			require 'fpcommon.php';
			
			if(!empty($_POST)) {
				if(!empty($_POST['username']) && !empty($_POST['password'])) {
					if(($_POST['username'] == 'admin') && ($_POST['password'] == 'password')) {
						 echo '<script> window.location = "./admin.php" </script>';
					} else {
						if(userlogin($_POST['username'], $_POST['password']))
						{
							userForm();
							
						} else { 
							$error = "Your username or password is FUCKING WRONG.";
						}
						
						$error = "Peasant.";
					}
				} else {
					$error = "You need to enter both a username an password.";
				}
			}
		?>
		<title>Mighty Form</title>
	</head>
	
	<body>
		<div id = 'content'>
			<?= showSearchBox(); ?>
			<?= showHeader(); ?>
			<div id = 'main'>
			<?php
				if(isset($_GET['search'])) {
					searchQuery($_GET['search']);
				} else {
					echo '<p> Peasants use the tiny form to update the status of their doom mission. </p>';
					echo '<p> Tallest use the mighty form to alter, add, and delete information to the mighty database of doom. </p>';
					if(isset($error)) {
						echo '<p class="error">' . $error . '</p>';
					}
					echo '<form action = "' . $_SERVER['PHP_SELF'] . '" method = "post">
							<label>Username: <input type = "textarea" name = "username" class = "textarea"/></label>
							<br />
							<label>Password: <input type = "password" name = "password" class = "textarea"/></label>
							<br />
							<input type = "submit" value = "Login" class = "button" />
						</form>';
				}
			?>
			</div>
			<?= showFooter(); ?>
		</div>
	</body>
	
</html>