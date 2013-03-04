<?php

include 'dbconfig.php';

$query = 'SELECT lastname, firstname 
FROM authors 
ORDER BY lastname, firstname';

$result = mysql_query($query, $dblink) or die("Retrieve query failed: $query " . mysql_error());

echo mysql_num_rows($result) . " record" . 
  ((mysql_num_rows($result) != 1) ? "s" : "") . 
  " returned.<br />\r\n";


while ($line = mysql_fetch_assoc($result)) {
		echo $line['lastname'] . ', ' . $line['firstname'] .
		"<br />\r\n";
}

