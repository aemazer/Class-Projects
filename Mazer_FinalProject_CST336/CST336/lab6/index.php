<?php

require 'dbconfig.php';

$query = "SELECT FirstName, LastName, UNIX_TIMESTAMP(Born) AS Born, 
UNIX_TIMESTAMP(Died) AS Died, ClosenessDesc, CauseOfDeath FROM absentfriends NATURAL JOIN closeness ";
if (isset($_GET['sort']) && ($_GET['sort'] == 'Born')) {
	$query .= "ORDER BY Born, LastName, FirstName";
}
elseif (isset($_GET['sort']) && ($_GET['sort'] == 'Died')) {
	$query .= "ORDER BY Died, LastName, FirstName";
}
elseif (isset($_GET['sort']) && ($_GET['sort'] == 'Closeness')) {
	$query .= "ORDER BY ClosenessDesc, LastName, FirstName";
}
elseif (isset($_GET['sort']) && ($_GET['sort'] == 'Cause')) {
	$query .= "ORDER BY CauseOfDeath, LastName, FirstName";
}
else {
	$query .= "ORDER BY LastName, FirstName";
}

$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());

$count = mysql_num_rows($result);

echo $count . " record" . (($count != 1) ? 's' : '') . " found.<br />";

/* FirstName, LastName, Born, Died, ClosenessDesc, CauseOfDeath */

echo '<table cellpadding="5">
<thead><tr><th><a href="' . $_SERVER['PHP_SELF'] . '?sort=Name">Name</a></th>
<th><a href="' . $_SERVER['PHP_SELF'] . '?sort=Born">Born</a></th>
<th><a href="' . $_SERVER['PHP_SELF'] . '?sort=Died">Died</a></th>
<th><a href="' . $_SERVER['PHP_SELF'] . '?sort=Closeness">Closeness</a></th>
<th><a href="' . $_SERVER['PHP_SELF'] . '?sort=Cause">Cause</a></th></tr></thead><tbody>';

while ($line = mysql_fetch_assoc($result)) {
	echo '<tr><td>' . $line['LastName'] . ', ' . $line['FirstName'] .
	'</td><td>' . $line['Born'] . (($line['Born'] != 0) ? date('m/d/Y',$line['Born']) : '') . 
	'</td><td>' . (($line['Died'] != 0) ? date('m/d/Y',$line['Died']) : '') .
	'</td><td>' . $line['ClosenessDesc'] .
	'</td><td>' . $line['CauseOfDeath'] .
	'</td></tr>';



}

echo '</tbody></table>';

