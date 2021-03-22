<div id="sqwpluginendless{$uid}" class="sqwpluginendless" data-height="{$sliderheight}" data-autochange="{$autochange}" data-fontsize="{$captionssize}">
    <div class="sqwpluginendlessstage">
        <ul>
            {foreach $pictures as $picture}
                <li>
                    {if $picture->link->linkType !== NGLink::LinkUndefined}
                    <a href="{$picture->link->getUrl()|escape}"{if $picture->link->linkType == NGLink::LinkPicture} class="gallery" data-nggroup="{$uid}"{/if}{if $picture->link->linkType == NGLink::LinkWWW} target="_blank"{/if}>
                        {/if}
                        <img alt="{$picture->caption|escape}" src="{$picture->source|escape}"
                             width="{$picture->size->width}" height="{$picture->size->height}"/>
                        {if $picture->link->linkType !== NGLink::LinkUndefined}
                    </a>
                    {/if}
                </li>
            {/foreach}
        </ul>
    </div>
    <div class="sqwpluginendlessoverlay">
        <a class="sqwpluginendlessnav" href="#"><span></span></a>
        <a class="sqwpluginendlesscurrent"><span></span></a>
        <a class="sqwpluginendlessnav" href="#"><span></span></a>
    </div>
    <div class="sqwpluginendlessbullets"></div>
</div>