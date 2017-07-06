{if $login eq 1}
    {if $responseCode != 404}
    &nbsp;<span style="font-size: small;">
    <a href="{$basepath}WebAdmin/?performOperation=EDIT_CONTENT&idContent={$cid}">[Bearbeiten]</a>
</span>
    {/if}
{/if}

{$render_output}