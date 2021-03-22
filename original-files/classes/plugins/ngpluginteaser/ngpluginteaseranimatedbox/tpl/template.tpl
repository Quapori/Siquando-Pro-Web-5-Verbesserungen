<div class='nganimatedbox' id="ngpara{$uid}" data-nganimatebox-delay="{$delay}"{if $animateslide} data-nganimatebox-slide="true"{/if}>
<ul>
{foreach $items as $item}
<li>
<a href="{$item->link->getUrl()|escape}">
<img src="{$item->picturesource|escape}" width="{$picturewidth}" height="{$stageheight}" style="left:{$pictureleftpercent}%;width:{$picturewidthpercent}%" alt="{$item->caption|escape}" />
<div style="width:{$boxwidthpercent}%;left:{$boxleftpercent}%;background-color: {$boxcolor}">
<div>
<h3>{$item->caption|escape}</h3>
{$item->summary}
</div>
</div>
</a>
</li>
{/foreach}
</ul>
<div class="nganimatedboxtimerout">
<div class="nganimatedboxtimerin"></div>
</div>
</div>
