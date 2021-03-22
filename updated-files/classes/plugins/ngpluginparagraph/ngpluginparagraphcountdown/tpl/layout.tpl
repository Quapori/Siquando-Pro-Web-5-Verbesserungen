<div id="ngparacountdown{$uid}" class="ngparacountdown ngparacountdown{$animationspeed} ngparacountdown{if $fontclassical}classical{else}modern{/if}" data-date="{$targettime}" data-reload="{$reload}">

    <ul>
        {if $daydigits>0}
        <li><ul>{for $i=0;$i<$daydigits;$i++}<li class="ngparacountdowndigit"></li>{/for}</ul><span>{$lang['days']->value|escape}</span></li>
        {/if}

        <li><ul><li class="ngparacountdowndigit"></li><li class="ngparacountdowndigit"></li></ul><span>{$lang['hours']->value|escape}</span></li><li><ul><li class="ngparacountdowndigit"></li><li class="ngparacountdowndigit"></li></ul><span>{$lang['minutes']->value|escape}</span></li><li><ul><li class="ngparacountdowndigit"></li><li class="ngparacountdowndigit"></li></ul><span>{$lang['seconds']->value|escape}</span></li>
    </ul>

</div>