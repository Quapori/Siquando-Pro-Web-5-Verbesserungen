<ul id="ngparasfxsplit{$uid}" class="ngparasfxsplit{if $pictureposition==='Left'} ngparasfxsplitleft{/if}" style="background-color: #{$backgroundcolor}; color: #{$foregroundcolor}">
    {foreach $pictures as $picture}
    <li>
        <div>
            <p class="ngparasfxsplitcaption">{$picture->caption|escape}</p>
            {$picture->summary}

            {if $picture->link->linkType !== NGLink::LinkUndefined}
                <div>
                    <a  href="{$picture->link->getUrl()|escape}"{if $picture->link->linkType == NGLink::LinkPicture} class="gallery" data-nggroup="{$uid}"{/if}{if $picture->link->linkType == NGLink::LinkWWW} target="_blank"{/if}>{$more|escape}</a>
                </div>
            {/if}
        </div>
        <img src="{$picture->source|escape}" width="{$picture->size->width}" height="{$picture->size->height}" alt="{$picture->alt}"/>
    </li>
{/foreach}
</ul>