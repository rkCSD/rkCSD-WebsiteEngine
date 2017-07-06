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
* File: slides.tpl
* Version: 3.0.0
* Timestamp: 2016/08/08 15:51 GMT
* Author: Konrad Langenberg
*
* ===Notes==========================================
* There are currently no notes.
* ==================================================
*}
{if $login eq 1}<a href="{$basepath}WebAdmin/?performOperation=NEW_CONTENT&cgl=NEWS" class="more"> [neu]</a>{/if}
{foreach from=$news item="ni"}
    {if ($ni.timest < time()) || ($ni.timest > time() && $login == 1)}
    <h1>{$ni.date} |
        {$ni.title}
        {if $ni.content != ''}
            <a href="{$basepath}news?idContent={$ni.id}" class="more">[mehr >>]</a>
        {/if}
        {if $login eq 1}
            <a href="{$basepath}WebAdmin/?performOperation=UNLINK_CONTENT&idContent={$ni.id}&cgl=NEWS" onclick="return confirm('Wenn Sie fortfahren, wird der gewählte Inhalt unwidderuflich gelöscht. Sind Sie sicher?');" class="more">[LÖSCHEN]</a> |
            <a href="{$basepath}WebAdmin/?performOperation=EDIT_CONTENT&idContent={$ni.id}">[Bearbeiten]</a>
        {/if}
    </h1>
    {/if}
{/foreach}