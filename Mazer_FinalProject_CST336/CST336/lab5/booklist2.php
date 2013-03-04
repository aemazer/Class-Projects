<?php

include 'dbconfig.php';

echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="get">
Search: <input type="text" name="search" size="40"><input type="submit" value="Search"></form>' . "\r\n";

$query = 'SELECT title,firstname,lastname,genrename
FROM books b INNER JOIN authors a ON b.author=a.authorid
 INNER JOIN genre g ON b.genre=g.genreid';
if (!empty($_GET['search'])) {
       $query .= " WHERE (title LIKE '%" . mysql_real_escape_string(trim($_GET['search'])) . "%') OR
                         (lastname LIKE '%" . mysql_real_escape_string(trim($_GET['search'])) . "%') OR
                         (firstname LIKE '%" . mysql_real_escape_string(trim($_GET['search'])) . "%') OR
                         (genrename LIKE '%" . mysql_real_escape_string(trim($_GET['search'])) . "%') ";
}
$query .= ' ORDER BY genrename, ' .
  ((isset($_GET['sort']) && $_GET['sort']=='title') ?
       'title, lastname, firstname' : 'lastname, firstname, title');

$result = mysql_query($query, $dblink) or die("Retrieve query failed: $query " . mysql_error());

echo mysql_num_rows($result) . " record" .
 ((mysql_num_rows($result) != 1) ? "s" : "") .
 " returned.<br />\r\n";

echo '<table cellpadding="5">
<tr><th><a href="' . $_SERVER['PHP_SELF'] . '?sort=author">Author</a></th>
<th><a href="' . $_SERVER['PHP_SELF'] . '?sort=title">Title</a></th></tr>';

$LineNum = 0;
$oldgenre = '**';
$oldauthor = '**';

while ($line = mysql_fetch_assoc($result)) {
       if ($line['genrename'] != $oldgenre) {   // genre changed, print genre header
               echo '<tr bgcolor="#FFFF80"><td colspan="2"><h2>' .
                       $line['genrename'] . "</td></tr>\r\n";
               $oldgenre = $line['genrename'];
               $oldauthor = '**';
               $LineNum = 0;
       }

       echo '<tr' . (($LineNum++ & 1) ? ' bgcolor="#EEEEEE"' : '') . '><td>' .
       (($oldauthor != ($line['lastname'].$line['firstname'])) ?
           ('<b>' . $line['lastname'] . ', ' . $line['firstname'] . '</b>') : '&nbsp;')
       . '</td><td>' .
       $line['title'] . "</td></tr>\r\n";
       $oldauthor = ($line['lastname'].$line['firstname']);
}

echo '</table>';
