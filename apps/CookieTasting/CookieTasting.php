<?php
/*
 * ##################################################
 * #                                                #
 * # rkCSD-WebsiteEngine_3                          #
 * # A simple, modular and flexible CMS             #
 * #                                                #
 * # Copyright (C) by rkCSD Eu                      #
 * #                                                #
 * #	                           email@rkcsd.com  #
 * #              www.customsoftwaredevelopment.de  #
 * #                                                #
 * ##################################################
 *
 * File: CookieTasting.php - CookieTasting
 * Version: 3.0.0
 * Timestamp: 2016/08/08 15:51 GMT
 * Author: Konrad Langenberg
 *
 * ===Notes==========================================
 * There are currently no notes.
 * ==================================================
 */

//Cookie Setzen
if(isset($_GET['setcookie']))
{
    setcookie('cookieAccept', true, time()+5184000, '/');//verfällt in 2 monaten
	exit;
}
else {
    $cookiesAccept = false;
    if (isset($_COOKIE['cookieAccept'])) {
        $cookiesAccept = true;
    }

    //Alle Cookies ausgeben
	$siteCookies = array(
		'rkSessionID' => 'Wird genutzt, um ihre Anmeldeinformationen zu speichern.',
		'NID' => 'Wird von Goolgle gesetzt, um die Auswertung des Captchas zu ermöglichen.',
		'_pk_' => 'Piwik-Tracking Cookie, wird gesetzt, um uns statistische Auswertungen der Webseite-Nutzung zu ermöglichen.'
	);

	$cookiesAll = '';

    foreach ($siteCookies as $cookieName => $cookieDescription) {
            //var_dump($cookiesNoch);
            $cookiesAll .= '<b>' . $cookieName . '</b><br/>'.$cookieDescription.'<br/>';
    }

	$rkWeb->assign('cookiesAll', $cookiesAll);
	$rkWeb->assign('cookiesAcc', $cookiesAccept);
}
?>