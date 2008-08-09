<?php
// Wenn alle Felder ausgefuellt wurden und der Captcha stimmt, wird ein Cookie gesetzt
if($_GET['action'] != "" && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message']) && ereg ("^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$", $_POST['email']))

{

setcookie("spam_protection", "spam_protection", time()+500);

}

// Erstellen einer Rechenaufgabe

$Zahl_1 = intval(rand(1, 10));

$Zahl_2 = intval(rand(1, 10));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">

<head>
<title>Contact</title>
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
</head>

<body>
<div style="width:800px">
<img src="img/logo4.jpg" style="width:800px;height:100px;border:1px;margin:15px" alt="gpg4usb" />
<ul id="menu">
<li onclick="window.location.href='index.html';"><a href="index.html">News</a></li>
<li onclick="window.location.href='about.html';"><a href="about.html">About</a></li>
<li onclick="window.location.href='screenshots.html';"><a href="screenshots.html">Screenshots</a></li>
<li onclick="window.location.href='download.html';"><a href="download.html">Download</a></li>
<li onclick="window.location.href='develop.html';"><a href="develop.html">Develop</a></li>
<li class="active" onclick="window.location.href='contact.php';"><a href="contact.php">Contact</a></li>
</ul>

<div id="content">
<h1>Contact</h1>
<p>If you have questions regarding this Project, contact us via email at 
gpg4usb [AT] cpunk.de, or meet us via jabber in our channel <br />gpg4usb@conference.jabber.ccc.de<br /><br />  
To simplify things up, you can just use this form to send us a message:</p> 

<?php

// Wenn das Formular gesendet werden soll...

if($_GET['action'] == "send")

{

// ...der Cookie gegen Spam nicht gesetzt ist...

if($_COOKIE["spam_protection"] != "spam_protection")

{

// ... und die Rechenaufgabe FALSCH geloest wurde...

if($_POST['number'] != md5($_POST['arithmetic']))

{

// ...dann eine Fehlermeldung ausgeben!

echo "<p><font style=\"color:#0000;font-family:Geneva, Arial, Helvetica, sans-serif; font-size:16px\"><b>You didn't solve the arithmetical task correctly!</b></font></p>";

}

// Ansonsten, wenn die Rechenaufgabe RICHTIG geloest wurde stimmt...

if($_POST['number'] == md5($_POST['arithmetic']))

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

// dann den ganzen Muell von Spambots oder auch menschlichen Spammern entfernen...

$name          = nl2br(stripslashes(htmlspecialchars($_POST['name'])));
$IP            = getenv("REMOTE_ADDR");
$absender      = preg_replace( "/[^a-z0-9 !?:;,.\/_\-=+@#$&\*\(\)]/im", "", $_POST['email'] );
$absender      = preg_replace( "/(content-type:|bcc:|cc:|to:|from:)/im", "", $absender );
$nachricht     = nl2br(stripslashes(htmlspecialchars($_POST['message'])));

// ...die Nachricht, die Sie erhalten moechten, wenn eine neue Nachricht an Sie versandt wurde, definieren...

$mailnachricht = "Hallo!\n\nEs ist eine neue Nachricht fuer Sie eingetroffen:\n\n---------------------------------------------\n\nName:\n$name\n\nIP:\n$IP\n\nE-Mail:\n$absender\n\nNachricht:\n$nachricht\n\n---------------------------------------------\n\nSie koennen dem Absender der Nachricht direkt antworten, indem Sie einfach auf diese E-Mail antworten.\n\nMfG\nIhr Kontaktformular";

// ...an Sie verschicken...

mail("bugs@cpunk.de", "Eine neue Nachricht fuer Sie!", $mailnachricht, "From: $name <$absender>");

// ...und dem Benutzer sagen, dass alles glatt lief!

echo "<p><font style=\"color:#0000; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:16px\"><b>Thanks for your message!</b></font></p>";

}

// Wenn nicht alle Felder ausgefuellt wurden, dann...

else

{

// eine Fehlermeldung ausgeben!

echo "<p><font style=\"color:#0000; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:16px\"><b>Please fill in the complete form!</b></font></p>";

}

}

}

}

}

?>

<form id="form" name="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=send">

<table width="400" cellpadding="2" cellspacing="2" style="background-color:#0000; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:12px">

<tr>

<td width="150">

<strong>Your Name</strong></td>

<td width="188">

<input name="name" type="text" id="name" style="background-color:#CCCCCC; font-size:12px; font-family:Geneva, Arial, Helvetica, sans-serif; border : 1px solid #000000; width:186px" value="<?php echo $_POST['name']; ?>"/></td>

</tr>
<tr>

<td width="150">

<strong>Your Mail-Adress</strong></td>

<td width="188">

<input name="email" type="text" id="email" style="background-color:#CCCCCC; font-size:12px; font-family:Geneva, Arial, Helvetica, sans-serif; border : 1px solid #000000; width:186px" value="<?php echo $_POST['email']; ?>"/></td>

</tr>

<tr>

<td width="150">

<strong>Your Message</strong></td>

<td width="188">

<textarea name="message" id="message" style="background-color:#CCCCCC; font-size:12px; font-family:Geneva, Arial, Helvetica, sans-serif; border : 1px solid #000000; width:186px; height:100px" rows="4" cols="15"><?php echo $_POST['message']; ?></textarea></td>

</td>

</tr>

<tr>

<td width="150">

<strong>Spamprotection:<br /> How much is <?php echo $Zahl_1; ?> plus <?php echo $Zahl_2; ?>?</strong>

</td>

<td>

<input name="number" type="hidden" id="number"  value="<?php echo md5(( $Zahl_1 + $Zahl_2 )); ?>"/>

<input name="arithmetic" type="text" id="arithmetic" style="background-color:#CCCCCC; font-size:12px; font-family:Geneva, Arial, Helvetica, sans-serif; border : 1px solid #000000; width:186px" onfocus="if(this.value=='put the sum in here...')this.value=''" onblur="if(this.value=='')this.value='put the sum in here...'" value="put the sum in here..."/>

</td>

<td align="center" valign="middle">

</td>
</tr>
<tr>
<td>

<strong>Possible Actions</strong>
</td>
<td>


<?php

// Wenn KEIN Cookie gegen Spam gesetzt wurde, dann soll der "Senden"-Button anklickbar sein

if($_COOKIE["spam_protection"] != "spam_protection")

{

?>

<input name="submit" type="submit" id="submit" value="submit" /> <input name="reset" type="reset" id="reset" value="reset" />

<?php

}

// Wenn aber ein Cookie gegen Spam gesetzt wurde, dann soll der "Senden"-Button blockiert werden

if($_COOKIE["spam_protection"] == "spam_protection")

{

?>

<input name="submit" type="submit" id="submit" value="submit" disabled="true" /> <input name="reset" type="reset" id="reset" value="reset" />

<?php

}
?>

</td>
</tr>
</table>
</form>

<h2>gpg-key:</h2>
<p>[our key]</p>
</div></div>
</body>
</html>
