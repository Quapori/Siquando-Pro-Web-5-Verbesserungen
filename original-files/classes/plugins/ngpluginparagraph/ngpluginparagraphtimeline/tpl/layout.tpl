<ul  class="sqrparatimeline{if $animate} sqrparatimelineanimate{/if} sqrparatimeline{$columns}col" style="background-image: url({$bar|escape})">
{foreach $items as $item}
<li style="background-image: url({$item->bullet|escape})">
<div class="sqrparatimelineitem{$item->position}">
{if isset($item->caption)}<h3>{$item->caption|escape}</h3>{/if}
{if isset($item->summary)}{$item->summary}{/if}
{if isset($item->pictureurl)}
{if isset($item->linkurl)}
<a {if $item->picturetitle!==''}title="{$item->picturetitle}"{/if} href="{$item->linkurl|escape}"{if isset($item->linkclass)} class="{$item->linkclass}" data-nggroup="{$id}"{/if}{if isset($item->linktarget)} target="{$item->linktarget}"{/if}>
{/if}
<img {if isset($lazyload)}class="nglazyload"{/if} {if isset($lazyload)}data-src="{$item->pictureurl|escape}" {if isset($item->pictureurlhd)} data-src-hd="{$item->pictureurlhd|escape}"{/if} src="{$lazyload|escape}" {else}src="{$item->pictureurl|escape}"{/if} alt="{$item->picturealt|escape}" width="{$item->picturesize->width}" height="{$item->picturesize->height}" />
{if isset($item->linkurl)}
</a>
{/if}

{/if}
</div>
</li>
{/foreach}
</ul>