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

{if $login eq 1}<a href="{$basepath}WebAdmin/?performOperation=NEW_CONTENT&cgl=SLIDES" class="more"> [neu]</a>{/if}
<ul class="rslides">
	{foreach from=$slides item="rs"}
	<li{if $rs.stophere eq 1} class="start"{/if}>
		<img src="{$rs.image}" alt="{$rs.title}">
		<div class="info">
			<h5>{$rs.title}</h5>
			<p>{$rs.text}<a href="{$rs.link}&fromSlideCID={$rs.id}" class="more">[mehr >>]</a>{if $login eq 1}<br/>
			<a href="{$basepath}WebAdmin/?performOperation=EDIT_CONTENT&idContent={$rs.id}&cgl=SLIDES" class="more">[bearbeiten]</a> <a href="{$basepath}WebAdmin/?performOperation=UNLINK_CONTENT&idContent={$rs.id}&cgl=SLIDES" onclick="return confirm('Wenn Sie fortfahren, wird der gewählte Inhalt unwidderuflich gelöscht. Sind Sie sicher?');" class="more">[löschen]</a>{/if}</p>
		</div>
	</li>
	{/foreach}
</ul>

<div class="slideinfo notablet nomobile">
	<span class="text">
	</span>
</div>