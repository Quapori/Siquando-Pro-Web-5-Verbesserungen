<div class="ngparaflowsliderstage ngparaflowslider{$darkmode}" data-height="{$heightpercent}" data-autoprogress="{$delay}" data-scalemode="{$sizetoscreen}" {if $colorframe!==''}style="border: 1px solid #{$colorframe}"{/if}>
  
{foreach $pictures as $picture}
<div class="ngparaflowslidercontainer">
<img title="{$picture->caption}" alt="{$picture->alt}" src="{$picture->source|escape}" width="{$picture->size->width}" height="{$picture->size->height}">
</div>
{/foreach}

{if $shownav}
<a href="#" class="ngparaflowsliderprev"></a>
<a href="#" class="ngparaflowslidernext"></a>
{/if}

{if $showbullets}
<div class="ngparaflowsliderdirect"></div>
{/if}

</div>