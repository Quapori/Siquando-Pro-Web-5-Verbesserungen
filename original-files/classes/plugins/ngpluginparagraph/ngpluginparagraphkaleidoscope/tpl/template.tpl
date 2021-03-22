<div id="para{$id}" class="ngparakaleidoscope{if $show3d} ngparakaleidoscope3d{/if}" data-delay="{$delay}" {if $showcaptions}data-captions="on"{/if} {if $reflection}data-reflection="on"{/if} {if $nav}data-nav="on"{/if}>
{if $showcaptions}<h3></h3>{/if} 
<ul>
{foreach $pictures as $picture}
<li>
<a href="{$picture->link->getUrl()|escape}" title="{$picture->caption|escape}"{if $picture->link->linkType == NGLink::LinkPicture} class="gallery" data-nggroup="{$id}"{/if}{if ($picture->link->linkType == NGLink::LinkPagePopup || $picture->link->linkType == NGLink::LinkTopicPopup)} class="galleryiframe"{/if}{if $picture->link->linkType == NGLink::LinkWWW} target="_blank"{/if}>
<img alt="{$picture->alt|escape}" src="{$picture->source|escape}" {if isset($picture->sourcehd)} srcset="{$picture->source|escape} 1x, {$picture->sourcehd|escape} 2x"{/if} width="{$picture->size->width}" height="{$picture->size->height}" />
</a>
</li>
{/foreach}
</ul>
</div>