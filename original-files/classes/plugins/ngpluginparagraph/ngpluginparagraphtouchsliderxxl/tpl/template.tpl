<div class="ngparagraphtouchsliderxxl ngparagraphtouchsliderxxl{count($pictures)} ngparagraphtouchsliderxxl{if $blacknav}black{else}white{/if}" data-stageheight="{$stageheight}" data-fadeeffect="{$fadeeffect}" {if $colorframe!==''}style="border: 1px solid #{$colorframe}"{/if}>
<ul>
{foreach $pictures as $picture}
<li><a href="{$picture->source|escape}" title="{$picture->caption|escape}"><span>{$picture@iteration}</span><span>{$picture->caption|escape}</span></a></li>
{/foreach}
</ul>
<img src="{$pictures[0]->source|escape}" alt="{$pictures[0]->alt|escape}" width="{$pictures[0]->width}" height="{$pictures[0]->height}" />
</div>