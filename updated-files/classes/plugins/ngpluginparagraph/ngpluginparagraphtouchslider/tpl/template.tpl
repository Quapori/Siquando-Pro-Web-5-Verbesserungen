<div class="ngparagraphtouchslider" id="ngparatsl{$uid}" data-nav="{$shownav}">
<ul>
{foreach $pictures as $picture}
<li>
<img src="{$picture->source|escape}" alt="{$picture->alt|escape}" width="{$width}" height="{$height}">
</li>
{/foreach}
</ul>
</div>