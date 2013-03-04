<?php

if (!file_exists('upload.txt')) {
   die("Don't have any information to scan.");
}
$inputfile = file_get_contents('upload.txt');
$count = preg_match_all('|(\d{3})[\) \-]+(\d{3})-(\d{4})|U',
$inputfile,$matches);
if ($count == 0) {
   die("No phone numbers found in file.");
}
for($i = 0; $i < count($matches[0]); $i++) {
   echo '(' . $matches[1][$i] . ') ' . $matches[2][$i] . '-' . 
	$matches[3][$i] . "<br />\r\n";
}

