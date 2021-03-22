<div class="ngparaliquidgallery" id="ngparaliquidgallery{$uid}" data-sqrgutter="{$gutter}" data-sqrsize="{$size}" data-sqrcaptions="{NGUtil::boolToStringXML($captions)}">
<ul>
{foreach $pictures as $picture}
<li style="top:9999px">
<a href="{$picture->link->getUrl()|escape}" title="{$picture->caption|escape}"{if $picture->link->linkType == NGLink::LinkPicture} class="gallery" data-nggroup="{$id}"{/if}{if ($picture->link->linkType == NGLink::LinkPagePopup || $picture->link->linkType == NGLink::LinkTopicPopup)} class="galleryiframe"{/if}{if $picture->link->linkType == NGLink::LinkWWW} target="_blank"{/if}>
<img alt="{$picture->caption|escape}" {if isset($lazyload)}class="nglazyload" data-src="{$picture->source|escape}" src="{$lazyload|escape}" {else}src="{$picture->source|escape}"{/if} width="{$picture->size->width}" height="{$picture->size->height}" />
</a>
</li>
{/foreach}
</ul>
</div>