<div id="sqwpluginsplitslider{$uid}"
     class="sqwpluginsplitslider sqwpluginsplitslider{$pictureposition} sqwpluginsplitslider{$picturewidth}"
     data-autochange="{$autochange}">

    <div class="sqwpluginsplitsliderslider">
        <ul>
            {foreach $pictures as $picture}
                <li>
                    <img src="{$picture->source|escape}" alt="" width="{$picture->size->width}"
                         height="{$picture->size->height}"/>

                    <div>
                        {if $picture->caption!==''}
                            <h3>
                                {$picture->caption|escape}
                            </h3>
                        {/if}
                        {if $picture->summary!==''}
                            {$picture->summary}
                        {/if}

                        {if $picture->link->linkType !== NGLink::LinkUndefined}
                            <p class="sqwpluginsplitslidermore" ><a href="{$picture->link->getUrl()|escape}"{if $picture->link->linkType == NGLink::LinkWWW} target="_blank"{/if}></a></p>
                        {/if}

                    </div>
                </li>
            {/foreach}
        </ul>
    </div>
    <div class="sqwpluginsplitsliderinfo">
        <div class="sqwpluginsplitslidertext"></div>
        <div class="sqwpluginsplitsliderbullets"></div>
    </div>
</div>