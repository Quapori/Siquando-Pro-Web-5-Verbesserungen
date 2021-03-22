{include file='header.tpl'}

<div id="center">

	<ul id="nav" style="width: {$navwidth}px">
		{$nav}
	</ul>

{if $page->pagecaption()!==''}
	<div id="caption">
		<h1>{$page->pagecaption()|escape}</h1>
	</div>
{/if}


{if isset($eyecatchersource)}
<div id="eyecatcher">
	<img src="{$eyecatchersource|escape}" alt="{$eyecatchertitle|escape}" style="width:{$eyecatcherwidth}px;height:{$eyecatcherheight}px" />
	<div id="mask"></div>
</div>
{/if}

{if (isset($breadcrumbs))}
<div id="breadcrumbs">
	{$breadcrumbs}
</div>
{/if}

<div id="search">
<form action="{$search|escape}"  >
	<input type="text" name="criteria"  />
	<button type="submit"></button>
</form>
</div>



{if $streams['header']->isVisible}
	<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="header">
		{$streams['header']->output}
	</div>		
{/if}

<div id="main">

{if $streams['sidebarleft']->isVisible}
	<div style="width:{$width}px" {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="sidebarleft">
		{$streams['sidebarleft']->output}
	</div>		
{/if}


{if $streams['content']->isVisible}
	<div style="width:{$width}px" {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="content">
		{$streams['content']->output}
	</div>		
{/if}

{if $streams['sidebarright']->isVisible}
	<div style="width:{$width}px" {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="sidebarright">
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

<div id="bottom"></div>

{if (isset($commonnav) && count($commonnav)>0)}
<div id="common">
{foreach $commonnav as $item}
{if !$item@first} &nbsp;&nbsp;&middot;&nbsp;&nbsp; {/if}<a href="{$item->link|escape}">{$item->caption|escape}</a>
{/foreach}
</div>
{/if}


</div>
		
{include file='footer.tpl'}