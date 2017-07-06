{if $cookiesAcc eq 0}
<div class="CookieMSGOverlay">
    <div class="CookieMSG">
        <h1 style="margin-top: 0; font-size: 25pt;">Cookies</h1>
        <p>Cookies sind kleine Textdateien, die auf Ihrem Computer gespeichert werden. Sie werden genutzt, um eine
            optimale Funktionsweise unserer Weseite zu gewährleisten um z.B. Einstellungen zu speichern, die Sie auf unserer Webseite
            vorgenommen haben, sowie um uns statistische Auswertungen der Webseite-Nutzung zu ermöglichen.
            Klicken Sie auf „Zustimmen und Fortfahren“, um Cookies zu akzeptieren und direkt zur Website weiter zu navigieren.
            Um unsere Webseite nutzen zu können, müssen Sie Cookies akzeptieren.</p>

        <a class="link" onclick="showCookieInfos();" id="sCLink" style="cursor: pointer;">Welche Cookies werden gesetzt?</a>
        <p id="CookieInfos" style="display: none">
            <span class="subcaption" id="Cookies">Cookies</span><br/>
            <br/>
            Damit dieses Internetportal ordnungsgemäß funktioniert, legen wir manchmal kleine Dateien – sogenannte Cookies – auf Ihrem Gerät ab. Das ist bei den meisten großen Websites üblich.
            <br/><br/>
            <span class="subcaption">Was sind Cookies?</span><br/>
            <br/>
            Ein Cookie ist eine kleine Textdatei, die ein Webportal auf Ihrem Rechner, Tablet-Computer oder Smartphone hinterlässt, wenn Sie es besuchen. So kann sich das Portal bestimmte Eingaben und Einstellungen (z. B. Login, Sprache, Schriftgröße und andere Anzeigepräferenzen) über einen bestimmten Zeitraum „merken“, und Sie brauchen diese nicht bei jedem weiteren Besuch und beim Navigieren im Portal erneut vorzunehmen.
            <br/><br/>
            <span class="subcaption">Wie setzen wir Cookies ein?</span><br/>
            <br/>Auf unserer Websseite werden die folgenden Cookies eingesetzt:<br/>
            {$cookiesAll}
            <br/>
            <span class="subcaption">Kontrolle über Cookies</span><br/>
            <br/>
            Sie können Cookies nach Belieben steuern und/oder löschen. Wie, erfahren Sie hier: <a href="http://aboutcookies.org">aboutcookies.org</a>.  Sie können alle auf Ihrem Rechner abgelegten Cookies löschen und die meisten Browser so einstellen, dass die Ablage von Cookies verhindert wird. Dann müssen Sie aber möglicherweise einige Einstellungen bei jedem Besuch einer Seite manuell vornehmen und die Beeinträchtigung mancher Funktionen in Kauf nehmen.
        <p/>
        <p style="margin-bottom: 0;"><button onclick="acceptCookies();">Zustimmen und Fortfahren</button></p>
    </div>
</div>
<div id="loadC"></div>
{/if}