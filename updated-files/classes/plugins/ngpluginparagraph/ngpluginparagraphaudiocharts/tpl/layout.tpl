<div class="ngpluginaudiocharts" id="{$id}">
<audio></audio>
<ul>
{foreach $tracks as $track} 
<li>
<a href="{$track->url|escape}" {if isset($track->ogg)} data-ogg="{$track->ogg|escape}"{/if}><span>{$track->caption|escape}</span></a>
</li>
{/foreach}
</ul>
</div>