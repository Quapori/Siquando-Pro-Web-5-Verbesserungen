<div class="ngparafloatingpictures" style="padding-bottom:{$ratio}%" data-depht="{$zoomdepht}" data-delay="{$delay}" data-textsize="{$textsize}">

    {foreach $pictures as $picture}
        <img src="{$picture|escape}" alt="" style="visibility:hidden"/>
    {/foreach}
    {if $textoverlay!==''}
        <span><span style="color:#{$textcolor}{if $textbold};font-weight:bold{/if}{if $textitalic};font-style:italic{/if}">{$textoverlay}</span></span>
    {/if}
</div>