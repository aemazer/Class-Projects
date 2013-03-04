<?php

include 'dbconfig.php';

$query = 'SELECT title FROM books ORDER BY title';

$result = mysql_query($query, $dblink) or die("Retrieve query failed: $query " . mysql_error());

echo mysql_num_rows($result) . " record" . 
  ((mysql_num_rows($result) != 1) ? "s" : "") . 
  " returned.<br />\r\n";


while ($line = mysql_fetch_assoc($result)) {
		echo $line['title'] . "<br />\r\n";
}

