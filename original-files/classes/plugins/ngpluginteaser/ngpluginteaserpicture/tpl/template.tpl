<ul class="teaserpicture" id="ngpara{$uid}">
{foreach $items as $item}
<li>
<a href="{$item->link->getUrl()|escape}" title="{$item->caption|escape}"{if $item->link->linkType == NGLink::LinkPicture} class="gallery"{/if}><img {if isset($lazyload)}data-src="{$item->picturesource|escape}" class="nglazyload" src="{$lazyload|escape}"{else} src="{$item->picturesource|escape}"{/if} width="{$item->picturesize->width}" height="{$item->picturesize->height}" alt="{$item->caption|escape}"/></a>
</li>
{/foreach}
</ul>
<div class="clearfix"></div>