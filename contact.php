<?php session_start(); ?>

<?php

// Wenn alle Felder ausgefuellt wurden und der Captcha stimmt, wird ein Cookie gesetzt
if($_GET['action'] != "" && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message']) && ereg ("^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$", $_POST['email']))

// {

// setcookie("spam_protection", "spam_protection", time()+500);

// }

// Erstellen einer Rechenaufgabe

// $Zahl_1 = intval(rand(1, 10));

// $Zahl_2 = intval(rand(23, 42));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<title>gpg4usb - project: contact</title>
<link href="style.css" type="text/css" rel="stylesheet" media="screen" lang="EN">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
</head>

<body>
<body style="background-image:url(./pics/bg_line.gif); background-repeat:repeat;">

<div id="logo"><a href="./index.html"><img src="./pics/gpg4usb-logo.png" alt="gpg4usb logo"></a></div>

<div id="banner">
<div id="menu">
<ul>
<li><a href="./about.html" title="About gpg4usb">About</a></li>
<li><a href="./docu.html" title="Documentation">Documentation</li>
<li><a href="./development.html" title="Development">Development</a></li>
<li><a href="./contact.php" title="Contact">Contact</a></li>
</ul>
</div>
</div>

<div id="container">
<div style="clear:both;">&nbsp;</div>
<div id="content">

<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/securimage/securimage.php';
	$securimage = new Securimage();

// Wenn das Formular gesendet werden soll...

if($_GET['action'] == "send")

// {

// ...der Cookie gegen Spam nicht gesetzt ist...

// if($_COOKIE["spam_protection"] != "spam_protection")

// {

// ... und die Rechenaufgabe FALSCH geloest wurde...

// if($_POST['number'] != md5($_POST['arithmetic']))

// {

// ...dann eine Fehlermeldung ausgeben!

// echo "<p><font style=\"color:#0000;font-family:Geneva, Arial, Helvetica, sans-serif; font-size:16px\"><b>You didn't solve the arithmetical task correctly!</b></font></p>";

//}

// Ansonsten, wenn die Rechenaufgabe RICHTIG geloest wurde stimmt...

// if($_POST['number'] == md5($_POST['arithmetic']))



{

// ...und die eingegeben E-Mail Adresse in Wahrheit keine ist...

if(!ereg ("^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$", $_POST['email']))

{

// ...dann eine Fehlermeldung ausgeben!

echo "<p><font style=\"color:#0000; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:16px\"><b>Your given Mail-Adress is not valid!</b></font></p>";

}



// Ansonsten, wenn die eingegebene E-Mail Adresse auch wirklich eine ist...

if(ereg ("^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$", $_POST['email']))

{

// ...und kein Feld leer ist...

if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message']))

{

if ($securimage->check($_POST['captcha_code']) == false) {
	  // the code was incorrect
	  // you should handle the error so that the form processor doesn't continue
	 
	  // or you can use the following code if there is no validation or you do not know how
	  header('Location: ./code_fail.html');
	  //echo "<p><font style=\"color:#0000; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:16px\"><b>The security code entered was incorrect.</p>";
	  //echo "<p><font style=\"color:#0000; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:16px\"><b>Please go <a href='javascript:history.go(-1)'>back</a> and try again.</p>";
	  exit;
}

// dann den ganzen Muell von Spambots oder auch menschlichen Spammern entfernen...

$name          = nl2br(stripslashes(htmlspecialchars($_POST['name'])));
$IP            = getenv("REMOTE_ADDR");
$absender      = preg_replace( "/[^a-z0-9 !?:;,.\/_\-=+@#$&\*\(\)]/im", "", $_POST['email'] );
$absender      = preg_replace( "/(content-type:|bcc:|cc:|to:|from:)/im", "", $absender );
$nachricht     = stripslashes(htmlspecialchars($_POST['message']));

// ...die Nachricht, die Sie erhalten moechten, wenn eine neue Nachricht an Sie versandt wurde, definieren...

$mailnachricht = "Hallo!\n\nEs ist eine neue Nachricht fuer Sie eingetroffen:\n\n---------------------------------------------\n\nName:\n$name\n\nIP:\n$IP\n\nE-Mail:\n$absender\n\nNachricht:\n$nachricht\n\n---------------------------------------------\n\nSie koennen dem Absender der Nachricht direkt antworten, indem Sie einfach auf diese E-Mail antworten.\n\nMfG\nIhr Kontaktformular";

// ...an Sie verschicken...

mail("gpg4usb@cpunk.de", "Eine neue Nachricht fuer Sie!", $mailnachricht, "From: $name <$absender>");

// ...und dem Benutzer sagen, dass alles glatt lief!

header('Location: ./thx.html');
//echo "<p><font style=\"color:#0000; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:16px\"><b>Thanks for your message!</b></font></p>";
//echo "<p><font style=\"color:#0000; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:16px\"><b>Go <a href='javascript:history.go(-1)'>back</a>.</p>";
 exit;
}

// Wenn nicht alle Felder ausgefuellt wurden, dann...

else

{

// eine Fehlermeldung ausgeben!

echo "<p><font style=\"color:#0000; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:16px\"><b>Please fill in the complete form!</b></font></p>";

}

}

}

// }

// }

?>

<h1>Contact</h1>

<form id="form" name="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=send">

<table width="540" cellpadding="2" cellspacing="2" style="background-color:#0000; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:12px">

<tr>

<td width="200">

Your Name</td>

<td width="340">

<input name="name" type="text" id="name" style="background-color:#ADBBCA; font-size:12px; font-family:Geneva, Arial, Helvetica, sans-serif; border : 1px solid #000000; width:300px" value="<?php echo $_POST['name']; ?>"/></td>

</tr>
<tr>

<td width="200">

Your Mail-Adress</td>

<td width="340">

<input name="email" type="text" id="email" style="background-color:#ADBBCA; font-size:12px; font-family:Geneva, Arial, Helvetica, sans-serif; border : 1px solid #000000; width:300px" value="<?php echo $_POST['email']; ?>"/></td>

</tr>

<tr>

<td width="200">

Your Message</td>

<td width="340">

<textarea name="message" id="message" style="background-color:#ADBBCA; font-size:12px; font-family:Geneva, Arial, Helvetica, sans-serif; border : 1px solid #000000; width:300px; height:250px" rows="4" cols="15"><?php echo $_POST['message']; ?></textarea></td>

</td>

</tr>

<tr>

<td style="text-align:left;">

<img id="captcha" src="/securimage/securimage_show.php" alt="CAPTCHA Image" style="border: 1px solid #000000;" />
<object type="application/x-shockwave-flash" data="/securimage/securimage_play.swf?audio_file=/securimage/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#000&amp;borderWidth=1&amp;borderColor=#000" width="35" height="35" >
	 
	  <param name="movie" value="/securimage/securimage_play.swf?audio_file=/securimage/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000" />
	 
</object>
<!-- Spamprotection:<br /> How much is <?php echo $Zahl_1; ?> plus <?php echo $Zahl_2; ?>? -->

</td>

<td width="340">
<p style="text-align:left;">Enter the text you see in the image on the left:<br /><br />
<input type="text" name="captcha_code" size="16" maxlength="6" style="background-color:#ADBBCA; font-size:12px;  border: 1px solid #000000;" />
<a href="#" onclick="document.getElementById('captcha').src = '/securimage/securimage_show.php?' + Math.random(); return false">[ Different Image ]</a>


</p>

<!-- <input name="number" type="hidden" id="number"  value="<?php echo md5(( $Zahl_1 + $Zahl_2 )); ?>"/>

<input name="arithmetic" type="text" id="arithmetic" style="background-color:#ADBBCA; font-size:12px; font-family:Geneva, Arial, Helvetica, sans-serif; border : 1px solid #000000; width:250px" onfocus="if(this.value=='put the sum in here...')this.value=''" onblur="if(this.value=='')this.value='put the sum in here...'" value="put the sum in here..."/> -->

</td>

<td>

</td>
</tr>
<tr>
<td>

Possible Actions
</td>
<td style="text-align:left;">


<!-- <?php

// Wenn KEIN Cookie gegen Spam gesetzt wurde, dann soll der "Senden"-Button anklickbar sein

if($_COOKIE["spam_protection"] != "spam_protection")

{

?> -->

<input name="submit" type="submit" id="submit" value="submit" /> <input name="reset" type="reset" id="reset" value="reset" />

<!-- <?php

}

// Wenn aber ein Cookie gegen Spam gesetzt wurde, dann soll der "Senden"-Button blockiert werden

if($_COOKIE["spam_protection"] == "spam_protection")

{

?> -->
<!-- 
<input name="submit" type="submit" id="submit" value="submit" disabled="true" /> <input name="reset" type="reset" id="reset" value="reset" />

<?php

}
?> -->

</td>
</tr>
</table>
</form>

</div>

<div style="clear:none;">&nbsp;</div>
<div class="rightbox">
<div class="box_title">Mailing List</div>
<div class="box_content"><p>Our mailing list is hosted at <a href="http://lists.gzehn.de/mailman/listinfo/gpg4usb" >
http://lists.gzehn.de/</a>.
To keep the spam level low, you have to subscribe to send messages to the list.<br />The 
<a href="http://lists.gzehn.de/pipermail/gpg4usb/">archive</a> is publicly available.</p>
</div>
</div>
<!-- <div style="clear:right;">&nbsp;</div>
<div class="rightbox">
<div class="box_title">Jabber</div>
<div class="box_content"><p>You can meet us in our jabber channel <em>gpg4usb@conference.jabber.ccc.de</em></p>
</div>
</div> --> 
<div style="clear:right;">&nbsp;</div>
<div class="rightbox">
<div class="box_title">E-Mail</div>
<div class="box_content"><p>You can also send a mail to <br /><em>gpg4usb [AT] cpunk.de</em><br />
Please use our <a href="key.txt" target="_blank">gpg-key</a>
</p>
</div>
</div>

<div style="clear:both;">&nbsp;</div>

</div>
<p>&nbsp;</p>
</body>
</html>
