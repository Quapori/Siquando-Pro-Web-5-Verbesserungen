{if isset($link)}
<a {if isset($linktarget)}target="{$linktarget}"{/if} href="{$link|escape}"{if isset($linkclass)} class="{$linkclass}"{/if}>
{/if}
<div class="ngparastickybutton{if $delay>0} ngparastickybuttonhidden{/if}" id="ngparastickybutton{$uid}"{if $delay>0} data-ngstickybuttondelay="{$delay}"{/if} data-ngstickybuttonposition="{$position}">{if isset($icon)}<img src="{$icon|escape}" alt="" />{/if}{$text|escape}</div>
{if isset($link)}
</a>
{/if}
