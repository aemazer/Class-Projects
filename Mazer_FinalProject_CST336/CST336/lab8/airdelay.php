<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>Airport Delay Search</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Rambla:400,700' rel='stylesheet' type='text/css'>
	<link href="css/ui-lightness/jquery-ui-1.9.2.custom.css" rel="stylesheet">
	<script src="js/jquery-1.8.3.js"></script>
	<script src="js/jquery-ui-1.9.2.custom.js"></script>
	<style type="text/css">
BODY {font-family: 'Rambla', sans-serif;}
input {font-size: 2.0em;};
/*#button {font-size: 1.5em; font-weight: bold; top: -3px; background-color: rgb(240,240,240);} */
#buttonholder {border: thin solid black; padding: 5px;}
#button {font-size: 1.5em; font-weight: bold; background-color: rgb(220,220,220); padding: 5px 10px; border: medium solid black;}
#button:hover {background-color: rgb(220,220,220);}
#button:active {color: red; background-color: rgb(240,240,240);}

</style>
</head>
<body>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" name="searchform">
	<p>
		<input type="text" name="search" style="width: 600px;" value="" id="SearchName" autofocus="autofocus" />
		<input type="hidden" name="id" id="SearchId" />
		<!-- div id="buttonholder" onclick="document.searchform.submit();"><span id="button">Get Delays</span></div -->
	</p>
</form>

<?php
//print_r($_POST);

include 'dbconfig.php';

if (!empty($_POST['id'])) {
	$search = mysql_real_escape_string(trim($_POST['id']));

	$query = "SELECT city FROM airport WHERE airportcode='$search'";
	$result = mysql_query($query) or die("Query failed: $query " . mysql_error());
	$line = mysql_fetch_assoc($result);
	$city = $line['city'];
	$query = "SELECT avg(DEP_DELAY + ARR_DELAY) AS delay,carrier,carriername 
	FROM ontime o INNER JOIN carrier c ON o.carrier=c.carriercode 
	WHERE ORIGIN='$search'
	GROUP BY carrier,carriername
	ORDER BY carriername";
	$result = mysql_query($query) or die("Query failed: $query " . mysql_error());

echo '<!-- ' . $query . ' -->';
	echo '<h1 style="margin-bottom: 0;">' . $search . ' - ' . $city . '</h1>';

	echo '<table cellpadding="10"><tr><td valign="top"><h2 align="center">Departing</h2>';
	
	$LineNum = 0;
	if (mysql_num_rows($result)) {
	   echo '<table cellpadding="5"><tr bgcolor="#DDDDDD"><th>Average delay (mins)</th>
		<th>Carrier</th><th>Airline Name</th></tr>';
	   while ($line = mysql_fetch_assoc($result)) {
		   echo '<tr ' . (($line['delay'] > 15) ? ' bgcolor="#FFC0C0"' : (($LineNum++ & 1) ? ' bgcolor="#EEEEEE"' : '')) . 
		   '><td align="right">' . $line['delay'] . '</td><td align="center">' .
		   $line['carrier'] . '</td><td>' . $line['carriername'] . '</td></tr>';
	   }
	   echo '</table><br />';
	}
	$query = "SELECT avg(DEP_DELAY + ARR_DELAY) AS delay,carrier,carriername 
	FROM ontime o INNER JOIN carrier c ON o.carrier=c.carriercode 
	WHERE DEST='$search'
	GROUP BY carrier,carriername
	ORDER BY carriername";
	$result = mysql_query($query) or die("Query failed: $query " . mysql_error());

echo '<!-- ' . $query . ' -->';
	
	echo '</td><td valign="top"><h2 align="center">Arriving</h2>';

	$LineNum = 0;
	if (mysql_num_rows($result)) {
	   echo '<table cellpadding="5"><tr bgcolor="#DDDDDD"><th>Average delay (mins)</th>
		<th>Carrier</th><th>Airline Name</th></tr>';
	   while ($line = mysql_fetch_assoc($result)) {
		   echo '<tr ' . (($line['delay'] > 15) ? ' bgcolor="#FFC0C0"' : (($LineNum++ & 1) ? ' bgcolor="#EEEEEE"' : '')) . 
		   '><td align="right">' . $line['delay'] . '</td><td align="center">' .
		   $line['carrier'] . '</td><td>' . $line['carriername'] . '</td></tr>';
	   }
	   echo '</table><br />';
	}
	echo '</td></tr></table>';
}
?>

<script type="text/javascript">
    $(document).ready(function(){
  
    $("#SearchName").autocomplete(
      {source:"airportajax.php",
  			delay:200,
  			minLength:2,
			autoFocus: true,
			select: function(event,ui) {
				// alert('Label: ' + ui.item.label + '; Value: ' + ui.item.value);
				$('#SearchId').val(ui.item.value);
				$('#SearchName').val(ui.item.label);
			}
  		}
    );
    });
</script>
</body>
</html>
