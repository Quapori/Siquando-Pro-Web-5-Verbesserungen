<div class="ngparazoom" id="ngparazoom{$uid}">
    <ul>
        {if $zoommode=='TwoPictures'}
            <li{if isset($picture1zoomsource)} class="ngparazoompictureleft ngparazoompicture"{/if}>
                <img src="{$picture1source|escape}" alt="" width="{$picture1size->width}" height="{$picture1size->height}"{if isset($picture1zoomsource)} data-factor="{$picture1zoomfactor}" data-src="{$picture1zoomsource|escape}"{/if} />
            </li>
            <li{if isset($picture2zoomsource)} class="ngparazoompictureright ngparazoompicture"{/if}>
                <img src="{$picture2source|escape}" alt="" width="{$picture2size->width}" height="{$picture2size->height}"{if isset($picture2zoomsource)} data-factor="{$picture2zoomfactor}" data-src="{$picture2zoomsource|escape}"{/if} />
            </li>
        {/if}
        {if $zoommode=='PictureLeft'}
            <li{if isset($picture1zoomsource)} class="ngparazoompictureleft ngparazoompicture"{/if}>
                <img src="{$picture1source|escape}" alt="" width="{$picture1size->width}" height="{$picture1size->height}"{if isset($picture1zoomsource)} data-factor="{$picture1zoomfactor}" data-src="{$picture1zoomsource|escape}"{/if} />
            </li>
            <li class="ngparazoomtext">
                {$text}
            </li>
        {/if}
        {if $zoommode=='PictureRight'}
            <li class="ngparazoomtext">
                {$text}
            </li>
            <li{if isset($picture1zoomsource)} class="ngparazoompictureright ngparazoompicture"{/if}>
                <img src="{$picture1source|escape}" alt="" width="{$picture1size->width}" height="{$picture1size->height}"{if isset($picture1zoomsource)} data-factor="{$picture1zoomfactor}" data-src="{$picture1zoomsource|escape}"{/if}/>
            </li>
        {/if}
    </ul>
</div>