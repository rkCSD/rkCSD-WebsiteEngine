<!DOCTYPE HTML>
<html>
<head>
    <title>{$WebsiteTitle} | CMS</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="generator" content="{$meta_generator}"/>

    <meta name="keywords" content="{$meta_keywords}"/>
    <meta name="description" content="{$meta_description}"/>

    <link rel="icon" href="favicon.png"/>
    <noscript>
        <link rel="stylesheet" href="css/noscript.css"/>
    </noscript>

    <script src="{$basepath}content/js/jquery.js"></script>
    {if $cms_action eq "EDIT"}
        <script src="{$basepath}extensions/tinymce/tinymce.min.js"></script>
        <script>var tinymce_content_css = '{$basepath}{$tinymce_content_css}'</script>
        <script src="{$basepath}extensions/tinymce/init.js"></script>
    {/if}

    {include file='apps/CookieTasting/tpl/cookieScript.tpl'}
    {include file='apps/Contact/tpl/script.tpl'}
</head>
<body>

{include file='apps/CookieTasting/tpl/cookieMsg.tpl'}

{if $login eq 1 && $cms_msg neq "DM3"}
    <a href="{$basepath}WebAdmin/?performOperation=LOGOUT" style="color: darkred;">Ausloggen</a>
{/if}

<nav id="nav">
    <ul>
        {foreach from=$pageTree item="ti" name="nav"}
            <li {if $smarty.foreach.nav.iteration eq 1}class="break"{/if}>
                {if not is_null($ti.subpages)}<a href="#" class="submenu fa-angle-down">{$ti.DisplayName}</a>{else}<a href="{$basepath}{$ti.rURL}">{$ti.DisplayName}</a>{/if}
                {if not is_null($ti.subpages)}<ul>{/if}
                    {foreach from=$ti.subpages item="tis"}
                        <li><a href="{$basepath}{$tis.rURL}">{$tis.DisplayName}</a></li>
                    {/foreach}
                    {if not is_null($ti.subpages)}</ul>{/if}
            </li>
        {/foreach}
    </ul>
</nav>

{include file='apps/Slides/slides.tpl'}

{include file='apps/News/news.tpl'}

{*404 Workaround*}
{if $responseCode == 404}
    {$render_output}
{else}
    {include file=$template}
{/if}

{include file='apps/Contact/tpl/contact.tpl'}
</body>
</html>