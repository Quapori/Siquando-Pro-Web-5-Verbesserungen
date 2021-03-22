{include file='header.tpl'}

<div id="center">

<div id="top">
{if isset($logosource)}	
{if isset($logolink)}
		<a href="{$logolink|escape}"{if isset($logolinkclass)} class="{$logolinkclass}"{/if}{if isset($logolinktarget)} target="{$logolinktarget}"{/if}>
{/if}
			<img src="{$logosource|escape}" alt="{$logotitle|escape}" style="width:{$logowidth}px;height:{$logoheight}px" />
{if isset($logolink)}
		</a>
{/if}
{/if}

<form action="{$search|escape}"  >
	<input placeholder="{$langsearch['searchfor']->value|escape}" type="text" name="criteria"  />
	<button type="submit"></button>
</form>

</div>

{if isset($nav)}
<div id="nav">
<ul>
{foreach $nav->children as $navitem}
					<li><a href="{$navitem->fullURL($previewmode)}">{$navitem->caption|escape}</a></li>
{/foreach}
</ul>

<div class="clearfix"></div>

</div>
{/if}

<div id="breadcrumbs">{$breadcrumbs}</div>

{if isset($eyecatchersource)}
<div id="eyecatcher">	
{if isset($eyecatcherlink)}
		<a href="{$eyecatcherlink|escape}"{if isset($eyecatcherlinkclass)} class="{$eyecatcherlinkclass}"{/if}{if isset($eyecatcherlinktarget)} target="{$eyecatcherlinktarget}"{/if}>
{/if}
			<img src="{$eyecatchersource|escape}" alt="{$eyecatchertitle|escape}" style="width:{$eyecatcherwidth}px;height:{$eyecatcherheight}px" />
{if isset($eyecatcherlink)}
		</a>
{/if}
</div>
{/if}

{if $page->pagecaption()!==''}
	<div id="caption">
		<h1>{$page->pagecaption()|escape}</h1>
	</div>
{/if}


{if $streams['header']->isVisible}
	<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="header">
		{$streams['header']->output}
	</div>		
{/if}

<div id="main">

{if $streams['sidebarleft']->isVisible}
	<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="sidebarleft">
		{$streams['sidebarleft']->output}
	</div>		
{/if}


{if $streams['content']->isVisible}
	<div style="width:{$width}px" {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="content">
		{$streams['content']->output}
	</div>		
{/if}

{if $streams['sidebarright']->isVisible}
	<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="sidebarright">
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

{if (isset($commonnav) && count($commonnav)>0)}
<div id="common">
{foreach $commonnav as $item}
{if !$item@first} &nbsp;&nbsp;&middot;&nbsp;&nbsp; {/if}<a href="{$item->link|escape}">{$item->caption|escape}</a>
{/foreach}
</div>
{/if}


</div>
		
{include file='footer.tpl'}