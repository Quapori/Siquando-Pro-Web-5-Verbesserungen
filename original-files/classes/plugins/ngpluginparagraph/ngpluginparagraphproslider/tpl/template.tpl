<div class="ngparaproslider" id="ngparaproslider{$uid}" data-ratio="{$ratio}" data-touch="{$touch}">
    <div class="ngparaprosliderprev">
        <img alt="" src="{$prev|escape}"/>
    </div>
    <div class="ngparaproslidernext">
        <img alt="" src="{$next|escape}"/>
    </div>

    <ul>
        {foreach $pictures as $picture}
            <li>
                <img alt="{$picture->caption|escape}" src="{$picture->source|escape}" width="{$picture->size->width}"
                     height="{$picture->size->height}"/>

                <div>
                    {if $picture->caption!==''}<h3>{$picture->caption|escape}</h3>{/if}
                    {$picture->summary}

                    {if $picture->link->linkType !== NGLink::LinkUndefined}
                        <div class="ngparaproslidermore">
                            <a href="{$picture->link->getUrl()|escape}"{if $picture->link->linkType == NGLink::LinkPicture} class="gallery" data-nggroup="{$uid}"{/if}{if $picture->link->linkType == NGLink::LinkWWW} target="_blank"{/if}>{$more|escape}</a>
                        </div>
                    {/if}

                </div>
            </li>
        {/foreach}
    </ul>

    {if isset($bullets)}
        <div class="ngparaprosliderbullets"></div>
    {/if}

</div>