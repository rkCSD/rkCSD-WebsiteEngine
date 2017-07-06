{*
* ##################################################
* #                                                #
* # rkCSD-WebsiteEngine_3                          #
* # A simple, modular and flexible CMS             #
* #                                                #
* # Copyright (C) by rkCSD Eu                      #
* #                                                #
* #	                              email@rkcsd.com  #
* #              www.customsoftwaredevelopment.de  #
* #                                                #
* ##################################################
*
* File: login.tpl - WebAdmin
* Version: 3.0.0
* Timestamp: 2016/08/08 15:51 GMT
* Author: Konrad Langenberg
*
* ===Notes==========================================
* There are currently no notes.
* ==================================================
*}

<form action="{$basepath}WebAdmin/" method="post">
	<input type="hidden" name="rkCSDWebsiteEngine.WebAdmin.isPost" value="1"/>
	<label for="Username">Benutzername:</label><br/>
	<input type="text" name="Username" id="Username"/><br/>
	<br/>
	<label for="Password">Kennwort:</label><br/>
	<input type="password" name="Password" id="Password"><br />
	<br/>
	<input type="submit" name="submit" value="Einloggen"/>&nbsp;<a href="{$basepath}">Abbrechen</a>
</form>
<br/>
Bitte beachten Sie, dass Ihre Daten nicht verschlüsselt übertragen werden!