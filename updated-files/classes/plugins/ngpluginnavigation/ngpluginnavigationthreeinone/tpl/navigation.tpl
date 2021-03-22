<div class="pluginnavigationthreeinonecontainer">
{if isset($nav)}
<ul style="left: {$navleft}px" class="pluginnavigationthreeinonedropdown" {if $sound!=''} data-sound="{$sound}"{/if}{if $animate} data-animate="animate"{/if}>
	{$nav}
</ul>
{/if}
{if isset($logosource)}
	<a href="{$logolink|escape}"><img src="{$logosource|escape}" alt="" /></a>
{/if}
{if isset($search)}
<form action="{$search|escape}"  >
	<input placeholder="{$langsearch['searchfor']->value|escape}" type="text" name="criteria"  />
	<button type="submit"></button>
</form>
{/if}
{if isset($common)}

<ul class="pluginnavigationthreeinonecommon">
{foreach $common as $item}
<li>
	<a {if $commonlightbox}class="galleryiframe"{/if} href="{$item->link|escape}">{$item->caption}</a>
</li>
{/foreach}
</ul>

{/if}

</div>