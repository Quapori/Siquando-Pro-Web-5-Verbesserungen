{foreach $items as $item}
<h3><a href="{$item->link->getUrl()|escape}" title="{$item->caption|escape}"{if $item->link->linkType == NGLink::LinkPicture} class="gallery"{/if}>{$item->caption}</a></h3>
{/foreach}
