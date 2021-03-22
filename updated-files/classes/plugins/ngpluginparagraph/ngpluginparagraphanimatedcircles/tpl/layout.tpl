<ul class="ngparaanimatedcircles ngparaanimatedcirclesc{$columns}" data-animationduration="{$animationduration}" data-animationdelay="{$animationdelay}" data-captionsize="{$captionsize}" data-valuesize="{$valuesize}">
    {foreach $circles as $circle}
        <li>
            <div data-percentage="{$circle->percentage}" data-value="{$circle->value}" data-unit="{$circle->unit|escape}">
                <svg viewBox="0 0 240 240" xmlns="http://www.w3.org/2000/svg"
                     style="position:absolute;top:0;left:0;width:100%;height:100%">

                    <g transform="translate(120,120)">

                        <circle stroke-width="{$ringwidth}" stroke="#{$circle->colortrack}" class="ngparaanimatedcirclestrack" r="100"/>
                        <circle stroke-width="{$ringwidth}" stroke="#{$circle->colorring}" class="ngparaanimatedcirclesring" r="100" transform="rotate(270.1)"/>
                    </g>

                </svg>
                <span style="{if $circle->colorvalue!==''}color:#{$circle->colorvalue};{/if}{if $valuebold}font-weight:bold;{/if}{if $valueitalic}font-style:italic;{/if}" class="ngparaanimatedcirclesvalue">0{$circle->unit|escape}</span>
            </div>
            <span style="{if $circle->colorcaption!==''}color:#{$circle->colorcaption};{/if}{if $captionbold}font-weight:bold;{/if}{if $captionitalic}font-style:italic;{/if}"  class="ngparaanimatedcirclescaption">{$circle->caption|escape}</span>

        </li>
    {/foreach}
</ul>