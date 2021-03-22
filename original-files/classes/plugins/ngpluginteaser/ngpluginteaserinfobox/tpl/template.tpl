<div class='nginfobox' id="ngpara{$uid}">
<img src="{$primaryitem->picturesource|escape}" width="{$picturewidth}" height="{$stageheight}" style="left:{$pictureleftpercent}%;width:{$picturewidthpercent}%" alt="{$primaryitem->caption|escape}" />
<div style="left:{$boxleftpercent}%;width:{$boxwidthpercent}%;background-color: {$boxcolor}">
<h3><a href="{$primaryitem->link->getUrl()|escape}">{$primaryitem->caption|escape}</a></h3>
{$primaryitem->summary}
<ul>
{foreach $items as $item}
<li>
<a href="{$item->link->getUrl()|escape}">{$item->caption|escape}</a>
</li>
{/foreach}
</ul>
<a title="{$primaryitem->caption|escape}" href="{$primaryitem->link->getUrl()|escape}"><img src="{$more|escape}" alt="{$primaryitem->caption|escape}" /></a>
</div>
</div>