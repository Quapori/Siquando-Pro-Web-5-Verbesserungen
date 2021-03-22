<div class="ngparatextsliderframe" style="{if $colorbackground!==''}background-color: #{$colorbackground};{/if}{if $colorframe!==''}border:1px solid #{$colorframe};{/if}">
<div class="sqrdesktopboxed">
<div class="ngparatextslider" id="ngparatxtsl{$uid}" data-dynamicheight="{$dynamicheight}">
<ul>
{foreach $items as $item}
<li><div>{$item}</div></li>
{/foreach}
</ul>
</div>
</div>
</div>