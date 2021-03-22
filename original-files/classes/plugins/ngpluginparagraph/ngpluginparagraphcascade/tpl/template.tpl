<ul id="{$id}" class="ngcascade">

{foreach $cascades as $cascade}

<li style="width:{$cascade->width/$width*100}%;{if $cascade@index>0}margin-left:{$gutter/$width*100}%{/if}">

<ul>

{foreach $cascade->pictures as $picture}

<li>
<a href="{$picture->link->getUrl()|escape}" title="{$picture->caption|escape}"{if $picture->link->linkType == NGLink::LinkPicture} data-nggroup="{$id}" class="gallery"{/if}{if ($picture->link->linkType == NGLink::LinkPagePopup || $picture->link->linkType == NGLink::LinkTopicPopup)} class="galleryiframe"{/if}{if $picture->link->linkType == NGLink::LinkWWW} target="_blank"{/if}><img alt="{$picture->alt|escape}" {if $picture->title!==''} title="{$picture->title|escape}" {/if}{if isset($lazyload)}data-src="{$picture->source|escape}" src="{$lazyload|escape}" {else}src="{$picture->source|escape}"{/if} {if isset($picture->sourcehd)} data-src-hd="{$picture->sourcehd|escape}"{/if} width="{$picture->width}" height="{$picture->height}" {if isset($lazyload)} class="nglazyload"{/if}/></a>
{if $picture->caption!=""}<h3>{$picture->caption|escape}</h3>{/if}
{if $picture->summary!=""}{$picture->summary}{/if}
</li>
{/foreach}

</ul>

</li>

{/foreach}

</ul>

<div class="clearfix"></div>