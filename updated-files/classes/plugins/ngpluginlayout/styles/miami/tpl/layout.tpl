{include file='header.tpl'}

<div id="mainwrap">

<div id="navbar">
	<div id="nav">
	
	{if isset($logosource)}
<div id="logo">
{if isset($logolink)}
<a href="{$logolink|escape}"{if isset($logolinkclass)} class="{$logolinkclass}"{/if}{if isset($logolinktarget)} target="{$logolinktarget}"{/if}>
{/if}
	<img id="logo" src="{$logosource|escape}" alt="{$logotitle|escape}" style="width:{$logowidth}px;height:{$logoheight}px" />
{if isset($logolink)}
</a>
{/if}
</div>
{/if}
		<ul id="menu">{$nav}</ul>
	</div>
	<div id="navbottom"></div>
</div>

<div id="common">
<a href="{$homeurl|escape}">{$homecaption|escape}</a>
{foreach $commonnav as $item}
 &nbsp;&nbsp;|&nbsp;&nbsp; <a href="{$item->link|escape}">{$item->caption|escape}</a>
{/foreach}
</div>

{if isset($eyecatchersource)}
<div id="eyecatcher">
{if isset($eyecatcherlink)}
<a href="{$eyecatcherlink|escape}"{if isset($eyecatcherlinkclass)} class="{$eyecatcherlinkclass}"{/if}{if isset($eyecatcherlinktarget)} target="{$eyecatcherlinktarget}"{/if}>
{/if}
	<img id="eyecatcher" src="{$eyecatchersource|escape}" alt="{$eyecatchertitle|escape}" style="width:{$eyecatcherwidth}px;height:{$eyecatcherheight}px" />
{if isset($eyecatcherlink)}
</a>
{/if}

<form action="{$search|escape}"  >
	<input placeholder="{$langsearch['searchfor']->value|escape}" type="text" name="criteria"  />
	<button type="submit"></button>
</form>


</div>

{/if}

<div id="main">

{if $page->pagecaption()!==''}
	<div>
		<h1>{$page->pagecaption()|escape}</h1>
{if (isset($breadcrumbs))}
		<p class="breadcrumbs">{$lang['youarehere']->value} {$breadcrumbs}</p>
{/if}
	</div>
{/if}

{if $streams['header']->isVisible}
			<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="header">
				{$streams['header']->output}
			</div>		
{/if}

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

{if $streams['footer']->isVisible}
			<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="footer">
				{$streams['footer']->output}
			</div>		
{/if}


</div>

</div>
		
{include file='footer.tpl'}
