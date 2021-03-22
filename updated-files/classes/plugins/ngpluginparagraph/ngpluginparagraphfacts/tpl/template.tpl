<ul id="sqwpluginfacts{$uid}" class="sqwpluginfacts sqwpluginfacts{$cols}cols{if $animate} sqwpluginfactsanim{/if}">
    {foreach $facts as $fact}
        <li>
            <div>
                <div>
                    {if $fact->src!==''}
                        {if $fact->link!=null}<a href="{$fact->link->getUrl()|escape}" {if $fact->link->linkType == NGLink::LinkPicture} data-nggroup="{$uid}" class="gallery"{/if}{if ($fact->link->linkType == NGLink::LinkPagePopup || $fact->link->linkType == NGLink::LinkTopicPopup)} class="galleryiframe"{/if}{if $fact->link->linkType == NGLink::LinkWWW} target="_blank"{/if}>{/if}
                        <img {if $fact->class!=''}class="{$fact->class}" {/if} alt="{$fact->alt|escape}" src="{$fact->src|escape}" width="80" height="80"/>
                        {if $fact->link!=null}</a>{/if}
                    {/if}
                    <h3>{$fact->caption|escape}</h3>
                    {$fact->summary}
                </div>
            </div>

            {if $fact->link!=null}
                <div class="sqwpluginfactslink">
                    <a href="{$fact->link->getUrl()|escape}" {if $fact->link->linkType == NGLink::LinkPicture} data-nggroup="{$uid}" class="gallery"{/if}{if ($fact->link->linkType == NGLink::LinkPagePopup || $fact->link->linkType == NGLink::LinkTopicPopup)} class="galleryiframe"{/if}{if $fact->link->linkType == NGLink::LinkWWW} target="_blank"{/if}>{$fact->linkcaption|escape}</a>
                </div>
            {/if}
        </li>
    {/foreach}
</ul>