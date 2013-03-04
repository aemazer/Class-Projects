<?php

//GENERATE SITE FRAME
//Show the copyright message
function showFooter() {
	echo '<div id = "footer"> 
				Copyright &copy; 2012' .
				(date('Y') != 2012 ? ('-' . date('Y')) : '') . ' Ariana Mazer & Leigh Anne Warner. 
				All Rights Reserved. 
			</div>';
}

//Show the search box and button
function showSearchBox() {
	echo "<div id = 'searchBox'>
			<form>
				<label>Search: <input type = 'textarea' name = 'search' class = 'textarea'/></label>
				<input type = 'submit' value = 'Search' class = 'button' />
			</form>
		</div>";
}

//Show the header and navigation
function showHeader() {
	echo "<div id = 'header'>
			<h1>Operation Doom 3</h1>
			<ul id = 'nav'>
				<a href = \"index.php\">
					<li>Rankings</li>
				</a>
				<a href = \"Planets.php\">
					<li>Planets</li>
				</a>
				<a href = \"Update.php\">
					<li>Update</li> 
				</a>
			</ul>
		</div>";
}

//INDIVIDUAL PAGES
//Show the login form on the update page
function showForm() {
	echo "<p> The Tallest use this mighty form to alter, add, and delete information to our mighty database of doom. </p>";
	echo '<form action = "<? $_SERVER[\'PHP_SELF\'] ?>" method = "post">
			<label>Username: <input type = "textarea" name = "username" class = "textarea"/></label>
			<br />
			<label>Password: <input type = "password" name = "password" class = "textarea"/></label>
			<br />
			<input type = "submit" value = "Admin Login" class = "button" />
		</form>';
}

//Generate the Rankings table
function indexQuery() {

	//If a search has been run, generate the search table instead
	if(isset($_GET['search'])) {
		searchQuery($_GET['search']);
		return;
	}

	require 'dbconfig.php';

	//Set the query
	$query = "SELECT *
		FROM Invader
		NATURAL JOIN Ship
		NATURAL JOIN Robot
		NATURAL JOIN Planet ";

	//Check for sorting
	if(isset($_GET['sort'])){
		if($_GET['sort'] == "Name"){
			$query .= "ORDER BY Name";
		} elseif ($_GET['sort'] == "Height"){
			$query .= "ORDER BY Height";
		} elseif ($_GET['sort'] == "Robot"){
			$query .= "ORDER BY BotName";
		} elseif ($_GET['sort'] == "Ship_Name"){
			$query .= "ORDER BY ShipName";
		} else {
			$query .= "ORDER BY Superiorocity";
		}
	} else {
	       $query .= "ORDER BY Superiorocity";
   	}


	//Run query
	$result = mysql_query($query,$dblink)
		or die ("Query failed.");
	
	//Output the table
	echo '<table> 
		<tr>
			<th><a href="' . $_SERVER['PHP_SELF'] . '?sort=Superiorocity">Superiorocity</a></th>
			<th><a href="' . $_SERVER['PHP_SELF'] . '?sort=Name">Name</a></th>
			<th><a href="' . $_SERVER['PHP_SELF'] . '?sort=Height">Height</a></th>
			<th><a href="' . $_SERVER['PHP_SELF'] . '?sort=Robot">Robot</a></th>
			<th><a href="' . $_SERVER['PHP_SELF'] . '?sort=Ship_Name">Ship Name</a></th>
		</tr>';
	
	while ($line = mysql_fetch_assoc($result)) {
		echo '<tr>'
			. '<td>' . $line['Superiorocity'] . '</td>' 
			. '<td>' . $line['Name'] . '</td>'
			. '<td>' . $line['Height'] . '</td>'
			. '<td>' . $line['BotName'] . '</td>'
			. '<td>' . $line['ShipName'] . '</td>'
		. '</tr>';
	}
	echo '</table>';
}	

