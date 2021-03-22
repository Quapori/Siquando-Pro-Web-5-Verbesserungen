<ul id="sqrpluginpictures{$uid}"
    class="sqrpluginpictures sqrpluginpicturesc{$cols}m{$margin} sqrpluginpictures sqrpluginpictures{$ratio}{if $animate} sqrpluginpicturesanimate{/if}">
    {foreach $pictures as $picture}
        <li>
            <div>
                {if ($picture->link!=null)}
                    <a href="{$picture->link->getUrl()|escape}" {if $picture->link->linkType == NGLink::LinkPicture} data-nggroup="{$uid}" class="gallery"{/if}{if ($picture->link->linkType == NGLink::LinkPagePopup || $picture->link->linkType == NGLink::LinkTopicPopup)} class="galleryiframe"{/if}{if $picture->link->linkType == NGLink::LinkWWW} target="_blank"{/if}>
                {/if}
                {if $picture->src!==''}
                    <img alt="{$picture->alt|escape}" src="{$picture->src|escape}" width="{$width}" height="{$height}"/>
                {/if}
                {if $picture->caption!==''}
                    <div style="color:#{$picture->picturecolor}" class="sqrpluginpictures{$picture->pictureposition|lower}">
                        <span>{$picture->caption|escape}</span>
                    </div>
                {/if}
                {if ($picture->link!=null)}
                    </a>
                {/if}
            </div>
        </li>
    {/foreach}
</ul>