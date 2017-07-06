<?php
/*
 * ##################################################
 * #                                                #
 * # Mailscript                 					#
 * #                                                #
 * ##################################################
 *
 * File: sendmail.php
 * Version: 1.0
 * Last modified: 2015/01/25 15:38 CET
 * Author: Konrad Langenberg
 *
 * ===Notes==========================================
 * There are currently no notes.
 * ==================================================
 *
*/

$nachricht = false;

if (isset($_POST['name']))
{
    //Captcha überprüfen
    require 'recaptcha.php';
	require 'config.php';
    $response = null;
    $reCaptcha = new ReCaptcha($reCaptchaPrivkey);

    if ($_POST["g-recaptcha-response"])
    {
        $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"], $_POST["g-recaptcha-response"]);
    }

    if($response)//wenn Captcha ok
    {
        $sender = $_POST['email'];
        if (filter_var($sender, FILTER_VALIDATE_EMAIL))//Wenn email Ok
        {
            $servername = $_SERVER['SERVER_NAME'];
            $subject = '[Hallenbad] Neue Nachricht vom Kontakformular';
            $name = $_POST['name'];
            $text = $_POST['message'];
            $message = "Sie haben eine neue Nachricht vom Kontaktforumlar.\n\nName: $name\nE-Mail-Adresse: $sender\nNachricht:\n$text";

            $nachricht = 'Hallo';
            $header = 'From: ' . $name . ' via Hallenbad <' . $sender . '>' . "\r\n" .
                'Reply-To: ' . $sender . "\r\n";

            if (mail($mail, $subject, $message, $header))//wenn gesendet
            {
                $nachricht = "true";
            }
        }
        else
        {
            $nachricht = 'mail';
        }
    }
    else
    {
        $nachricht = 'Captcha';
    }
}

echo $nachricht;
?>