//Generate Planets table
function planetsQuery() {
	
	//If a search has been run, generate the search table instead
	if(isset($_GET['search'])) {
		searchQuery($_GET['search']);
	} else {

		require 'dbconfig.php';

		//Set the query
		$query = "SELECT *
			FROM Planet
			NATURAL JOIN Ship
			NATURAL JOIN Robot
			NATURAL JOIN Invader ";

		//Check for sort
		if(isset($_GET['sort'])){
			if($_GET['sort'] == "Inhabitants"){
				$query .= "ORDER BY InhabType";
			} elseif($_GET['sort'] == "StatusID"){
				$query .= "ORDER BY StatusID";
			} elseif($_GET['sort'] == "Assigned_Invader"){
				$query .= "ORDER BY Name";
			} else {
				$query .= "ORDER BY PLName";
			}
		} else {
			$query .= "ORDER BY PLName";
		}

		//Run the query
		$result = mysql_query($query,$dblink)
			or die ("Query failed.");
	
		//Output the table
		echo '<table> 
			<tr>
				<th><a href="' . $_SERVER['PHP_SELF'] . '?sort=Planet">Planet</a></th>
				<th><a href="' . $_SERVER['PHP_SELF'] . '?sort=Inhabitants">Inhabitants</a></th>
				<th><a href="' . $_SERVER['PHP_SELF'] . '?sort=Status">Status</a></th>
				<th><a href="' . $_SERVER['PHP_SELF'] . '?sort=Assigned_Invader">Assigned Invader</a></th>
			</tr>';
	
		while ($line = mysql_fetch_assoc($result)) {
			echo '<tr>'
				. '<td>' . $line['PLName'] . '</td>' 
				. '<td>' 
				. (($line['InhabType'] == 'I') ? "Irken" : "Non-Irken") 
				. '</td>'
				. '<td>'
				. (($line['StatusID'] == 'U') ? "Unconquered" : "Conquered")
				. '</td>'
				. '<td>'
				. $line['Name']
				. '</td>'
			. '</tr>';
		}
		echo '</table>';
	}
}

//Generate the search results
function searchQuery($search) {
	require 'dbconfig.php';

	//Invader query
	$bucketsearch = $search;
	$searchTerms = explode(' ', $bucketsearch);
	$searchTermBits = array();
	foreach ($searchTerms as $term) {
		 $term = trim($term);
		 if (!empty($term)) {
			$searchTermBits[] = "Name LIKE '%$term%'";
		 }
	}  

	$invaderResult = mysql_query("SELECT * FROM Invader NATURAL JOIN Ship NATURAL JOIN Robot NATURAL JOIN Planet WHERE " . (implode(' AND ', $searchTermBits)) );

	//Planet query
	$bucketsearch = $search;
	$searchTerms = explode(' ', $bucketsearch);
	$searchTermBits = array();
	foreach ($searchTerms as $term) {
		$term = trim($term);
		if (!empty($term)) {
			$searchTermBits[] = "PLName LIKE '%$term%'";
		}
	}

	$planetResult = mysql_query("SELECT * FROM Planet NATURAL JOIN Ship NATURAL JOIN Robot NATURAL JOIN Invader WHERE " . (implode(' AND ', $searchTermBits)) );

	$invaderCount = mysql_num_rows($invaderResult);
	$planetCount = mysql_num_rows($planetResult);

	//Output result - with correct grammar!
	echo $invaderCount . " Invader" . (($invaderCount != 1) ? "s " : " ") . " and " 
	. $planetCount . " Planet" . (($planetCount != 1) ? "s " : " ") . "found.";

	echo "<br /><br />";

	//Generate Invader Table
	if($invaderCount > 0) {
		echo '<table>
			<tr>
				<th>Superiorocity</th>
				<th>Name</th>
				<th>Height</th>
				<th>Robot</th>
				<th>Ship Name</th>
			</tr>';

		while ($line = mysql_fetch_assoc($invaderResult)) {
			echo '<tr>'
				. '<td>' . $line['Superiorocity'] . '</td>'
				. '<td>' . $line['Name'] . '</td>'
				. '<td>' . $line['Height'] . '</td>'
				. '<td>' . $line['BotName'] . '</td>'
				. '<td>' . $line['ShipName'] . '</td>'
			. '</tr>';
		}
		echo '</table>';
		echo '<br />';
	}

	//Generate Planet Table
	if($planetCount > 0) {
		echo '<table>
			<tr>
				<th>Planet</th>
				<th>Inhabitants</th>
				<th>Status</th>
				<th>Assigned Invader</th>
			</tr>';
	
		while ($line = mysql_fetch_assoc($planetResult)) {
			echo '<tr>'
				 . '<td>' . $line['PLName'] . '</td>'
				 . '<td>'
				 . (($line['InhabType'] == 'I') ? "Irken" : "Non-Irken")
				 . '</td>'
				 . '<td>'
				 . (($line['StatusID'] == 'U') ? "Unconquered" : "Conquered")
				 . '</td>'
				 . '<td>'
				 . $line['Name']
				 . '</td>'
			 . '</tr>';
		}
		echo '</table>';
	}
}

//Display the admin page
function displayAdminForm($server) {
	echo '<p> The Tallest use this mighty form to alter, add, and delete information to our mighty database of doom. </p>';
	echo '<form action = "' . $server . '" method = "post">
					<input type = "submit" name = "listInvaders" value = "List All Data" class = "button" />
					<input type = "submit" name = "addInvader" value = "Add New Invader" class = "button" />
		 </form>';		 
}

