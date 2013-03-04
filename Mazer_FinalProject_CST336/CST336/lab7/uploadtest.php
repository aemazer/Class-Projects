<?php
echo '<html><head><title>Upload Test</title></head><body>';

print_r($_FILES);

if (isset($_FILES['uploadfile'])) {
	require 'dbconfig.php';
	$query = "INSERT INTO uploadedfiles (filename,filesize,filetype,filedate,filedata)
VALUES ('" . mysql_real_escape_string($_FILES['uploadfile']['name']) . "'," .
intval($_FILES['uploadfile']['size']) . ",'" . mysql_real_escape_string($_FILES['uploadfile']['type']) .
"',Now(),'" . mysql_real_escape_string(file_get_contents($_FILES['uploadfile']['tmp_name'])) . "')";
// echo "Query: $query<br />\r\n";
	mysql_query($query,$dblink) or die("Insert query failed: " . mysql_error() . " $query");
	echo "<p><b>Upload of file succeeded!</b></p>";
}


echo '
<form action="' . $_SERVER['PHP_SELF'] . '" enctype="multipart/form-data" method="post">
<label>File to upload: <input type="file" name="uploadfile" /></label>
<input type="submit" value="Upload the file" />
</form></body></html>';

