{include file='header.tpl'}

<div id="center">

<div id="logo">

{if isset($logosource)}
{if isset($logolink)}
	<a href="{$logolink|escape}"{if isset($logolinkclass)} class="{$logolinkclass}"{/if}{if isset($logolinktarget)} target="{$logolinktarget}"{/if}>
{/if}
		<img src="{$logosource|escape}" alt="{$logotitle|escape}" style="width:{$logowidth}px;height:{$logoheight}px" />
{if isset($logolink)}
	</a>
{/if}
{/if}

{if (isset($commonnav) && count($commonnav)>0)}
<ul>
{foreach $commonnav as $item}
<li><a href="{$item->link|escape}">{$item->caption|escape}</a></li>
{/foreach}
</ul>
{/if}


<form action="{$search|escape}"  >
	<input placeholder="{$langsearch['searchfor']->value|escape}" type="text" name="criteria"  />
	<button type="submit"></button>
</form>


</div>

<div id="navigation">
<ul>

<li><a id="home" href="{$home|escape}"><span>{$homecaption|escape}</span></a></li>

{$nav}
</ul>

<div class="clearfix"></div>

</div>

<div id="maincontainer">

<div id="subnav">

<a class="subnavheader" href="{$subnav->fullURL($preview)|escape}">{$subnav->caption|escape}</a>

<ul>
{foreach  $subnav->children as $child }
	<li>
	<a class="subnavindex" href="{$child->fullURL($preview)|escape}">{$child@iteration}</a>
	<a class="subnavcaption" href="{$child->fullURL($preview)|escape}">{$child->caption|escape}</a></li>
{/foreach}
</ul>
</div>

<div id="main">

{if isset($eyecatchersource)}
<div id="eyecatcher">
		<img src="{$eyecatchersource|escape}" alt="{$eyecatchertitle|escape}" style="width:{$eyecatcherwidth}px;height:{$eyecatcherheight}px" />

{if $page->pagecaption()!==''}
	<h1>
		<span>{$page->pagecaption()|escape}</span>
	</h1>
{/if}


</div>
{/if}


{if (isset($breadcrumbs))}
	<div id="breadcrumbs">
		{$lang['youarehere']->value} {$breadcrumbs}
	</div>
{/if}

{if $streams['header']->isVisible}
	<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="header">
		{$streams['header']->output}
	</div>		
{/if}

<div>

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


</div>

<div class="clearfix"></div>

</div>

</div>
		
{include file='footer.tpl'}