//Display the admin list all data page
function adminListInvaders() {
	
	require 'dbconfig.php';

	//Set query
	$query = "SELECT *
		FROM Invader
		NATURAL JOIN Ship
		NATURAL JOIN Robot
		NATURAL JOIN Planet 
		ORDER BY Superiorocity";

	//Run query
	$result = mysql_query($query,$dblink)
		or die ("Query failed.");
	
	//Output the change, delete, and cancel buttons
	echo '<form action = "' . $_SERVER['PHP_SELF'] . '" method = "post">
		<input type = "submit" name = "change" value = "Change" class = "button" />
		<input type = "submit" name = "delete" value = "Delete" class = "button" /> 
		<input type = "submit" name = "cancel" value = "Cancel" class = "button" />
		<br /><br />
		<table class = "admin_table"> 
		
		<tr>
			<th>Superiorocity</th>
			<th>Name</th>
			<th>Height</th>
			<th>Robot</th>
			<th>Ship Name</th>
			<th>Planet</th>
			<th>Select One</th>
		</tr>';
	
	//Output the table
	while ($line = mysql_fetch_assoc($result)) {
		echo '<tr>'
			. '<td>' . $line['Superiorocity'] . '</td>' 
			. '<td>' . $line['Name'] . '</td>'
			. '<td>' . $line['Height'] . '</td>'
			. '<td>' . $line['BotName'] . '</td>'
			. '<td>' . $line['ShipName'] . '</td>'
			. '<td>' . $line['PLName'] . '</td>'
			. '<td><input type = "radio" name = "type[]" value = "' . $line['Superiorocity'] . '"/> </td>'
		. '</tr>';
	}
	echo '</table>
		<br />
		<input type = "submit" name = "change" value = "Change" class = "button" />
		<input type = "submit" name = "delete" value = "Delete" class = "button" />
		<input type = "submit" name = "cancel" value = "Cancel" class = "button" />
		</form>';
}

//Show the add invader admin page
function addInvader() {
	echo '<form action = "' . $_SERVER['PHP_SELF'] . '" method = "post">
			<label>Name: <input type = "textarea" name = "name" class = "textarea"/></label>
			<br />
			<label for = "feet">Height (Feet): 
				<select name="feet" class = "select">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				</select> </label>
			<label for = "inches">Height (Inches): 
				<select name="inches" class = "select">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				</select> </label>
			<br /><br />
			<label>Robot: <input type = "textarea" name = "robot" class = "textarea"/></label>
			<br />
			<label for = "shipName">Ship: 
				<select name="shipName" class = "select">
				<option value="carrier">Carrier</option>
				<option value="destroyer">Destroyer</option>
				<option value="voyager">Voyager</option>
				<option value="travelship">Travel Ship</option>
				</select> </label>
			<br /><br />
			<label>Planet: <input type = "textarea" name = "PLName" class = "textarea"/></label>
			<br /> 
			<label for = "inhabitants">Inhabitants: 
				<select name="inhabitants" class = "select">
				<option value="I">Irken</option>
				<option value="N">Non-Irken</option>
				</select> </label>
			<br /><br />
			<label for = "status">Status: 
				<select name="status" class = "select">
				<option value="I">Conquered</option>
				<option value="U">Unconquered</option>
				</select> </label>
			<br /> <br />
			<input type = "submit" name = "add" value = "Submit" class = "button" />
			<input type = "submit" name = "cancel" value = "Cancel" class = "button" />
		</form>';
}

