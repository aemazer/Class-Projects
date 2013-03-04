<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload Photo File</title>
</head>

<body>
<h1>Upload Photo File</h1>
<?php
echo '<pre>';
print_r($_FILES);
echo '</pre>';

if (!empty($_FILES['photofile']['name'])) {
	if (!is_uploaded_file($_FILES['photofile']['tmp_name'])) {
		die($_FILES['photofile']['name'] . " is not a valid file.");
	}
	require 'dbconfig.php';

$sourcefile = imagecreatefromstring(file_get_contents($_FILES['photofile']['tmp_name']));
/********* PHOTO PROCESSING ***********/
// Constrain to 600x600
if ( (imagesx($sourcefile) < 600) && (imagesy($sourcefile) < 600) ) {
	$photofile = $sourcefile;
}
else {	// we need to scale down the big image
  if (imagesx($sourcefile) > imagesy($sourcefile)) {
        // landscape orientation
    $newx = 600;
    $newy = round(600/imagesx($sourcefile)*   imagesy($sourcefile));
  }
  else {
        // portrait orientation
    $newx = round(600/imagesy($sourcefile)* imagesx($sourcefile));
    $newy = 600;
  }
  $photofile = imagecreatetruecolor($newx,$newy);
  imagecopyresampled ($photofile, $sourcefile, 0,0, 0,0, $newx, $newy, 
	imagesx($sourcefile), imagesy($sourcefile)); 
  echo "Photo sized down to $newx,$newy.<br />";
}
ob_start();
imagejpeg($photofile);
$photodata = ob_get_clean();
/********* THUMBNAIL PROCESSING ***********/
// Constrain to 150x150
if (imagesx($sourcefile) > imagesy($sourcefile)) {
        // landscape orientation
  $newx = 150;
  $newy = round(150/imagesx($sourcefile)*   imagesy($sourcefile));
}
else {
        // portrait orientation
  $newx = round(150/imagesy($sourcefile)* imagesx($sourcefile));
  $newy = 150;
}
$thumb = imagecreatetruecolor($newx,$newy);
imagecopyresampled ($thumb, $sourcefile, 0,0, 0,0, $newx, $newy, 
	imagesx($sourcefile), imagesy($sourcefile)); 
ob_start();
imagejpeg($thumb);
$thumbdata = ob_get_clean();

	$query = "INSERT INTO uploadedphotos (photoname,phototype,
	photodata,thumbwidth,thumbheight,thumbdata,photodate) 
	VALUES ('" . 
		addslashes($_FILES['photofile']['name']) . "',
		'image/jpeg',
		'" . mysql_real_escape_string($photodata) . "',
		$newx,
		$newy,
		'" . mysql_real_escape_string($thumbdata) . "',Now())";
	// echo "Query: '$query'<br />";  	// DEBUG!!
	mysql_query($query,$dblink) 
		or die("Update query failed: $query " . mysql_error());
	echo "<b>Photo upload of " . $_FILES['photofile']['name'] . 
		" succeeded.</b>";
	echo "Thumbnail created ($newx,$newy).<br />";
	exit();
}
?>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
Upload Photo File: <input type="file" name="photofile" />
<input type="hidden" name="id" value="<?= $_REQUEST['id'] ?>" />
<input type="submit" value="Upload" />
</form>

</body>
</html>
