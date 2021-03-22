<div class="ngpluginslider" id="{$id}" data-delay="{$delay}">
<div class="ngpluginsliderstage" data-ratio="{$width / $height}">
<ul>
{foreach $slides as $slide} 
<li>
{if $slide->link!=null}<a href="{$slide->link->getUrl()|escape}" {if $slide->link->linkType == NGLink::LinkPicture} data-nggroup="{$id}" class="gallery"{/if}{if ($slide->link->linkType == NGLink::LinkPagePopup || $slide->link->linkType == NGLink::LinkTopicPopup)} class="galleryiframe"{/if}{if $slide->link->linkType == NGLink::LinkWWW} target="_blank"{/if}>{/if}
{if $slide->audiomp3 || $slide->audioogg}
<audio>
{if $slide->audiomp3}
	<source src="{$slide->audiomp3|escape}" type="audio/mpeg" />
{/if}
{if $slide->audioogg}
	<source src="{$slide->audioogg|escape}" type="audio/ogg" />
{/if}
</audio>
{/if}
{if $slide->videomp4 || $slide->videoogg || $slide->videowebm}
<video style="{if $letterbox!==''} background-color: #{$letterbox}{/if}" poster="{$slide->source|escape}" {if $controls}controls="controls"{/if}>
{if $slide->videomp4}
	<source src="{$slide->videomp4|escape}" type="video/mp4" />
{/if}
{if $slide->videowebm}
	<source src="{$slide->videowebm|escape}" type="video/webm" />
{/if}
{if $slide->videoogg}
	<source src="{$slide->videoogg|escape}" type="video/ogg" />
{/if}
</video>
{/if}
<img alt="{$slide->alt|escape}" {if ($slide->title!=='')}title="{$slide->title|escape}"{/if} {if $slide->sourcehd} src="{$trans|escape}" data-src="{$slide->source|escape}" data-src-hd="{$slide->sourcehd|escape}" {else} src="{$slide->source|escape}" {/if} width="{$width}" height="{$height}"/>
<div class="ngpluginslidercaptions ngpluginsilder{$slide->cappos}">
{if $slide->caption}<div class="ngpluginsliderh1"><span>{$slide->caption|escape}</span></div>{/if}
{if $slide->subcaption}<div class="ngpluginsliderh2"><span>{$slide->subcaption|escape}</span></div>{/if}
</div>
{if $slide->link!=null}</a>{/if}
</li>
{/foreach}
</ul>
{if $prevnext}
<a href="#" class="ngpluginslidernext"></a>
<a href="#" class="ngpluginsliderprev"></a>
{/if}
</div>
{if $bullet}
<div class="ngpluginslidercontrols" style="width: {count($slides)*20}px">
{foreach $slides as $slide}
<a href="#"></a>
{/foreach}
<div class="clearfix"></div>
</div>
{/if}
</div>