//Run the add invader query
function addInvaderQuery() {
	//echo "Add Invader Query";
	require 'dbconfig.php';

	//string value for hieght
	$stheight = '';
	
	//getting values for height
	if (isset($_POST['feet'])) {
		$stheight .= ($_POST['feet'] . '.'); 
	}
	if (isset($_POST['inches'])) {
		$stheight .= ($_POST['inches']);
	}
	
	//Error checking
	$height = floatval($stheight);
	$name =ucfirst(($_POST['name']));
	$BotName = ucfirst(($_POST['robot']));
	$PLName = (ucfirst($_POST['PLName']));
	$ShipType = ($_POST['shipName']);
	$ShipTypeID = strtoupper(substr($ShipType, 0, 1));

	//check duplicate invader
	$query = "SELECT Name FROM Invader WHERE Name = '$name'";
	$result = mysql_query($query, $dblink)
		or die("Search query failed" . mysql_error());
	if(mysql_num_rows($result) > 0){
		echo "Invader " . ucfirst($name) . " already exists! Faker!";
		echo '<form action = "' . $_SERVER['PHP_SELF'] . '" method = "post">
				<input type = "submit" name = "cancel" value = "Ok" class = "button" />
			</form>';
		exit();
	}
	
	//check if Robot already exists
	$query = "SELECT BotName FROM Robot WHERE BotName = '$BotName'";
	$result = mysql_query($query, $dblink)
		or die("Search query failed" . mysql_error());
	if(mysql_num_rows($result) > 0){
		echo "Robot " . ucfirst($BotName) . " already belongs to another, better Invader! Get another robot!";
		echo '<form action = "' . $_SERVER['PHP_SELF'] . '" method = "post">
				<input type = "submit" name = "cancel" value = "Ok" class = "button" />
			</form>';
		exit();
	}
	
	//check if planet already exists
	$query = "SELECT PLName FROM Planet WHERE PLName = '$PLName'";
	$result = mysql_query($query, $dblink)
		or die("Search query failed" . mysql_error());
	if(mysql_num_rows($result) > 0){
		echo "Planet " . ucfirst($PLName) . " has already been taken! You've been reassigned! HAHA";
		echo '<form action = "' . $_SERVER['PHP_SELF'] . '" method = "post">
				<input type = "submit" name = "cancel" value = "Ok" class = "button" />
			</form>';
		exit();
	}
	
	//Set the ship name - type + Invader's name
	if($_POST['shipName']=='Travel Ship'){
		$ShipName = "TravelShip" . $name;
	}
	else
		$ShipName = ucfirst($_POST['shipName']) . $name;
	
	//Get the StatusID and InhabType
	$StatusID = substr($_POST['status'], 0, 1);
	$InhabType = substr($_POST['inhabitants'], 0, 1);
	$errortext='';
	
	//Check for empty form fields
	if(!empty($_POST)) {
		if (empty($_POST['name'])) {
		$errortext .= '<li>The Name of the Invader is missing. </li>';
		$ErrorFields[] = 'name';
		}
		if (empty($_POST['robot'])) {
			$errortext .= '<li>The Name of the robot is missing. </li>';
			$ErrorFields[] = 'robot';
		}
		if(empty($_POST['PLName'])){
			$errortext .= '<li>The Name of the Planet is missing. </li>';
			$ErrorFields[] = 'PLName';
		}
		
		//If no errors, run the queries and display a success message
		if(empty($errortext)){
		
			$query= "INSERT INTO Invader(Height, Name, BotName, ShipTypeID) VALUES ($height, '$name', '$BotName', '$ShipTypeID')";
			$result = mysql_query($query, $dblink)
				or die ("Insert Invader Query failed. " . mysql_error());
	
			$query = "SELECT max(Superiorocity) FROM Invader";
			$result = mysql_query($query, $dblink)
				or die ("Max Query failed." . mysql_error());
			$temp = mysql_fetch_row($result);
			$superiorocity = $temp[0];
			
			$query = "INSERT INTO Robot(BotName, Superiorocity) VALUES ('$BotName', $superiorocity)";
			$result = mysql_query($query, $dblink)
				or die ("Insert Robot Query failed. ". mysql_error());
			
			$query = "INSERT INTO Ship(ShipName, Superiorocity, ShipTypeID) VALUES ('$ShipName', $superiorocity, '$ShipTypeID')";
			$result = mysql_query($query, $dblink)
				or die ("Insert Ship Query failed. ". mysql_error());
		
			$query = "INSERT INTO Planet(PLName, Superiorocity, StatusID, InhabType) VALUES ('$PLName', $superiorocity, '$StatusID', '$InhabType')";
			$result = mysql_query($query, $dblink)
				or die ("Insert Planet Query failed. " . mysql_error());
			
			echo "Welcome, Invader " . ucfirst(($_POST['name'])) . "!";
			echo '<form action = "' . $_SERVER['PHP_SELF'] . '" method = "post">
					<input type = "submit" name = "cancel" value = "Ok" class = "button" />
				</form>';
			
		}
		
		//Otherwise, display error messages
		else{
			echo '<h2>There are problems:</h2><ul>' . $errortext . '</ul>';
			echo '<form action = "' . $_SERVER['PHP_SELF'] . '" method = "post">
				<input type = "submit" name = "cancel" value = "Ok" class = "button" />
			</form>';
			$noQuery = true;
		}
	}
}

