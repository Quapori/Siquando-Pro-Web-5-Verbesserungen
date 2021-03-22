<div class="ngparatwoinonegallery ngparatwoinonegalleryscroll" id="ngparatwoinonegallery{$id}" data-columns="{$columns}" data-columnsmobile="{$columnsmobile}">
<div class="ngparatwoinonegallerycontrols">
<a href="#" class="ngparatwoinonegallerynext"></a>
<a href="#" class="ngparatwoinonegalleryprev"></a>
<a href="#" class="ngparatwoinonegallerymatrix">{$lang['grid']->value|escape}</a>
<a href="#" class="ngparatwoinonegalleryclose"></a>
</div>
<div class="ngparatwoinonegallerycontainer">
<ul>
{foreach $pictures as $picture}
<li>
<a href="{$picture->link->getUrl()|escape}" title="{$picture->caption|escape}"{if $picture->link->linkType == NGLink::LinkPicture} class="gallery" data-nggroup="{$id}"{/if}{if ($picture->link->linkType == NGLink::LinkPagePopup || $picture->link->linkType == NGLink::LinkTopicPopup)} class="galleryiframe"{/if}{if $picture->link->linkType == NGLink::LinkWWW} target="_blank"{/if}>
<img alt="{$picture->caption|escape}" src="{$picture->source|escape}" {if $picture->sourcehd} srcset="{$picture->source|escape} 1x, {$picture->sourcehd|escape} 2x"{/if} width="{$width}" height="{$width}" />
</a>
</li>
{/foreach}
</ul>
</div>
</div>