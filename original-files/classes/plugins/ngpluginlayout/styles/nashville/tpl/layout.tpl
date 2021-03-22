{include file='header.tpl'}

<div id="logo">
{if isset($logosource)}
{if isset($logolink)}
<a style="width:{$logowidth}px;height:{$logoheight}px" href="{$logolink|escape}"{if isset($logolinkclass)} class="{$logolinkclass}"{/if}{if isset($logolinktarget)} target="{$logolinktarget}"{/if}>
{/if}
	<img src="{$logosource|escape}" alt="{$logotitle|escape}" style="width:{$logowidth}px;height:{$logoheight}px" />
{if isset($logolink)}
</a>
{/if}
{/if}
</div>


<div id="navigation">
	<ul>{$nav}</ul>
</div>

<div id="eyecatcher">
	<img src="{$eyecatchersource|escape}" alt="{$eyecatchertitle|escape}" style="width:{$eyecatcherwidth}px;height:{$eyecatcherheight}px" />
{if $page->pagecaption()!==''}
	<div class="shadow"></div>
	<div class="caption">
		<h1>{$page->pagecaption()|escape}</h1>
		<div class="ngrolldown" data-ngtarget="header"></div>
	</div>
{/if}
</div>

{if $streams['header']->isVisible}
<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="header">
	<div>
	{$streams['header']->output}
		
	</div>
</div>		
{/if}

<div id="main">
<div>
{if $streams['sidebarleft']->isVisible}
			<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} style="width: {$width}px" id="sidebarleft">
				{$streams['sidebarleft']->output}
			</div>		
{/if}


{if $streams['content']->isVisible}
			<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} style="width: {$width}px" id="content">
				{$streams['content']->output}
			</div>		
{/if}

{if $streams['sidebarright']->isVisible}
			<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} style="width: {$width}px" id="sidebarright">
				{$streams['sidebarright']->output}
			</div>		
{/if}

<div class="clearfix"></div>

</div>


</div>

{if $streams['footer']->isVisible}
<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="footer">
	<div>
	{$streams['footer']->output}
	</div>
</div>		
{/if}

{include file='footer.tpl'}