//Show the change form
function changeQuery() {
	
	require 'dbconfig.php';
	
	//Set the query
	$superiorocity=$_POST['type'][0];
	$query = "SELECT *
		FROM Invader
		NATURAL JOIN Ship
		NATURAL JOIN Robot
		NATURAL JOIN Planet 
		WHERE Invader.Superiorocity=" . $superiorocity;
	
	//Find the specific invader to change
	$result = mysql_query($query, $dblink)
		or die ("Query failed.");
	
	$line = mysql_fetch_assoc($result);
	$feet = substr($line['Height'], 0, 1);
	$inches = substr($line['Height'], 2);
	$ship = substr($line['ShipName'], 0, 1);
	
	//Display the form
	echo '<p> Modify the data. </p>';
	
	echo '<form action = "' . $_SERVER['PHP_SELF'] . '" method = "post">
			<input type = "hidden" name = "superiorocity" value = "' . $superiorocity . '" />
			<label>Name: <input type = "textarea" name = "name" class = "textarea" value="' . $line['Name'] . '"/></label>
			<br />
			<label for = "feet">Height (Feet): 
				<select name="feet" class = "select">
				<option value="1"' . (($feet == '1') ? ' selected="selected"' : ' ') . '>1</option>
				<option value="2"' . (($feet == '2') ? ' selected="selected"' : ' ') . '>2</option>
				<option value="3"' . (($feet == '3') ? ' selected="selected"' : ' ') . '>3</option>
				<option value="4"' . (($feet == '4') ? ' selected="selected"' : ' ') . '>4</option>
				</select> </label> 
				
			<label for = "inches">Height (Inches): 
				<select name="inches" class = "select">
				<option value="1"' . (($inches == '1') ? ' selected="selected"' : ' ') . '>1</option>
				<option value="2"' . (($inches == '2') ? ' selected="selected"' : ' ') . '>2</option>
				<option value="3"' . (($inches == '3') ? ' selected="selected"' : ' ') . '>3</option>
				<option value="4"' . (($inches == '4') ? ' selected="selected"' : ' ') . '>4</option>
				<option value="5"' . (($inches == '5') ? ' selected="selected"' : ' ') . '>5</option>
				<option value="6"' . (($inches == '6') ? ' selected="selected"' : ' ') . '>6</option>
				<option value="7"' . (($inches == '7') ? ' selected="selected"' : ' ') . '>7</option>
				<option value="8"' . (($inches == '8') ? ' selected="selected"' : ' ') . '>8</option>
				<option value="9"' . (($inches == '9') ? ' selected="selected"' : ' ') . '>9</option>
				<option value="10"' . (($inches == '10') ? ' selected="selected"' : ' ') . '>10</option>
				<option value="11"' . (($inches == '11') ? ' selected="selected"' : ' ') . '>11</option>
				<option value="12"' . (($inches == '12') ? ' selected="selected"' : ' ') . '>12</option>
			</select> </label>
			<br /><br />
			<label>Robot: <input type = "textarea" name = "robot" class = "textarea" value="' . $line['BotName'] . '" /></label>
			<br />
			<label for = "shipName">Ship: 
				<select name="shipName" class = "select">
				<option value="Carrier"' . (($ship == 'C') ? ' selected="selected"' : ' ') . '>Carrier</option>
				<option value="Destroyer"' . (($ship == 'D') ? ' selected="selected"' : ' ') . '>Destroyer</option>
				<option value="Voyager"' . (($ship == 'V') ? ' selected="selected"' : ' ') . '>Voyager</option>
				<option value="Travelship"' . (($ship == 'T') ? ' selected="selected"' : ' ') . '>Travel Ship</option>
				</select> </label>
			<br /><br />
			<label>Planet: <input type = "textarea" name = "PLName" class = "textarea" value="' . $line['PLName'] . '"/></label>
			<br /> 
			<label for = "inhabitants">Inhabitants: 
				<select name="inhabitants" class = "select">
				<option value="I"' . (($line['InhabType'] == 'I') ? ' selected="selected"' : ' ') . '>Irken</option>
				<option value="N"' . (($line['InhabType'] == 'N') ? ' selected="selected"' : ' ') . '>Non-Irken</option>
				</select> </label>
			<br /><br />
			<label for = "status">Status: 
				<select name="status" class = "select">
				<option value="C"' . (($line['StatusID'] == 'C') ? ' selected="selected"' : ' ') . '>Conquered</option>
				<option value="U"' . (($line['StatusID'] == 'U') ? ' selected="selected"' : ' ') . '>Unconquered</option>
				</select> </label>
			<br /> <br />
			<input type = "submit" name = "submitChanges" value = "Submit" class = "button" />
			<input type = "submit" name = "cancel" value = "Cancel" class = "button" />
		</form>';
		

}

