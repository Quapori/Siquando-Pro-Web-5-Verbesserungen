{include file='header.tpl'}

<div id="sqrouterbox">


<header class="sqrheader">
<div class="sqrlogo">
{if isset ($logosource)}
<a href="{$home|escape}"><img class="sqrlogo" src="{$logosource|escape}" alt="" {if isset ($logosourcehd)} srcset="{$logosource|escape} 1x, {$logosourcehd|escape} 2x" {/if} /></a>
{/if}
</div>
<a class="sqropennav sqrsetmode" href="#sqrmodenav"></a>
<a class="sqrhome" href="{$home|escape}"></a>

{if $search!==''}
<div class="sqrsearch">
<form action="{$search|escape}">
<input type="text" name="criteria" id="searchcriteria"  />
<input type="submit" />
</form>
</div>
{/if}

<div class="sqrnav sqrnavmain" data-expandnav="{$expandnav}">

<ul>
{$nav}
</ul>

</div>

</header>


{if $streams['header']->isVisible}
	<div class="{if $previewmode}ngparagraphstreamcontainer {/if}" id="header">
		{if $page->pagecaption()!=='' && $captionposition=='header'}
		<div class="sqrallwaysboxed" >
			<h1>{$page->pagecaption()|escape}</h1>
		{if (isset($breadcrumbs))}
			<p class="breadcrumbs">{$lang['youarehere']->value} {$breadcrumbs}</p>
		{/if}
		</div>
		{/if}
		{$streams['header']->output}		
	</div>		
{/if}

<div id="main">
{if isset($mainstyle)}
<div class="{$mainstyle}">
{/if}
{if $streams['sidebarleft']->isVisible}
	<div class="{if $previewmode}ngparagraphstreamcontainer {/if}" id="sidebarleft">
		{$streams['sidebarleft']->output}
	</div>		
{/if}


{if $streams['content']->isVisible}
	<div class="{if $previewmode}ngparagraphstreamcontainer {/if}" id="content">
	
	{if $page->pagecaption()!=='' && $captionposition=='content'}
	<div class="sqrallwaysboxed" >
		<h1>{$page->pagecaption()|escape}</h1>
	{if (isset($breadcrumbs))}
		<p class="breadcrumbs">{$lang['youarehere']->value} {$breadcrumbs}</p>
	{/if}
	</div>
	{/if}
		{$streams['content']->output}
	</div>		
{/if}

{if $streams['sidebarright']->isVisible}
	<div class="{if $previewmode}ngparagraphstreamcontainer{/if}" id="sidebarright">
		{$streams['sidebarright']->output}
	</div>		
{/if}
{if isset($mainstyle)}
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

</div>
		
{include file='footer.tpl'}