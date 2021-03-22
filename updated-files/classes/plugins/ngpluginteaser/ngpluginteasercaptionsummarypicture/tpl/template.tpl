<div class="teaser" id="ngpara{$uid}">
{foreach $items as $item}
<div class="teaserblock">

{if $item->picturesource!=''}
<a href="{$item->link->getUrl()|escape}" title="{$item->caption|escape}"{if $item->link->linkType == NGLink::LinkPicture} class="gallery"{/if}><img {if isset($lazyload)}data-src="{$item->picturesource|escape}" src="{$lazyload|escape}"{else} src="{$item->picturesource|escape}"{/if} width="{$item->picturesize->width}" height="{$item->picturesize->height}" class="teasersidepicture{if isset($lazyload)} nglazyload{/if}" alt="{$item->caption|escape}"/></a>
<div class="teaserhaspicture">
{else}
<div>
{/if}

<h3><a href="{$item->link->getUrl()|escape}" title="{$item->caption|escape}"{if $item->link->linkType == NGLink::LinkPicture} class="gallery"{/if}>{$item->caption}</a></h3>
{$item->summary}
{if $showmore}<p style="text-align:right"><a href="{$item->link->getUrl()|escape}" title="{$item->caption|escape}"{if $item->link->linkType == NGLink::LinkPicture} class="gallery"{/if}>{$lang['more']->value|escape}</a></p>{/if}
</div>
<div class="clearfix"></div>
</div>
{/foreach}
</div>