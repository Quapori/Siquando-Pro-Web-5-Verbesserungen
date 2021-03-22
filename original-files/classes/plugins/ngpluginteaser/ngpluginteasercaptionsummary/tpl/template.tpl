{foreach $items as $item}
<h3><a href="{$item->link->getUrl()|escape}" title="{$item->caption|escape}"{if $item->link->linkType == NGLink::LinkPicture} class="gallery"{/if}>{$item->caption}</a></h3>
<div class="teaserblock">
{$item->summary}
{if $showmore}<p style="text-align:right"><a href="{$item->link->getUrl()|escape}" title="{$item->caption|escape}"{if $item->link->linkType == NGLink::LinkPicture} class="gallery"{/if}>{$lang['more']->value|escape}</a></p>{/if}
</div>
{/foreach}
