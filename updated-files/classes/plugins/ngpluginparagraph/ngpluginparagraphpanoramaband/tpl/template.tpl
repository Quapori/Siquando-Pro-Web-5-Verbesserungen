<ul class="ngparapanoramaband">
{foreach $pictures as $picture}
<li style="width: {$picture->size->width / $totalwidth * 100}%">
{if $showlinks}<a href="{$picture->link->getUrl()|escape}" title="{$picture->caption|escape}"{if $picture->link->linkType == NGLink::LinkPicture} data-nggroup="{$id}" class="gallery"{/if}{if ($picture->link->linkType == NGLink::LinkPagePopup || $picture->link->linkType == NGLink::LinkTopicPopup)} class="galleryiframe"{/if}{if $picture->link->linkType == NGLink::LinkWWW} target="_blank"{/if}>{/if}<img {if isset($lazyload)}data-src="{$picture->source|escape}" class="nglazyload" src="{$lazyload|escape}" {else}src="{$picture->source|escape}"{/if} width="{$picture->size->width}" height="{$picture->size->height}" alt="{$picture->alt|escape}" />{if $showlinks}</a>{/if}
{if $showcaptions}<span>&nbsp;{$picture->caption|escape}&nbsp;</span>{/if}
</li>
{/foreach}
</ul>