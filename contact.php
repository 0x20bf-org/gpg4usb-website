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
<li onclick="window.location.href='docu.html';"><a href="docu.html">Documentation</a></li>
<li onclick="window.location.href='download.html';"><a href="download.html">Download</a></li>
<li onclick="window.location.href='develop.html';"><a href="develop.html">Develop</a></li>
<li class="active" onclick="window.location.href='contact.php';"><a href="contact.php">Contact</a></li>
</ul>

<div id="content">
<h2>Mailing List</h2>
<p>Our mailing list is hosted at <a href="http://lists.gzehn.de/mailman/listinfo/gpg4usb" >
http://lists.gzehn.de/mailman/listinfo/gpg4usb</a>.
To keep spam level low, sending message is only for subscribers. The 
<a href="http://lists.gzehn.de/pipermail/gpg4usb/">archive</a> is publicly available.</p>

<h2>Jabber</h2>
<p>You can meet us in our jabber channel <em>gpg4usb@conference.jabber.ccc.de</em></p>

<h2>Email</h2>
<p>You can also send a mail to <em>gpg4usb [AT] cpunk.de</em> or use this form to send us a message:</p>

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
$nachricht     = stripslashes(htmlspecialchars($_POST['message']));

// ...die Nachricht, die Sie erhalten moechten, wenn eine neue Nachricht an Sie versandt wurde, definieren...

$mailnachricht = "Hallo!\n\nEs ist eine neue Nachricht fuer Sie eingetroffen:\n\n---------------------------------------------\n\nName:\n$name\n\nIP:\n$IP\n\nE-Mail:\n$absender\n\nNachricht:\n$nachricht\n\n---------------------------------------------\n\nSie koennen dem Absender der Nachricht direkt antworten, indem Sie einfach auf diese E-Mail antworten.\n\nMfG\nIhr Kontaktformular";

// ...an Sie verschicken...

mail("gpg4usb@cpunk.de", "Eine neue Nachricht fuer Sie!", $mailnachricht, "From: $name <$absender>");

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

Your Name</td>

<td width="188">

<input name="name" type="text" id="name" style="background-color:#CCCCCC; font-size:12px; font-family:Geneva, Arial, Helvetica, sans-serif; border : 1px solid #000000; width:186px" value="<?php echo $_POST['name']; ?>"/></td>

</tr>
<tr>

<td width="150">

Your Mail-Adress</td>

<td width="188">

<input name="email" type="text" id="email" style="background-color:#CCCCCC; font-size:12px; font-family:Geneva, Arial, Helvetica, sans-serif; border : 1px solid #000000; width:186px" value="<?php echo $_POST['email']; ?>"/></td>

</tr>

<tr>

<td width="150">

Your Message</td>

<td width="188">

<textarea name="message" id="message" style="background-color:#CCCCCC; font-size:12px; font-family:Geneva, Arial, Helvetica, sans-serif; border : 1px solid #000000; width:186px; height:100px" rows="4" cols="15"><?php echo $_POST['message']; ?></textarea></td>

</td>

</tr>

<tr>

<td width="150">

Spamprotection:<br /> How much is <?php echo $Zahl_1; ?> plus <?php echo $Zahl_2; ?>?

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

Possible Actions
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
<br /><br />
<h2>Our gpg-key:</h2>
<h3>-----BEGIN PGP PUBLIC KEY BLOCK-----<br />
Version: GnuPG v1.4.9 (GNU/Linux)<br />
<br />
mQGiBEidtoMRBACxTEK5fYugdih9OhO2B3J4v860xVxcaXoveXgykqglNbBXT0+5<br />
5R1TQu7CIqVHoYb8s3BMaHHarwa+GXvw6ZesV1JVAUt+665AglxuHwQ3IrsSaWlp<br />
JFwXXaGgrwWyn/aTelzCxom4aw8+DVEL/l0BvYxhgyXoE46VyGdei91jEwCgm0tW<br />
nd9EyRdae+8e4xL2NSJX3EcEAJTu6LHa/z0BnUsu48ZdFWqhZT7hI2HROyQ18EhH<br />
fuMhUlynT1O+hFcR9a1CCz7UqHa5ZMGulW4eddWWbeuxIG5nu7LlktD8+qLxXa7d<br />
JuyPGJgyqC2iW5JNMTTQlaR2/QA0Y1YKNIR6CzkSkR0T4c2pFsVzw0Jqp1BKiJFb<br />
JYV8BACfd/lPrhkahkCBgVJgrZmRKq6GAqG8+4kNoleGo9x8bTEtt/+WBxrxsxLe<br />
CQ5oDj56Or+N7cEcOOlK0bW4oM/qFZMLFALhW9a6kFW+z8JqVkb+UeAUZErMj+uI<br />
uafj/E1Iz2ayN3t43DV44/7/4rfYlaOknm0FqH2emK42NXjahbQiZ3BnNHVzYi1w<br />
cm9qZWN0IDxncGc0dXNiQGNwdW5rLmRlPohgBBMRAgAgBQJInbaDAhsjBgsJCAcD<br />
AgQVAggDBBYCAwECHgECF4AACgkQgKRDIS7NczpjuACfYnCtiAso1H9vp8IHVB22<br />
cLuGP6sAn28nflukImttcSsbgiAol23/89rRuQINBEidtoMQCADAjZhV0Uvgp+il<br />
JD9RjxWFNmzjnOlLWqThnyK9kyUc9FGGlnq4FMYX34ZGR3ngCqaYlf/Yy54PuUZB<br />
iQXZHBH1LLJW//Ux0crfselKWvxfMN3UHZl6/ysECeLX5DCNRKCnb1Wqx/0UA6+n<br />
79H/FSUG94Mf3YNvvrClMiQS17LbnQtmYICoFP/YO2dfc8ghNbLmcyc3XiTv1Puc<br />
iy9OJhZTASeksVJrir6ZM+Vx8EjYkS7bKtneX+QqlK9E5p3eUshiX4UBgPk1q92w<br />
DKytmy7QPd4egq1W6cJ9RZ5SioJC70vf1jXkWeiOS3Jjlz1wUybU/q0ybUP3QRim<br />
0qKwZNk7AAMFCACMwwFEMt56Sm9lAXWrjTKQcyR4ASJr//gJW2Yyc3rCSCSGppTS<br />
tAgFEaFMca/i3Wyv35cKQy/DejPQfcitaXmmgBDqeX6z8VzPyEVu8I9lnZTWr2Y8<br />
viqR6p4TSz2u5gSeMT6rNosrukMoehBh4I3eEXAs1pPwyFbJOepJCeMZwFiIZ469<br />
guXywLRBYvpiAkt29W/q2ndbsRVxq1+PVlXP9HFatt70rTfOlVShkI6vCyWcCl2F<br />
RlV7niCBkwSr8oH0hrt4GqvCzQtcGG1TrdeLuxBVVM+AACvVBEWxgk5b8yueK7jy<br />
xAYgEiYDLDtbJysNUCQsV4G35wm1nkaK8/ixiEkEGBECAAkFAkidtoMCGwwACgkQ<br />
gKRDIS7Nczrg5QCeNh2yio7SPI8TTZWbFCP6wUpjNvoAn3Bgbg7Y+hhzEe0r62Tp<br />
egB6gGxq<br />
=8/Ep<br />
-----END PGP PUBLIC KEY BLOCK-----<br /></h3>
</div></div>
</body>
</html>
