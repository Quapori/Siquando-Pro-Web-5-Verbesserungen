{include file='header.tpl'}

<div id="nav">
<div id="navpri">

{if isset($logosource)}
{if isset($logolink)}
	<a href="{$logolink|escape}"{if isset($logolinkclass)} class="{$logolinkclass}"{/if}{if isset($logolinktarget)} target="{$logolinktarget}"{/if}>
{/if}
		<img src="{$logosource|escape}" alt="{$logotitle|escape}" style="width:{$logowidth}px;height:{$logoheight}px" />
{if isset($logolink)}
	</a>
{/if}
{/if}

<ul>
{if isset($home)}<li><a href="{$home|escape}">{$homecaption}</a></li>{/if}
{foreach  $nav->children as $child }
{if count($child->children)>0}
<li><a class="navmore{if $child->objectUID==$active} active{/if}" href="#navsec{$child@index}">{$child->caption}</a></li>
{else}
<li><a{if $child->objectUID==$active} class="active"{/if} href="{$child->fullURL($preview)|escape}">{$child->caption}</a></li>
{/if}
{/foreach}
</ul>

<div class="clearfix"></div>

<form action="{$search|escape}"  >
	<input placeholder="{$langsearch['searchfor']->value|escape}" type="text" name="criteria"  />
	<button type="submit"></button>
</form>

</div>
</div>

<div id="navsec">
{foreach  $nav->children as $child }
{if count($child->children)>0}
<ul id="navsec{$child@index}">
{foreach  $child->children as $subchild }
<li>
	<a href="{$subchild->fullURL($preview)|escape}">{$subchild->caption}</a>
	
{if count($subchild->children)>0}
	<ul>
{foreach  $subchild->children as $subsubchild }
	<li><a href="{$subsubchild->fullURL($preview)|escape}">{$subsubchild->caption}</a></li>
{/foreach}
	</ul>
{/if}	
</li>
{/foreach}
</ul>
{/if}
{/foreach}
</div>

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

<div id="center">

{if $page->pagecaption()!==''}
	<div>
		<h1>{$page->pagecaption()|escape}</h1>
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

</div>

{if (isset($commonnav) && count($commonnav)>0)}
<div id="common">
<div>
{if (isset($commonnav) && count($commonnav)>0)}
{foreach $commonnav as $item}
{if !$item@first} &nbsp;&nbsp;&bull;&nbsp;&nbsp; {/if}<a href="{$item->link|escape}">{$item->caption|escape}</a>
{/foreach}
{/if}
</div>
</div>
{/if}

{if isset($openogg)}
<audio preload="auto" id="audioopen">
	<source src="{$openogg}" type='audio/ogg' />
	<source src="{$openmp3}" type='audio/mpeg' />
</audio>
<audio preload="auto" id="audioclose">
	<source src="{$closeogg}" type='audio/ogg' />
	<source src="{$closemp3}" type='audio/mpeg' />
</audio>
{/if}

		
{include file='footer.tpl'}