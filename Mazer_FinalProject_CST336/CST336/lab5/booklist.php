<?php

include 'dbconfig.php';

$query = 'SELECT title,firstname,lastname,genrename
FROM books b INNER JOIN authors a ON b.author=a.authorid
  INNER JOIN genre g ON b.genre=g.genreid
ORDER BY genrename, lastname, firstname, title';

$result = mysql_query($query, $dblink) or die("Retrieve query failed: $query " . mysql_error());

echo mysql_num_rows($result) . " record" . 
  ((mysql_num_rows($result) != 1) ? "s" : "") . 
  " returned.<br />\r\n";

echo '<table cellpadding="5">
<tr><th>Genre</th><th>Author</th><th>Title</th></tr>';

while ($line = mysql_fetch_assoc($result)) {
	echo '<tr><td>' . $line['genrename'] . '</td><td>' .
	$line['lastname'] . ', ' . $line['firstname'] . '</td><td>' .
	$line['title'] . "</td></tr>\r\n";
}

echo '</table>';
