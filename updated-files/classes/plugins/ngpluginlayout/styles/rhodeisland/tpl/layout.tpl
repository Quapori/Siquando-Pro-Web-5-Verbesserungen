{include file='header.tpl'}

{if isset($eyecatchersource)}
<header class="sqrheader" data-parallax="{$parallax}">
<img src="{$eyecatchersource|escape}" width="{$eyecatcherwidth}" height="{$eyecatcherheight}" alt="" />
</header>
{else}
<div class="sqrnavpad"></div>
{/if}

<div class="sqrnavcontainer">
<nav class="sqrnav">

{if isset ($logosmallsource)}
<a href="#" class="sqrnavhide"><img src="{$logosmallsource|escape}" alt="" {if isset ($logosmallsourcehd)} srcset="{$logosmallsource|escape} 1x, {$logosmallsourcehd|escape} 2x" {/if} /></a>
<a href="#" class="sqrnavshow"><img src="{$logosmallsource|escape}" alt="" {if isset ($logosmallsourcehd)} srcset="{$logosmallsource|escape} 1x, {$logosmallsourcehd|escape} 2x" {/if} /></a>
{else}
<a href="#" class="sqrnavhide">{$lang['hidenavigation']->value}</a>
<a href="#" class="sqrnavshow">{$lang['shownavigation']->value}</a>
{/if}

<ul>
{if isset ($logosource)}
<li class="sqrnavlogo"><a href="{$home|escape}"><img width="{$logowidth}" height="{$logoheight}" class="sqrlogo" src="{$logosource|escape}" alt="" {if isset ($logosourcehd)} srcset="{$logosource|escape} 1x, {$logosourcehd|escape} 2x" {/if} /></a></li>
{/if}
{$nav}
{if $search!==''}
<li class="sqrnavsearch"><a href="#"><span>{$lang['search']->value}</span></a>
<ul><li>
<form action="{$search|escape}"  >
	<input type="text" name="criteria"  />
</form>
</li></ul></li></ul>
{/if}
</nav>
</div>

{if $streams['header']->isVisible}
	<div class="{if $previewmode}ngparagraphstreamcontainer {/if}" id="header">
		{$streams['header']->output}		
	</div>		
{/if}

<div id="main">

{if $page->pagecaption()!==''}
	<div class="sqrallwaysboxed" >
		<h1>{$page->pagecaption()|escape}</h1>
{if (isset($breadcrumbs))}
		<p class="breadcrumbs">{$lang['youarehere']->value} {$breadcrumbs}</p>
{/if}
	</div>
{/if}

{if $cols>1}
<div class="{$mainstyle} sqrdesktopboxed">
{/if}
{if $streams['sidebarleft']->isVisible}
	<div class="{if $previewmode}ngparagraphstreamcontainer {/if}" id="sidebarleft">
		{$streams['sidebarleft']->output}
	</div>		
{/if}


{if $streams['content']->isVisible}
	<div class="{if $previewmode}ngparagraphstreamcontainer {/if}" id="content">	
		{$streams['content']->output}
	</div>		
{/if}

{if $streams['sidebarright']->isVisible}
	<div class="{if $previewmode}ngparagraphstreamcontainer{/if}" id="sidebarright">
		{$streams['sidebarright']->output}
	</div>		
{/if}
{if $cols>1}
</div>
{/if}
</div>

{if $streams['footer']->isVisible}
	<div class="{if $previewmode}ngparagraphstreamcontainer {/if}" id="footer">
		{$streams['footer']->output}		
	</div>		
{/if}

<footer class="sqrcommon">
  
{if isset($commonnavhierarchical)}
<ul class="sqrcommonnavhierarchical sqrcommonnavhierarchical{min(5,count($commonnavhierarchical))}col">
{foreach $commonnavhierarchical as $topic}
<li>
<em>{$topic->caption|escape}</em>
<ul>
{foreach $topic->pages as $page}
<li><a href="{$page->link|escape}">{$page->caption|escape}</a></li>
{/foreach}
</ul>
</li>
{/foreach}
</ul>
{/if}

{if isset($commonnav)}
<ul class="sqrcommonnav">
{foreach $commonnav as $item}
<li>
<a href="{$item->link|escape}">{$item->caption|escape}</a>
</li>
{/foreach}
</ul>
{/if}


{if $footer!==''}
<div class="sqrfootertext"> 
{$footer}
</div>
{/if}
</footer>

		
{include file='footer.tpl'}