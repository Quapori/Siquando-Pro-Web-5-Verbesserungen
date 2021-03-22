<div class="sqwpluginbuttons sqwpluginbuttons{$justifyitems}">
    {foreach $items as $item}
        <a href="{$item->link->getUrl()|escape}"{if $item->linktitle!==''} title="{$item->linktitle|escape}"{/if} {if $item->link->linkType == NGLink::LinkPicture} data-nggroup="{$uid}" class="gallery"{/if}{if ($item->link->linkType == NGLink::LinkPagePopup || $item->link->linkType == NGLink::LinkTopicPopup)} class="galleryiframe"{/if}{if $item->link->linkType == NGLink::LinkWWW} target="_blank"{/if}>{$item->svg}{$item->linkcaption|escape}</a>
    {/foreach}
</div>