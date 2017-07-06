<form method="post" onsubmit="sendMail();return false;" id="contactform">

    <input name="name" id="name" placeholder="Name" type="text"/><br/>

    <input name="email" id="email" placeholder="Email" type="text"/><br/>

    <textarea name="message" id="message" placeholder="Nachricht"></textarea><br/>

    <div class="g-recaptcha" data-sitekey="{$reCaptchaPubkey}"></div><br/>

    <input type="submit" value="Nachricht senden" id="submitbtn"/>
    <input type="reset" value="Formular leeren" id="resetbtn"/>
</form>
<div id="msg"></div>