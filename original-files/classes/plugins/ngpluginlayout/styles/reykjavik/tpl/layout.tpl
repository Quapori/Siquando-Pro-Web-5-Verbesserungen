{include file='header.tpl'}


<nav class="sqrnav">

{if isset ($logosmallsource)}
<a href="#" class="sqrnavhide"><img src="{$logosmallsource|escape}" alt="" width="{$logosmallwidth}" height="{$logosmallheight}" {if isset ($logosmallsourcehd)} srcset="{$logosmallsource|escape} 1x, {$logosmallsourcehd|escape} 2x" {/if} /></a>
<a href="#" class="sqrnavshow"><img src="{$logosmallsource|escape}" alt="" width="{$logosmallwidth}" height="{$logosmallheight}" {if isset ($logosmallsourcehd)} srcset="{$logosmallsource|escape} 1x, {$logosmallsourcehd|escape} 2x" {/if} /></a>
{else}
<a href="#" class="sqrnavhide">{$lang['hidenavigation']->value}</a>
<a href="#" class="sqrnavshow">{$lang['shownavigation']->value}</a>
{/if}

<ul>
{if isset ($logosource)}
<li class="sqrnavlogo"><a href="{$home|escape}"><img class="sqrlogo" src="{$logosource|escape}" width="{$logowidth}" height="{$logoheight}" alt="" {if isset ($logosourcehd)} srcset="{$logosource|escape} 1x, {$logosourcehd|escape} 2x" {/if} /></a></li>
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

<div class="sqreyecatcher">
{if isset($topich264) || isset($topicogv) || isset($topicwebm)}
<video class="perpetuumcontainerchild" loop autoplay="autoplay" playsinline="playsinline" {if isset($poster)} poster="{$poster|escape}"{/if} {if isset($mutevideo)}muted="muted"{/if} data-width="1920" data-height="1080">
{if isset($topich264)}
  <source src="{$topich264|escape}" type="video/mp4" />
{/if}
{if isset($topicogv)}
  <source src="{$topicogv|escape}" type="video/ogg" />
{/if}
{if isset($topicwebm)}
  <source src="{$topicwebm|escape}" type="video/webm" />
{/if}
</video>
{else if count($pictures)>0}
<div class="sqreyecatcherstage" data-fadeeffect="{$fadeeffect}" data-autoprogress="{$autoprogress}">
<img src="{$pictures[0]|escape}" alt="" />
</div>
{if count($pictures)>1}
<div class="sqreyecatchernav" style="width: {count($pictures)*20}px">
{foreach $pictures as $picture}
<a href="{$picture|escape}"></a>
{/foreach}
</div>
{/if}
{else if isset($eyecatchersource)}
<img src="{$eyecatchersource|escape}" alt="" />
{/if}
</div>

<div id="maincontainer">

{if $page->pagecaption()!==''}
	<div class="sqrallwaysboxed" >
		<h1>{$page->pagecaption()|escape}</h1>
{if (isset($breadcrumbs))}
		<p class="breadcrumbs">{$lang['youarehere']->value} {$breadcrumbs}</p>
{/if}
	</div>
{/if}


{if $streams['header']->isVisible}
	<div class="{if $previewmode}ngparagraphstreamcontainer {/if}" id="header">
		{$streams['header']->output}		
	</div>		
{/if}

<div id="main">
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

</div>

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