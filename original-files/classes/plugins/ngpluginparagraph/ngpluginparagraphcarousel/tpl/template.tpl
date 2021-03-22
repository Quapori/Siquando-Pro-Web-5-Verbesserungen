<div class="ngcarouselwrapper">
<div class="ngcarousel" data-delay="{$delay}" {if $reflection}data-reflection="on"{/if}>
{foreach $pictures as $picture}
<a href="{$picture->link->getUrl()|escape}" title="{$picture->caption|escape}"{if $picture->link->linkType == NGLink::LinkPicture} class="gallery" data-nggroup="{$id}"{/if}{if ($picture->link->linkType == NGLink::LinkPagePopup || $picture->link->linkType == NGLink::LinkTopicPopup)} class="galleryiframe"{/if}{if $picture->link->linkType == NGLink::LinkWWW} target="_blank"{/if}>
<img alt="{$picture->alt|escape}" src="{$picture->source|escape}" style="width:{$picture->size->width}px;height:{$picture->size->height}px" />
</a>
{/foreach}
</div>
</div>