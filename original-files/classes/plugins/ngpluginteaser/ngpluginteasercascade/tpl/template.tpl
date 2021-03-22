<div class="ngteasercascade ngteasercascadec{$columncount}" id="ngteasercascade{$uid}">
    <ul class="{if $lazy}ngteasercascadelazy {/if}{if $hover}ngteasercascadehover {/if}">
        {foreach $columns as $column}
            <li>
                <ul>
                    {if $column@iteration is odd}
                    <li>
                        <ul>
                            {/if}
                            {foreach $column as $item}
                                <li{if $item->hidden} class="ngteasercascadehidden"{/if}>
                                    <a href="{$item->link->getUrl()|escape}" {if $item->link->linkType == NGLink::LinkPicture} class="gallery"{/if}>
                                        <figure style="padding-bottom: {number_format($item->picturesize->height * 100 / $item->picturesize->width,3,'.','')}%">
                                            <img {if $lazy}src="{$transgif|escape}" data-src="{$item->picturesource|escape}"{else}src="{$item->picturesource|escape}"{/if} width="{$item->picturesize->width}" height="{$item->picturesize->height}" class="teasersidepicture" alt="{$item->caption|escape}"/>
                                        </figure>
                                        <div>
                                            <h3>{$item->caption|escape}</h3>
                                            {$item->summary}
                                        </div>
                                    </a>
                                </li>
                            {/foreach}
                            {if $column@iteration is even}
                        </ul>
                    </li>
                    {/if}
                </ul>
            </li>
        {/foreach}
    </ul>
    {if $showbutton}
        <div>
            <button>{$textshow|escape}</button>
        </div>
    {/if}
</div>