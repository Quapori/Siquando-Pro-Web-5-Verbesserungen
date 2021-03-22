<div class="teaserwow teaserwow{$cols}col{$crop} {if $circle}teaserwowcircle{/if}">
{foreach $items as $item}
<a href="{$item->link->getUrl()|escape}" title="{$item->caption|escape}"{if $item->link->linkType == NGLink::LinkPicture} class="gallery"{/if}>

<div class="{if isset($item->picturesource)}teaserwowzoom{else}teaserwowfade{/if}" style="background-color: #{$fade}; color: #{$foreground}">

{if isset($item->picturesource)}
<img src="{$item->picturesource|escape}" width="{$item->picturesize->width}" height="{$item->picturesize->height}" alt="{$item->caption|escape}"/>
{/if}

<div{if !isset($item->picturesource)} style="background-color: #{$background}"{/if}>
<div>
<div>{$item->caption|escape}</div>
</div>
</div>
</div>

</a>
{/foreach}
</div>
