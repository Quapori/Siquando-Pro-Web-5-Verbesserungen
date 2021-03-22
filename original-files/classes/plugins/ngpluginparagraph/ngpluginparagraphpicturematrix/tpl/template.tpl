<ul data-maxitems="{$maxitems}" class="ngpicturematrix ngpicturematrix{$cols}cols">
{foreach $pictures as $picture}
<li {if !$picture->visible} class="nghide"{/if}><a href="{$picture->link->getUrl()|escape}" title="{$picture->caption|escape}"{if $picture->link->linkType == NGLink::LinkPicture} data-nggroup="{$id}" class="gallery"{/if}{if ($picture->link->linkType == NGLink::LinkPagePopup || $picture->link->linkType == NGLink::LinkTopicPopup)} class="galleryiframe"{/if}{if $picture->link->linkType == NGLink::LinkWWW} target="_blank"{/if}><img alt="{$picture->alt|escape}" {if isset($lazyload)}data-src="{$picture->source|escape}" src="{$lazyload|escape}" {else}src="{$picture->source|escape}"{/if} {if isset($picture->sourcehd)} data-src-hd="{$picture->sourcehd|escape}"{/if} width="{$width}" height="{$width}" style="{if $borderwidth>0}border:{$borderwidth}px solid #{$bordercolor};{/if}" {if isset($lazyload)} class="nglazyload"{/if}/></a></li>
{/foreach}

</ul>

{if $pagecount>1}
<ul class="ngpicturematrixnav">
{for $page=1 to $pagecount}
<li><a href="#" {if $page==1}class="ngcurrent"{/if}>{$page}</a></li>
{/for}
</ul>
{/if}

<div class="clearfix"></div>