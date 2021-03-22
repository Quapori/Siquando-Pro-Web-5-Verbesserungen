<ul class="ngbanner" style="width:100%;height:0;padding-bottom:{$heightall/$widthall*100}%" data-delay="{$delay}" data-fade="{$fade}">
{foreach $pictures as $picture}
<li style="width:{$widthone/$widthall*100}%;height:{$heightone/$heightall*100}%;left:{$picture->left/$widthall*100}%;top:{$picture->top/$heightall*100}%;{if !$picture->visible}display:none;{/if}"{if $picture->visible} data-visible="true"{/if} data-left="{$picture->left/$widthall*100}%" data-top="{$picture->top/$heightall*100}%">
<a href="{$picture->link->getUrl()|escape}" title="{$picture->caption|escape}"{if $picture->link->linkType == NGLink::LinkPicture} class="gallery"{/if}{if ($picture->link->linkType == NGLink::LinkPagePopup || $picture->link->linkType == NGLink::LinkTopicPopup)} class="galleryiframe"{/if}{if $picture->link->linkType == NGLink::LinkWWW} target="_blank"{/if}>
<img alt="{$picture->alt|escape}" src="{$picture->source|escape}" />
</a>
</li>
{/foreach}
</ul>