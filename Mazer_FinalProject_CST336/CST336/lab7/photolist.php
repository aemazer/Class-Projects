<?php

require 'dbconfig.php';

$query = "SELECT id,photoname,thumbwidth,thumbheight 
	FROM uploadedphotos";
$result = mysql_query($query,$dblink) or die("Query failed: $query " . mysql_error());
while ($line = mysql_fetch_assoc($result)) {
	echo '<a href="showphoto.php?ID=' . $line['id'] . '"><img src="showphoto.php?ID=' . $line['id'] . '&type=t" width="' .
		$line['thumbwidth'] . '" height="' . $line['thumbheight'] . '" /></a>' .
		$line['photoname'] . "<br />\r\n";
}

