<?php
$fh = fopen('CSVtest.csv', 'r');
$line=fgetcsv($fh);
echo '<table>';
while($line=fgetcsv($fh)) {
	echo '<tr> <td>'.$line[1].' '.$line[2].' </td><td>'.$line[3].'</td><td>'.$line[4].'</td></tr>';
}
echo '</table>';

