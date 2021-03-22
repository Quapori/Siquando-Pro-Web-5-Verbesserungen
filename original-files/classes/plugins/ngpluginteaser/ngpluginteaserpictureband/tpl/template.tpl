<div class='ngpictureband' id="ngpara{$uid}" data-ratio="{$ratio}" data-columns="{$columns}">
<ul>
{foreach $items as $item}
<li>
<a href="{$item->link->getUrl()|escape}" {if $item->link->linkType == NGLink::LinkPicture} class="gallery"{/if}><img src="{$item->picturesource|escape}" alt="{$item->caption|escape}"/></a>
<span>{$item->caption|escape}</span>
</li>
{/foreach}
</ul>
<a href='#' class='ngpicturebandnext'></a>
<a href='#' class='ngpicturebandprev'></a>
</div>