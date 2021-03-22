{include file='header.tpl'}

<div id="eyecatcher">
	<img src="{$eyecatchersource|escape}" alt="{$eyecatchertitle|escape}" style="width:{$eyecatcherwidth}px;height:{$eyecatcherheight}px" />
	<h1>{$page->caption|escape}</h1>
	<div class="down"></div>	
</div>

<div id="nav">
	<div>
		<ul>{$nav}</ul>
		<div class="clearfix"></div>
{if isset($logosource)}	
		<div class="logo">
{if isset($logolink)}
			<a style="width:{$logowidth}px;height:{$logoheight}px" href="{$logolink|escape}"{if isset($logolinkclass)} class="{$logolinkclass}"{/if}{if isset($logolinktarget)} target="{$logolinktarget}"{/if}>
{/if}
				<img src="{$logosource|escape}" alt="{$logotitle|escape}" style="width:{$logowidth}px;height:{$logoheight}px" />
{if isset($logolink)}
			</a>
{/if}
		</div>
{/if}
	</div>

	
</div>

<div id="navfixed">
	<div>
		<ul>{$nav}</ul>
		<div class="clearfix"></div>
{if isset($logosource)}	
		<div class="logo">
{if isset($logolink)}
			<a style="width:{$logowidth}px;height:{$logoheight}px" href="{$logolink|escape}"{if isset($logolinkclass)} class="{$logolinkclass}"{/if}{if isset($logolinktarget)} target="{$logolinktarget}"{/if}>
{/if}
				<img src="{$logosource|escape}" alt="{$logotitle|escape}" style="width:{$logowidth}px;height:{$logoheight}px" />
{if isset($logolink)}
			</a>
{/if}
		</div>
{/if}
	</div>
</div>

<div id="center">

{if $streams['header']->isVisible}
	<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="header">
		{$streams['header']->output}		
	</div>		
{/if}

<div id="main">
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

{if $streams['footer']->isVisible}
<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="footer">
	{$streams['footer']->output}
</div>		
{/if}


</div>
		
{include file='footer.tpl'}