//Confirm the changes
function confirmChangeQuery() {

	require 'dbconfig.php';
	$superiorocity = $_POST['superiorocity'];

	//Ensure correct formatting
	$height = floatval($_POST['feet'] . '.' . $_POST['inches']);
	$name =ucfirst(($_POST['name']));
	$BotName = ucfirst(($_POST['robot']));
	$PLName = (ucfirst($_POST['PLName']));
	$ShipType = ($_POST['shipName']);
	$ShipTypeID = strtoupper(substr($ShipType, 0, 1));

	//check duplicate invader
	$query = "SELECT Name FROM Invader WHERE Name = '$name' AND Superiorocity != '" . $superiorocity . "'";
	$result = mysql_query($query, $dblink)
		or die("Search query failed" . mysql_error());
	if(mysql_num_rows($result) > 0){
		echo "Invader " . ucfirst($name) . " already exists! Faker!";
		echo '<form action = "' . $_SERVER['PHP_SELF'] . '" method = "post">
				<input type = "submit" name = "cancel" value = "Ok" class = "button" />
			</form>';
		exit();
	}
	//check if Robot already exists
	$query = "SELECT BotName FROM Robot WHERE BotName = '$BotName' AND Superiorocity != '" . $superiorocity . "'";
	$result = mysql_query($query, $dblink)
		or die("Search query failed" . mysql_error());
	if(mysql_num_rows($result) > 0){
		echo "Robot " . ucfirst($BotName) . " already belongs to another, better Invader! Get another robot!";
		echo '<form action = "' . $_SERVER['PHP_SELF'] . '" method = "post">
				<input type = "submit" name = "cancel" value = "Ok" class = "button" />
			</form>';
		exit();
	}
	//check if planet already exists
	$query = "SELECT PLName FROM Planet WHERE PLName = '$PLName' AND Superiorocity != '" . $superiorocity . "'";
	$result = mysql_query($query, $dblink)
		or die("Search query failed" . mysql_error());
	if(mysql_num_rows($result) > 0){
		echo "Planet " . ucfirst($PLName) . " has already been taken! You've been reassigned! HAHA";
		echo '<form action = "' . $_SERVER['PHP_SELF'] . '" method = "post">
				<input type = "submit" name = "cancel" value = "Ok" class = "button" />
			</form>';
		exit();
	}
	
	//Set ship name
	if($_POST['shipName']=='Travel Ship') {
		$ShipName = "TravelShip" . $name;
	} else {
		$ShipName = ucfirst($_POST['shipName']) . $name;
	}
	
	$StatusID = substr($_POST['status'], 0, 1);
	$InhabType = substr($_POST['inhabitants'], 0, 1);
	$errortext='';

	//check for empty fields
	if (empty($_POST['name'])) {
		$errortext .= '<li>The Name of the Invader is missing. </li>';
		$ErrorFields[] = 'name';
	}
	
	if (empty($_POST['robot'])) {
		$errortext .= '<li>The Name of the robot is missing. </li>';
		$ErrorFields[] = 'robot';
	}
	
	if(empty($_POST['PLName'])) {
		$errortext .= '<li>The Name of the Planet is missing. </li>';
		$ErrorFields[] = 'PLName';
	}
	
	//If there is an error, display the error and kill the program
	if(!empty($errortext)){
			echo '<h2>There are problems:</h2><ul>' . $errortext . '</ul>';
			echo '<form action = "' . $_SERVER['PHP_SELF'] . '" method = "post">
				<input type = "submit" name = "cancel" value = "Ok" class = "button" />
			</form>';
			die();
	}

	//Show the changes to be made
	$query = "SELECT *
		FROM Invader
		NATURAL JOIN Ship
		NATURAL JOIN Robot
		NATURAL JOIN Planet 
		WHERE Invader.Superiorocity=" . $superiorocity;
	
	$result = mysql_query($query, $dblink)
		or die ("Query failed.");

	$line = mysql_fetch_assoc($result);

	echo 'Original: ';
		echo '<p class = "infobox"> Superiorocity: ' . $line['Superiorocity'] .
			'<br /> Name: ' . $line['Name'] .
			'<br /> Height: ' . $line['Height'] .
			'<br /> Robot: ' . $line['BotName'] .
			'<br /> Ship: ' . $line['ShipName'] . 
			'<br /> Assigned Planet: ' . $line['PLName'] .
			'<br /> Inhabitants: ' . $line['InhabType'] .
			'<br /> Status: ' . $line['StatusID'] . '</p>';
	
	echo 'Changes: ';
		echo '<p class = "infobox"> Superiorocity: ' . $_POST['superiorocity'] .
			'<br /> Name: ' . $_POST['name'] .
			'<br /> Height: ' . $_POST['feet'] . '.' . $_POST['inches'] . 
			'<br /> Robot: ' . $_POST['robot'] .
			'<br /> Ship: ' . $_POST['shipName'] . $_POST['name'] .
			'<br /> Assigned Planet: ' . $_POST['PLName'] .
			'<br /> Inhabitants: ' . $_POST['inhabitants'] . 
			'<br /> Status: ' . $_POST['status'][0] . '</p>';
	
	//Show confirmation and cancel buttons, store information in hidden fields
	echo 'Are you sure you want to make these changes?';
	echo '<form action = "' . $_SERVER['PHP_SELF'] . '" method = "post">
			<input type = "hidden" name = "superiorocity" value = "' . $superiorocity . '" />
			<input type = "hidden" name = "name" value = "' . $_POST['name'] . '" />
			<input type = "hidden" name = "height" value = "' . $_POST['feet'][0] . '.' . $_POST['inches'][0] . '" />
			<input type = "hidden" name = "botName" value = "' . $_POST['robot'] . '" />
			<input type = "hidden" name = "shipName" value = "' . $_POST['shipName'] . $_POST['name'] . '" />
			<input type = "hidden" name = "PLName" value = "' . $_POST['PLName'] . '" />
			<input type = "hidden" name = "inhabitants" value = "' . $_POST['inhabitants'] . '" />
			<input type = "hidden" name = "status" value = "' . $_POST['status'] . '" />
			<input type = "submit" name = "confirmChange" value = "Submit" class = "button" />
			<input type = "submit" name = "cancel" value = "Cancel" class = "button" />
		</form>';
}

