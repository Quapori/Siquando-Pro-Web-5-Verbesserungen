{include file='header.tpl'}

<div class="center">

<div id="nav">
	<ul>{$nava}</ul>
	
	<form action="{$search|escape}"  >
		<input placeholder="{$langsearch['searchfor']->value|escape}" type="text" name="criteria"  />
		<button type="submit"></button>
	</form>
	
</div>


{if isset($eyecatchersource)}
<div id="eyecatcher">	
	<img src="{$eyecatchersource|escape}" alt="{$eyecatchertitle|escape}" style="width:{$eyecatcherwidth}px;height:{$eyecatcherheight}px" />
{if isset($eyecatcherlink)}
	<a href="{$eyecatcherlink|escape}"{if isset($eyecatcherlinkclass)} class="{$eyecatcherlinkclass}"{/if}{if isset($eyecatcherlinktarget)} target="{$eyecatcherlinktarget}"{/if}>
{/if}
	<div class="mask"></div>
{if isset($eyecatcherlink)}
	</a>
{/if}
<a id="home" href="{$home|escape}" title="{$homecaption|escape}"></a>

<ul>{$navb}</ul>

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

<div id="bottom">

{if (isset($commonnav) && count($commonnav)>0)}
{foreach $commonnav as $item}
{if !$item@first} &nbsp;&nbsp; {/if}<a href="{$item->link|escape}">{$item->caption|escape}</a>
{/foreach}
{/if}


</div>

</div>

		
{include file='footer.tpl'}