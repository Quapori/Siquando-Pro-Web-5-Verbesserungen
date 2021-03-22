<p style="text-align:{$align}">
{if $link!=''}
<a {if $linktitle!=''}title="{$linktitle|escape}"{/if} {if isset($linktarget)}target="{$linktarget}"{/if} href="{$link|escape}"{if isset($linkclass)} class="{$linkclass}"{/if}>
{/if}
<img alt="{$alt|escape}" height="{$height}" width="{$width}" style="max-width: 100%; height: auto;border:0;display:inline-block" src="{$source|escape}" />
{if $link!=''}
</a>
{/if}
</p>