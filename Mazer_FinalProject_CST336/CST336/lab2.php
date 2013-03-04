<!DOCTYPE html>
<html>

<head>
<title>Lab 2</title>
<STYLE  type="text/css">
BODY {font-family: Verdana; font-size: 14pt;}
.error {border: thin solid red;}
</style>
</head>

<body>
<h1> Weclome to the Nerd Survey!</h1>
<?php
if (!empty($_POST)) {
	$errortext='';
	if(empty($_POST['school'])){
		$errortext .= '<li>Your school has not been entered. </li>';
		$schoolbad = 1;
	}
        if (empty($_POST['password'])) {
                $errortext .= '<li>Your password is blank.</li>';
                $passwordbad = 1;
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
<label>In which State do you attend College/University?<br />
<select name="state">
<option value="  "></option>
<option value="AL">Alabama</option>
<option value="AK">Alaska</option>
<option value="AZ">Arizona</option>
<option value="AR">Arkansas</option>
<option value="CA">California</option>
<option value="CO">Colorado</option>
<option value="CT">Connecticut</option>
<option value="DE">Delaware</option>
<option value="DC">District of Columbia</option>
<option value="FL">Florida</option>
<option value="GA">Georgia</option>
<option value="HI">Hawaii</option>
<option value="ID">Idaho</option>
<option value="IL">Illinois</option>
<option value="IN">Indiana</option>
<option value="IA">Iowa</option>
<option value="KS">Kansas</option>
<option value="KY">Kentucky</option>
<option value="LA">Louisiana</option>
<option value="ME">Maine</option>
<option value="MD">Maryland</option>
<option value="MA">Massachusetts</option>
<option value="MI">Michigan</option>
<option value="MN">Minnesota</option>
<option value="MS">Mississippi</option>
<option value="MO">Missouri</option>
<option value="MT">Montana</option>
<option value="NE">Nebraska</option>
<option value="NV">Nevada</option>
<option value="NH">New Hampshire</option>
<option value="NJ">New Jersey</option>
<option value="NM">New Mexico</option>
<option value="NY">New York</option>
<option value="NC">North Carolina</option>
<option value="ND">North Dakota</option>
<option value="OH">Ohio</option>
<option value="OK">Oklahoma</option>
<option value="OR">Oregon</option>
<option value="PA">Pennsylvania</option>
<option value="RI">Rhode Island</option>
<option value="SC">South Carolina</option>
<option value="SD">South Dakota</option>
<option value="TN">Tennessee</option>
<option value="TX">Texas</option>
<option value="UT">Utah</option>
<option value="VT">Vermont</option>
<option value="VA">Virginia</option>
<option value="WA">Washington</option>
<option value="WV">West Virginia</option>
<option value="WI">Wisconsin</option>
<option value="WY">Wyoming</option>
<option value="--">------------</option>
<option value="AS">American Samoa</option>
<option value="FM">Federated States of Micronesia</option>
<option value="GU">Guam</option>
<option value="MH">Marshall Islands</option>
<option value="MP">Northern Mariana Islands</option>
<option value="PW">Palau</option>
<option value="PR">Puerto Rico</option>
<option value="VI">Virgin Islands</option>
<option value="--">------------</option>
<option value="AE">Armed Forces Canada, Africa, Europe, Middle East</option>
<option value="AA">Armed Forces Americas (except Canada)</option>
<option value="AP">Armed Forces Pacific</option>
<option value="--">------------</option>
<option value="AB">Alberta</option>
<option value="BC">British Columbia</option>
<option value="MB">Manitoba</option>
<option value="NB">New Brunswick</option>
<option value="NL">Newfoundland and Labrador</option>
<option value="NS">Nova Scotia</option>
<option value="NT">Northwest Territories</option>
<option value="NU">Nunavut</option>
<option value="ON">Ontario</option>
<option value="PE">Prince Edward Island</option>
<option value="QC">Qu&eacute;bec</option>
<option value="SK">Saskatchewan</option>
<option value="YT">Yukon</option>
</select><br />
<?= ((!empty($schoolbad)) ? '<div class="error">' : '') ?><label for="school">Your school (abrev): </label><input type="text" name="school" size="10" maxlength="5"><br />
<?= ((!empty($schoolbad)) ? '</div>' : '') ?>
<?= ((!empty($passwordbad)) ? '<div class="error">' : '') ?><label for="password">Your password>: </label><input type="password" name="password" size="10" maxlength="32"><br />
<?= ((!empty($passwordbad)) ? '</div>' : '') ?>
<label for="major">What is your major?</label> <br />
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

<p><label for="tv">What are your favorite t.v. shows?</label></p>
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
<p><label for="character">If you could be any fictional character, who would you be and why?</label></p>
<textarea name="characterchoice" rows="20" cols="80">Please type your answer here...</textarea> 
<input type="submit" name="Action" value="Submit Survey" />
<input type="reset" value="Clear Form" />

</form>

</body>

</html>