//Make the actual changes
function runChangeQuery() {
	
	require 'dbconfig.php';

	$superiorocity = $_POST['superiorocity'];
	
	//Update the Invader table	
	$query = 'UPDATE Invader
		SET Name=\'' . $_POST['name'] 
		. '\', Height=\'' . $_POST['height'] 
		. '\', BotName=\'' . $_POST['botName'] 
		. '\', ShipTypeID=\'' . $_POST['shipName'][0]
		. '\' WHERE Superiorocity=\'' . $superiorocity . '\'';
		
	$result = mysql_query($query, $dblink)
		or die("Query failed.");
	
	//Update the Planet table
	$query = 'UPDATE Planet
		SET PLName=\'' . $_POST['PLName'] 
		. '\', StatusID=\'' . $_POST['status'] 
		. '\', InhabType=\'' . $_POST['inhabitants'] 
		. '\' WHERE Superiorocity=\'' . $superiorocity . '\'';

	$result = mysql_query($query, $dblink)
		or die("Query failed.");

	//Update the Robot table		
	$query = 'UPDATE Robot
		SET BotName=\'' . $_POST['botName'] 
		. '\' WHERE Superiorocity=\'' . $superiorocity . '\'';

	$result = mysql_query($query, $dblink)
		or die("Query failed.");
		
	//Update the Ship table
	$query = 'UPDATE Ship
		SET ShipName=\'' . $_POST['shipName'] 
		. '\', ShipTypeID=\'' . $_POST['shipName'][0] 
		. '\' WHERE Superiorocity=\'' . $superiorocity . '\'';

	$result = mysql_query($query, $dblink)
		or die("Query failed.");
	
	//Get information from the server to ensure the changes went through					
	$query = "SELECT *
		FROM Invader
		NATURAL JOIN Ship
		NATURAL JOIN Robot
		NATURAL JOIN Planet 
		WHERE Invader.Superiorocity=" . $superiorocity;
	
	$result = mysql_query($query, $dblink)
		or die ("Query failed.");

	$line = mysql_fetch_assoc($result);

	//Display success message
	echo 'Success!';
		echo '<p class = "infobox"> Superiorocity: ' . $line['Superiorocity'] .
			'<br /> Name: ' . $line['Name'] .
			'<br /> Height: ' . $line['Height'] .
			'<br /> Robot: ' . $line['BotName'] .
			'<br /> Ship: ' . $line['ShipName'] . 
			'<br /> Assigned Planet: ' . $line['PLName'] .
			'<br /> Inhabitants: ' . $line['InhabType'] .
			'<br /> Status: ' . $line['StatusID'] . '</p>';
	echo '<form action = "' . $_SERVER['PHP_SELF'] . '" method = "post">
			<input type = "submit" name = "cancel" value = "Ok" class = "button" />
		</form>';
}

