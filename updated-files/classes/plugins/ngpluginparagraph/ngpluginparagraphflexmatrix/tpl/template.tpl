<ul class="ngflexmatrix{if $responsive} ngflexmatrixresponsive{/if}" style="{if $bordercolor!==''}background-color:#{$bordercolor}{/if}{if !$responsive}height:{$height}px;width:{$width}px;{/if}"{if $responsive} data-height="{$height}" data-width ="{$width}"{/if}>
{foreach $pictures as $picture}
<li style="left:{$picture->left}px;top:{$picture->top}px;width:{$picture->boxWidth}px;height:{$picture->height}px"> 
<a href="{$picture->link->getUrl()|escape}" title="{$picture->caption|escape}"{if $picture->link->linkType == NGLink::LinkPicture} data-nggroup="{$id}" class="gallery"{/if}{if ($picture->link->linkType == NGLink::LinkPagePopup || $picture->link->linkType == NGLink::LinkTopicPopup)} class="galleryiframe"{/if}{if $picture->link->linkType == NGLink::LinkWWW} target="_blank"{/if}>
<img alt="{$picture->alt|escape}" style="left:{$picture->offset()}px;width:{$picture->pictureWidth}px;height:{$picture->height}px" {if isset($lazyload)}data-src="{$picture->source|escape}" src="{$lazyload|escape}" {else}src="{$picture->source|escape}"{/if} {if isset($picture->sourcehd)} data-src-hd="{$picture->sourcehd|escape}"{/if} {if isset($lazyload)} class="nglazyload"{/if}/>
{if $picture->caption!=='' && $showcaptions}
<em>{$picture->caption|escape}</em>
{/if}
</a>
</li>
{/foreach}

</ul>