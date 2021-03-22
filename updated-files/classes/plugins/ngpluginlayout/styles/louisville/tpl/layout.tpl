{include file='header.tpl'}

<div id="topnav">

<ul>
<li><a href="{$homeurl}">{$homecaption}</a></li>
{foreach $commonnav as $item}
<li><a href="{$item->link|escape}">{$item->caption|escape}</a></li>
{/foreach}
</ul>

<form action="{$search|escape}"  >
	<input placeholder="{$langsearch['searchfor']->value|escape}" type="text" name="criteria"  />
	<button type="submit"></button>
</form>

<div class="clearfix"></div>

</div>

<div id="center">

<div id="nav">

{if isset($logosource)}
{if isset($logolink)}
<a href="{$logolink|escape}"{if isset($logolinkclass)} class="{$logolinkclass}"{/if}{if isset($logolinktarget)} target="{$logolinktarget}"{/if}>
{/if}
	<img src="{$logosource|escape}" alt="{$logotitle|escape}" style="width:{$logowidth}px;height:{$logoheight}px" />
{if isset($logolink)}
</a>
{/if}
{/if}

{if $streams['sidebarleft']->isVisible}
			<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="sidebarleft">
				{$streams['sidebarleft']->output}
			</div>		
{/if}

<div id="navigationcontainer">
<ul id="navigation">
{$nav}
</ul>
</div>

</div>

<div id="main">

{if $page->pagecaption()!==''}
	<div id="maincaptionfixed" style="display: none">
	<h1>{$page->pagecaption()|escape}
	</h1>
	</div>
	<div id="maincaption">
	<h1>{$page->pagecaption()|escape}
	</h1>
	</div>
{/if}

{if isset($eyecatchersource)}
{if isset($eyecatcherlink)}
<a href="{$eyecatcherlink|escape}"{if isset($eyecatcherlinkclass)} class="{$eyecatcherlinkclass}"{/if}{if isset($eyecatcherlinktarget)} target="{$eyecatcherlinktarget}"{/if}>
{/if}
	<img id="eyecatcher" src="{$eyecatchersource|escape}" alt="{$eyecatchertitle|escape}" style="width:{$eyecatcherwidth}px;height:{$eyecatcherheight}px" />
{if isset($eyecatcherlink)}
</a>
{/if}
{/if}

{if $streams['header']->isVisible}
			<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="header">
				{$streams['header']->output}
			</div>		
{/if}


{if $streams['content']->isVisible}
			<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} style="width: {$contentwidth}px" id="content">
				{$streams['content']->output}
			</div>		
{/if}

{if $streams['sidebarright']->isVisible}
			<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="sidebarright">
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


<div class="clearfix"></div>

</div>
		
{include file='footer.tpl'}
