<?php

session_start();

require 'dbconfig.php';
echo '<html><body>';

$query = "SELECT SQL_CALC_FOUND_ROWS FirstName, LastName, UNIX_TIMESTAMP(Born) AS Born, 
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

if (!isset($_GET['start'])) {
	$_SESSION['query'] = $query;
	$query .= " LIMIT 25";
}
else {
	$query = (!empty($_SESSION['query']) ? $_SESSION['query'] : $query);
	$query .= " LIMIT " . intval($_GET['start']) . ",25";
}

$result = mysql_query($query,$dblink) or die("Retrieve query failed: $query " . mysql_error());

$count = mysql_num_rows($result);

if (!isset($_GET['start'])) {
	$fquery = "SELECT FOUND_ROWS() AS numrows";
	$fresult = mysql_query($fquery,$dblink) or die("Found Rows Query failed: $fquery " . mysql_error());
	$fline = mysql_fetch_assoc($fresult);
	$_SESSION['totalrows'] = $fline['numrows'];
}

echo $count . " record" . (($count != 1) ? 's' : '') . " found in this set.<br />";
echo $_SESSION['totalrows'] . " record" . (($_SESSION['totalrows'] != 1) ? 's' : '') . " found overall.<br />";

/* FirstName, LastName, Born, Died, ClosenessDesc, CauseOfDeath */

function ShowPrevNext() {
	echo '<table width="100%"><tr><td>';
	if (empty($_GET['start'])) {
		echo '&nbsp;';
	}
	else {
		echo '<a href="' . $_SERVER['PHP_SELF'] . "?start=" .
		(($_GET['start'] < 25) ? 0 : (intval($_GET['start'])-25)) . '">&lt;&lt;PREV</a>';
	}
	echo '</td><td align="right">'; 
	if (!empty($_GET['start']) && (intval($_GET['start']+25)>$_SESSION['totalrows'])) {
		echo '&nbsp;';
	}
	else {
		echo '<a href="' . $_SERVER['PHP_SELF'] . "?start=" .
			((!empty($_GET['start']) ? intval($_GET['start']) : 0) + 25) . '">Next&gt;&gt;</a>';
	}
	echo '</td></tr></table>' . "\r\n";
}

ShowPrevNext();
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
ShowPrevNext();

echo "</body></html>";