//Delete an entry
function deleteQuery() {

	require 'dbconfig.php';

	//Find the specific entry to be deleted
	$superiorocity = $_POST['type'][0];
	$query = "SELECT *
		FROM Invader
		NATURAL JOIN Ship
		NATURAL JOIN Robot
		NATURAL JOIN Planet 
		WHERE Invader.Superiorocity=" . $superiorocity;
	
	$result = mysql_query($query, $dblink)
		or die ("Query failed.");
		
	//Output information about the entry
	echo 'You selected: ';
	while ($line = mysql_fetch_assoc($result)) {
		echo '<p class = "infobox"> Superiorocity: ' . $line['Superiorocity'] .
			'<br /> Name: ' . $line['Name'] .
			'<br /> Height: ' . $line['Height'] .
			'<br /> Robot: ' . $line['BotName'] .
			'<br /> Ship: ' . $line['ShipName'] . 
			'<br /> Assigned Planet: ' . $line['PLName'] . '</p>';
	}
	
	//Output confirm and cancel buttons
	echo 'Are you sure you want to delete this data?';
	echo '<form action = "' . $_SERVER['PHP_SELF'] . '" method = "post">
			<input type = "hidden" name = "superiorocity" value = "' . $superiorocity . '" />
			<input type = "submit" name = "confirmDelete" value = "Submit" class = "button" />
			<input type = "submit" name = "cancel" value = "Cancel" class = "button" />
		</form>';
		
}

//Run the delete queries
function runDeleteQuery() {
	require 'dbconfig.php';

	$superiorocity = $_POST['superiorocity'];
	
	//Delete from Invader
	$query = "DELETE FROM Invader WHERE Superiorocity=" . $superiorocity;
	$result = mysql_query($query, $dblink);

	//Delete from Ship
	$query = "DELETE FROM Ship WHERE Superiorocity=" . $superiorocity;
	$result = mysql_query($query, $dblink);

	//Delete from Robot
	$query = "DELETE FROM Robot WHERE Superiorocity=" . $superiorocity;
	$result = mysql_query($query, $dblink);

	//Delete from Planet
	$query = "DELETE FROM Planet WHERE Superiorocity=" . $superiorocity;
	$result = mysql_query($query, $dblink);
	
	//Confirmation message
	echo 'Entry deleted. <br />';
	echo '<form action = "' . $_SERVER['PHP_SELF'] . '" method = "post">
			<input type = "submit" name = "cancel" value = "Ok" class = "button" />
		</form>';
}

//Login the user
function userlogin($username, $pass) {
	require 'dbconfig.php';
	
	//Searches for an invader with name=$username and Superiorocity=$pass
	$query = "SELECT *
		FROM Invader
		NATURAL JOIN Ship
		NATURAL JOIN Robot
		NATURAL JOIN Planet 
		WHERE Invader.Superiorocity='" . $pass . "' AND Invader.Name='" . $username . "'";

	$result = mysql_query($query, $dblink)
		or die("Query failed");
	
	$returnMe = (mysql_num_rows($result) == 1);
	
	//If found, show the user form
	if($returnMe) {
		userForm($pass);
	}
	
	//Returns whether or not the user has been logged in
	return $returnMe;
}

//Shows drop down to change planet status
function userForm($superiorocity) {
	require 'dbconfig.php';

	//Find current status
	$query = "SELECT Name, StatusID
		FROM Invader
		NATURAL JOIN Planet
		WHERE Invader.Superiorocity='" . $superiorocity . "'";
	$result = mysql_query($query, $dblink)
		or die("Query failed");
	$line = mysql_fetch_assoc($result);
	
	//Display drop down
	echo 'Welcome Invader ' . $line['Name'] . '. <br />';
	echo '<form action = "' . $_SERVER['PHP_SELF'] . '" method = "post">
			<label for = "status">Status:
				<select name="status" class = "select">
				<option value="C"' . (($line['StatusID'] == 'U') ? ' selected="selected"' : ' ') . '>Conquered</option>
				<option value="U"' . (($line['StatusID'] == 'C') ? ' selected="selected"' : ' ') . '>Unconquered</option>
			</select></label>
			<br /><br />
			<input type = "hidden" name = "superiorocity" value = "' . $superiorocity . '" />
			<input type = "submit" name = "submit" value = "Submit" class = "button" />
			<input type = "submit" name = "cancel" value = "Cancel" class = "button" />
			</form>';
}

//Runs user update query
function peasantUpdate() {

	require 'dbconfig.php';
	
	$superiorocity = $_POST['superiorocity'];
	
	$query = "SELECT StatusID
		FROM Planet
		WHERE Planet.Superiorocity='" . $superiorocity . "'";
		
	$query = 'UPDATE Planet
		SET StatusID=\'' . $_POST['status'] 
		. '\' WHERE Superiorocity=\'' . $superiorocity . '\'';
		
	$result = mysql_query($query, $dblink)
		or die("Query failed");

	//Show confirmation
	echo '<form action = "' . $_SERVER['PHP_SELF'] . '" method = "post">
			Update submitted.
			<br />
			<input type = "submit" name = "cancel" value = "Ok" class = "button" />
			</form>';
}