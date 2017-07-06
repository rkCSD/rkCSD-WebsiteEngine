{*
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
 * File: cms.tpl - WebAdmin
 * Version: 3.0.0
 * Timestamp: 2016/08/08 15:51 GMT
 * Author: Konrad Langenberg
 *
 * ===Notes==========================================
 * There are currently no notes.
 * ==================================================
*}
<header><h2>{$WebsiteTitle} - rkCSD-WebAdmin</h2></header>

{if $cms_msg eq "DM1"}
    <p><span style="font-weight: bold;">Sie haben sich erfolgreich im System eingeloggt.</span> Jetzt stehen Ihnen
        überall auf der Website die administrativen Funktionen zur Verfügung. Bitte vergessen Sie nicht, sich aus
        Sicherheitsgründen nach dem Abschluss Ihrer Arbeiten wieder abzumelden. Sie finden den Logout-Button im
        Hauptmenü (oben).</p>
{elseif $cms_msg eq "DM2"}
    <p><span style="font-weight: bold;">Login fehlgeschlagen! <a href="{$basepath}WebAdmin/?performOperation=LOGIN">Erneut versuchen?</a></span></p>
{elseif $cms_msg eq "DM3"}
    <p><span style="font-weight: bold;">Sie haben sich erfolgreich vom System abgemeldet.</span> Sie können den Browser
        nun gefahrlos beenden oder weiter im Web surfen.</p>
{elseif $cms_msg eq "DM4"}
    <p>Der gewählte Inhalt wurde wunschgemäß unwiderruflich gelöscht.</p>
{/if}

{if $cms_msg eq ""}
    {if !$login || $cms_action == "LOGIN"}
        {include file='apps/WebAdmin/tpl/login.tpl'}
    {elseif $cms_action eq "EDIT" && $login}
        {include file='apps/WebAdmin/tpl/tinymce.tpl'}
    {/if}
{/if}