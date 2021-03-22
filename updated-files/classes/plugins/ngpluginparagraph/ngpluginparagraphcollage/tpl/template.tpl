<div class="ngparacollagewrapper">
<div class="ngparacollage ngparacollage{$transeffect} ngparacollageresponsive" style="{if $bordercolor!==''}border:1px solid #{$bordercolor};{/if}{if !$responsive}height:{$height}px;width:{$width}px;{/if}"{if $responsive} data-width="{$width}" data-height="{$height}"{/if}>
{foreach $tiles as $tile}
<div class="ngparacollagetile" style="left:{$tile->left}px;top:{$tile->top}px;width:{$tile->width}px;height:{$tile->height}px">
{foreach $tile->items as $item}
<div class="ngparacollageitemouter" style="left:{$item->left}px;top:{$item->top}px;width:{$item->width}px;height:{$item->height}px{if $item->borderRight>0};border-right:1px solid #{$bordercolor}{/if}{if $item->borderBottom>0};border-bottom:1px solid #{$bordercolor}{/if}">
<div class="ngparacollageiteminner{if $item->text!=='' && $item->pictureSource!==''} ngparacollageshifter{/if}" style="width:{$item->width*2}px;height:{$item->height*2}px">
{if $item->pictureSource!==''}
<div class="ngparacollageimg" style="width:{$item->width}px;height:{$item->height}px">
{if isset($item->link)}
<a href="{$item->link->getUrl()|escape}" {if $item->link->linkType == NGLink::LinkPicture} class="gallery" data-nggroup="{$id}"{/if}{if ($item->link->linkType == NGLink::LinkPagePopup || $item->link->linkType == NGLink::LinkTopicPopup)} class="galleryiframe"{/if}{if $item->link->linkType == NGLink::LinkWWW} target="_blank"{/if}>
{/if}
<img alt="" {if isset($lazyload)}data-src="{$item->pictureSource|escape}" class="nglazyload" src="{$lazyload|escape}" {else}src="{$item->pictureSource|escape}"{/if} {if isset($item->pictureSourceHD)} data-src-hd="{$item->pictureSourceHD|escape}"{/if} style="left:{$item->pictureLeft}px;top:{$item->pictureTop}px;width:{$item->pictureWidth}px;height:{$item->pictureHeight}px">
{if isset($item->link)}
</a>
{/if}
</div>
{/if}
<div class="ngparacollagetext" style="width:{$item->width}px;height:{$item->height}px;">
{$item->text}
{if isset($item->link)}
<p>
<a href="{$item->link->getUrl()|escape}" {if $item->link->linkType == NGLink::LinkPicture} class="gallery" data-nggroup="l{$id}"{/if}{if ($item->link->linkType == NGLink::LinkPagePopup || $item->link->linkType == NGLink::LinkTopicPopup)} class="galleryiframe"{/if}{if $item->link->linkType == NGLink::LinkWWW} target="_blank"{/if}>{$lang->languageResources['more']->value|escape}</a>
</p>
{/if}
</div>
</div>
</div>
{/foreach}
</div>
{/foreach}
</div>
</div>