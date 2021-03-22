<div class="teaserpictureintro teaserpictureintro{$position}{if $hover} teaserpictureintrohover{/if}{if $panorama} teaserpictureintropanorama{/if}">
    <div>
        {if $caption!==''}
        <h3>{$caption|escape}</h3>
        {/if}
        {$summary}
        {if isset($link)}
            <a href="{$link->getUrl()|escape}"
               class="teaserpictureintromore{if $link->linkType == NGLink::LinkPicture} gallery{/if}">{$linkcaption|escape}</a>
        {/if}
    </div>
    <ul class="teaserpictureintroc{$cols}">
        {foreach $items as $item}
            <li class="teaserpictureintrom{$picturemargin}">
                <a href="{$item->link->getUrl()|escape}"
                   title="{$item->caption|escape}"{if $item->link->linkType == NGLink::LinkPicture} class="gallery"{/if}>
                    <img {if isset($lazyload)}data-src="{$item->picturesource|escape}" class="nglazyload" src="{$lazyload|escape}"{else} src="{$item->picturesource|escape}"{/if} width="{$item->picturesize->width}"
                         height="{$item->picturesize->height}" alt="{$item->caption|escape}"{if $roundedcorners>0} style="border-radius:{$roundedcorners}px"{/if}/>
                    {if $showcaptions}
                        <span>{$item->caption|escape}</span>
                    {/if}
                </a>
            </li>
        {/foreach}
    </ul>
</div>
