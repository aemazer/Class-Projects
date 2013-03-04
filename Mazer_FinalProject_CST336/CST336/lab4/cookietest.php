<?php
if(isset($_POST['action']) && $_POST['action']=='create cookie') {
	setcookie('lab4test', 'on', time()+60);
}
if(isset($_POST['action']) && $_POST['action']=='delete cookie') {
	setcookie('lab4test', '', time()-60);
}
print_r($_COOKIE);
?>
<form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
<input type="submit" name="action" value="create cookie" />
<input type="submit" name="action" value="delete cookie" />
<input type="submit" name="action" value="refresh cookie" />
</form>
