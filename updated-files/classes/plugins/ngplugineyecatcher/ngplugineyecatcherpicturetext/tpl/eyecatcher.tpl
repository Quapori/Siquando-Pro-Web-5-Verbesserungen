<div class="stage" style="width:{$width}px;height:{$height}px;background-image:url({$source|escape})">

{foreach $items as $item}
{if $item->type==='search'}
<form class="eycatcheritem{$item->id}" action="{$search|escape}"  >
	<input placeholder="{$langsearch['searchfor']->value|escape}" type="text" name="criteria"  />
	<button type="submit"></button>
</form>
{else if $item->type==='picture'}
{if isset($item->link)}<a href="{$item->link}" {if isset($item->linktitle)}title="{$item->linktitle|escape}"{/if} {if isset($item->linkstyle)}class="{$item->linkstyle}"{/if} {if isset($item->linktarget)}target="{$item->linktarget}"{/if}>{/if}
<img class="eycatcheritem{$item->id}" src="{$item->picture|escape}" alt="" />
{if isset($item->link)}</a>{/if}
{else}
<div class="eycatcheritem{$item->id}">
{if isset($item->link)}<a href="{$item->link}" {if isset($item->linktitle)}title="{$item->linktitle|escape}"{/if} {if isset($item->linkstyle)}class="{$item->linkstyle}"{/if} {if isset($item->linktarget)}target="{$item->linktarget}"{/if}>{/if}
{$item->text}
{if isset($item->link)}</a>{/if}</div>
{/if}
{/foreach}

</div>