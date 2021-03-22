{if isset($textpadding)}
    {if isset ($colorbackground)}
        #ngparazoom{$uid} { background-color:#{$colorbackground} }
    {/if}
    #ngparazoom{$uid}>ul>li.ngparazoomtext { vertical-align:{$textalignment|lower};color:#{$colorforeground};padding:{$textpadding}px; }
    #ngparazoom{$uid}>ul>li.ngparazoomtext a, #ngparazoom{$uid}>ul>li.ngparazoomtext a:hover { color:#{$colorforeground}; }
{/if}