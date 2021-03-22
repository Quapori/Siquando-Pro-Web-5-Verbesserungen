{include file='header.tpl'}

<div id="topnav">

{if isset($logosource)}
{if isset($logolink)}
<a href="{$logolink|escape}"{if isset($logolinkclass)} class="{$logolinkclass}"{/if}{if isset($logolinktarget)} target="{$logolinktarget}"{/if}>
{/if}
	<img src="{$logosource|escape}" alt="{$logotitle|escape}" style="width:{$logowidth}px;height:{$logoheight}px" />
{if isset($logolink)}
</a>
{/if}
{/if}


<ul class="ngfademenu" data-fadecolor="#{{$config['palette.topbarhover']}}">
{foreach $commonnav as $item}
<li><a href="{$item->link|escape}">{$item->caption}</a></li>
{/foreach}
</ul>

<form action="{$search|escape}"  >
	<input placeholder="{$langsearch['searchfor']->value|escape}" type="text" name="criteria"  />
	<button type="submit"></button>
</form>

</div>

<div id="nav">

<div style="height: 59px;"></div>

{if isset($eyecatcherleftsource)}
{if isset($eyecatcherleftlink)}
<a href="{$eyecatcherleftlink|escape}"{if isset($eyecatcherleftlinkclass)} class="{$eyecatcherleftlinkclass}"{/if}{if isset($eyecatcherleftlinktarget)} target="{$eyecatcherleftlinktarget}"{/if}>
{/if}
	<img src="{$eyecatcherleftsource|escape}" alt="{$eyecatcherlefttitle|escape}" style="width:{$eyecatcherleftwidth}px;height:{$eyecatcherleftheight}px" />
{if isset($eyecatcherleftlink)}
</a>
{/if}
{/if}

<ul class="ngflymenu ngfademenu" data-fadecolor="#{{$config['palette.leftbarhover']}}">{$nav}</ul>
</div>		

<div id="maincontainer">
	<div id="maincenter">

		<div style="height: 79px;"></div>

{if isset($eyecatchertopsource)}
		<div id="eyecatcher">
{if isset($eyecatchertoplink)}
			<a href="{$eyecatchertoplink|escape}"{if isset($eyecatchertoplinkclass)} class="{$eyecatchertoplinkclass}"{/if}{if isset($eyecatchertoplinktarget)} target="{$eyecatchertoplinktarget}"{/if}>
{/if}
				<img src="{$eyecatchertopsource|escape}" alt="{$eyecatchertoptitle|escape}" style="width:{$eyecatchertopwidth}px;height:{$eyecatchertopheight}px" />
{if isset($eyecatchertoplink)}
			</a>
{/if}		
		</div>	
{/if}
		
{if $streams['header']->isVisible}
			<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="header">
				{$streams['header']->output}
			</div>
{/if}

<div id="contentcontainer">

{if $streams['sidebarleft']->isVisible}
			<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="sidebarleft">
				{$streams['sidebarleft']->output}
			</div>		
{/if}
{if $streams['content']->isVisible}
			<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} style="width: {$contentwidth}px" id="content">
{if $page->pagecaption()!==''}
			<h1>{$page->pagecaption()|escape}</h1>
{if (isset($breadcrumbs))}
			<p class="breadcrumbs">{$lang['youarehere']->value} {$breadcrumbs}</p>
{/if}
{/if}
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
		</div>	
		
</div>
		
{include file='footer.tpl'}