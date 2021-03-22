{include file='header.tpl'}

<div id="center">

<div id="nav">

{if isset($logosource)}
	<div id="logo">	
{if isset($logolink)}
		<a href="{$logolink|escape}"{if isset($logolinkclass)} class="{$logolinkclass}"{/if}{if isset($logolinktarget)} target="{$logolinktarget}"{/if}>
{/if}
			<img src="{$logosource|escape}" alt="{$logotitle|escape}" style="width:{$logowidth}px;height:{$logoheight}px" />
{if isset($logolink)}
		</a>
{/if}
	</div>
{/if}

<ul>{$nav}</ul>
</div>

<div id="maincolumn">

<div id="breadcrumbs">
{$lang['youarehere']->value} {$breadcrumbs}

	<form action="{$search|escape}"  >
	<input placeholder="{$langsearch['searchfor']->value|escape}" type="text" name="criteria"  />
	<button type="submit"></button>
	</form>


</div>

{if isset($eyecatchersource)}
	<div id="eyecatchercontainer">
		<div id="eyecatcher">	
{if isset($eyecatcherlink)}
			<a href="{$eyecatcherlink|escape}"{if isset($eyecatcherlinkclass)} class="{$eyecatcherlinkclass}"{/if}{if isset($eyecatcherlinktarget)} target="{$eyecatcherlinktarget}"{/if}>
{/if}
				<img src="{$eyecatchersource|escape}" alt="{$eyecatchertitle|escape}" style="width:{$eyecatcherwidth}px;height:{$eyecatcherheight}px" />
{if isset($eyecatcherlink)}
			</a>
{/if}
		</div>
		<div class="shadow782"></div>
	</div>
{/if}
		
{if $streams['header']->isVisible}
	<div id="headercontainer">
	<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="header">
		{$streams['header']->output}
	</div>
	<div class="shadow782"></div>
	</div>		
{/if}

<div id="maincontainer">

{if $streams['sidebarleft']->isVisible}
	<div id="sidebarleftcontainer">
		<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="sidebarleft">
			{$streams['sidebarleft']->output}
		</div>	
		<div class="shadow202"></div>		
	</div>
{/if}


{if $streams['content']->isVisible}
	<div id="contentcontainer" style="width:{$width}px">
		<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="content">
		
{if $page->pagecaption()!==''}
	<h1>{$page->pagecaption()|escape}</h1>
{/if}
		
		
			{$streams['content']->output}
		</div>
		<div class="shadow{$width}"></div>
	</div>
{/if}

{if $streams['sidebarright']->isVisible}
	<div id="sidebarrightcontainer">
		<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="sidebarright">
			{$streams['sidebarright']->output}
		</div>
		<div class="shadow202"></div>
	</div>
{/if}

<div class="clearfix"></div>

</div>

{if $streams['footer']->isVisible}
	<div id="footercontainer">
		<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="footer">
			{$streams['footer']->output}
		</div>
	<div class="shadow782"></div>
	</div>		
{/if}
		
		


{if (isset($commonnav) && count($commonnav)>0)}
		<div id="common">
{if (isset($commonnav) && count($commonnav)>0)}
{foreach $commonnav as $item}
{if !$item@first} | {/if}<a href="{$item->link|escape}">{$item->caption|escape}</a>
{/foreach}
{/if}
		</div>
{/if}


</div>

<div class="clearfix"></div>

</div>
		
{include file='footer.tpl'}