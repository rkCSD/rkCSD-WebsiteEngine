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
* File: tinymce.tpl - WebAdmin
* Version: 3.0.0
* Timestamp: 2016/08/08 15:51 GMT
* Author: Konrad Langenberg
*
* ===Notes==========================================
* There are currently no notes.
* ==================================================
*}

{if $submit}
    {if $msg == 1}
        Die Seite wurde erfolgreich bearbeitet. <a href="javascript:history.go(-2);">Zurück</a>
    {/if}

    {if $msg == 2}
        Es ist ein Fehler beim bearbeiten der Seite aufgetreten. <a href="#" onclick="history.back(-1)">Zurück</a>
    {/if}
{else}
    {if $cgid eq 4}
        <script src="{$basepath}extensions/tinymce/plugins/moxiemanager/js/moxman.loader.min.js"></script>
        <script src="{$basepath}extensions/pick_file.js"></script>
    {/if}
    <script>
        function toggle() {
            $('#toggleContainer').slideToggle('fast', function () {
                if($('#toggleLink').html() == 'Mehr einblenden'){
                    $('#toggleLink').html('Mehr ausblenden');
                } else {
                    $('#toggleLink').html('Mehr einblenden');
                }
            });
        }
    </script>
    <form action="" method="post">
        <input type="hidden" name="idContent" value="{$cid}"/>
        <input type="hidden" name="idContentGroups" value="{$cgid}"/>

        <span style="font-weight: bold;">Seiten-Titel:</span><br/>
        <input type="text" name="ContentTitle" value="{$title}"/><br/>
        <a onclick="toggle();" style="cursor: pointer;" id="toggleLink">Mehr einblenden</a>
        <br/>
        <div id="toggleContainer" style="display: none;">
            <span style="font-weight: bold;">{if $cgid eq 4}Bild-Datei: (638 x 286 px){else}Seiten-Stichwörter: (für Suchmaschinen wichtig){/if}</span><br/>
            <input type="text" name="ContentKeywords" value="{$keywords}"/>
            {if $cgid eq 4}
                <input type="button" value="Bild auswählen..." onclick="pick_file();"/>
        <br/>{/if}
            <br/>
            <span style="font-weight: bold;">{if $cgid eq 4}Verweis/Link:{else}Seiten-Kurzbeschreibung: (für Suchmaschinen wichtig){/if}</span><br/>
            <input type="text" name="ContentDescription" value="{$descr}"/><br/>
        </div>
        <br/>
        <textarea name="ContentText" id="editor">{$content}</textarea><br/>
        <!-- TeamViewer Logo (generated at http://www.teamviewer.com) -->
        <div style="position:relative; width:234px; height:60px;float: right;">
            <a href="https://get.teamviewer.com/rkcsd" style="text-decoration:none;" target="_blank">
                <img src="http://www.teamviewer.com/link/?url=232691&id=1371814679" alt="Fragen oder Probleme? rkCSD-QuickSupport starten" title="Fragen oder Probleme? rkCSD-QuickSupport starten" border="0" width="234" height="60" />
                <span style="position:absolute; top:23px; left:60px; display:block; cursor:pointer; color:White; font-family:Arial; font-size:12px; line-height:1.2em; font-weight:bold; text-align:center; width:169px;">
      Fragen oder Probleme? rkCSD-QuickSupport starten
    </span>
            </a>
        </div>

        <span style="font-weight: bold;">Erstellungs-Datum/Uhrzeit:</span><br/>
        {if $is_news}
            <input type="text" name="cdate_pub" value="{$cdate}"/>
        {else}
            {$cdate}
        {/if}
        {* html_select_date field_order="DMY" start_year="-2" end_year="+1" prefix="Content" time=$cdate}<br/>
        {html_select_time prefix="Content" time=$ctime *}<br/>
        <br/>
        <input type="submit" value="Änderungen speichern" name="editSubmit"/>&nbsp;<a
                href="{$basepath}">Abbrechen</a><br/>
        <br/>
    </form>
{/if}