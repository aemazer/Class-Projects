<?php
require 'common.php';
include 'statecountry.php';

ShowHeader('Lab 3');
echo '<h1> Weclome to the Nerd Survey!</h1>';
$ErrorFields=Array();

if (!empty($_POST)) {
	$errortext='';
	if(empty($_POST['school'])){
		$errortext .= '<li>Your school has not been entered. </li>';
		$ErrorFields[] = 'school';
	}
        if (empty($_POST['password'])) {
                $errortext .= '<li>Your password is blank.</li>';
                $ErrorFields[] = 'password';
        }
        if (empty($errortext)) {
                echo '<pre>';
                print_r($_POST);
                echo '</pre>';
                mail('amazer@csumb.edu','Lab 1',
                "Lab 1:\r\n\r\n" . print_r($_POST,true),
                'From: amazer@csumb.edu');
                echo "<h2>Form received and emailed. Thank you!</h2>";
                exit();
        }
        else {
                echo '<h2>There are problems:</h2><ul>' . $errortext . '</ul>';
        }
}
?>

<p>This survey is to determine the level of geekyness in college students</p>
<p>This survey is not optional. You will not be compensated.</p>

<form action="<?= $_SERVER['PHP_SELF'] ?>"method="post">
<?php 
ShowTextField('Your school (abrev.)', 'school', 10, 5);
ShowTextField('Your password','password', 10, 32, TRUE);
?>
In which state do you attend College/University: <?php  ShowStateDropDown(); ?>

<br />What is your major?<br />
<input type="radio" name="major" value="CS" />Computer Science<br />
<input type="radio" name="major" value="CD" />Communication Design<br />
<input type="radio" name="major" value="MATH" />Mathamatics<br />
<input type="radio" name="major" value="HCOM" />Human Communication<br />
<input type="radio" name="major" value="BIO" /> Biology<br />
<input type="radio" name="major" value="TAT" /> Teledramatic Arts and Technology<br />
<input type="radio" name="major" value="ENGR" /> Engineering<br />
<input type="radio" name="major" value="PSY" /> Psychology<br />
<input type="radio" name="major" value="PHIL" /> Philosophy<br />
OTHER: <input type="text" size="10" maxlength="7"><br />
<label for="contact">Do you prefer to be contacted by: </label>
<input type="checkbox" name="contact[]" value="E-mail" />E-mail
<input type="checkbox" name="contact[]" value="phone" />Phone<br />

What are your favorite t.v. shows?<br />
<select name="shows[]" multiple="multiple" size="10">
<option>Buffy the Vampire Slayer</option>
<option>Pokemon</option>
<option>Jersey Shore</option>
<option>Invader Zim</option>
<option>Star Trek</option>
<option>Xena: Warrior Princess</option>
<option>Keeping Up with the Kardashians</option>
<option>CSI</option>
<option>Barney</option>
<option>Firefly</option>
</select>
<br />
If you could be any fictional character, who would you be and why? <br />
<textarea name="characterchoice" rows="20" cols="80">Please type your answer here...</textarea> 
<input type="submit" name="Action" value="Submit Survey" />
<input type="reset" value="Clear Form" />

</form>

<?php
ShowFooter();