{include file='header.tpl'}

<nav class="sqrnav" data-up="{$up}" data-speed="{$speed}">
{if isset ($logosmallsource)}
<a href="#" class="sqrnavhide"><img src="{$logosmallsource|escape}" alt="" width="{$logosmallwidth}" height="{$logosmallheight}" {if isset ($logosmallsourcehd)} srcset="{$logosmallsource|escape} 1x, {$logosmallsourcehd|escape} 2x" {/if} /></a>
<a href="#" class="sqrnavshow"><img src="{$logosmallsource|escape}" alt="" width="{$logosmallwidth}" height="{$logosmallheight}" {if isset ($logosmallsourcehd)} srcset="{$logosmallsource|escape} 1x, {$logosmallsourcehd|escape} 2x" {/if} /></a>
{else}
<a href="#" class="sqrnavhide">{$lang['hidenavigation']->value}</a>
<a href="#" class="sqrnavshow">{$lang['shownavigation']->value}</a>
{/if}
<ul>
{if isset ($logosource)}
<li class="sqrnavlogo"><img class="sqrlogo" src="{$logosource|escape}" width="{$logowidth}" height="{$logoheight}" alt="" {if isset ($logosourcehd)} srcset="{$logosource|escape} 1x, {$logosourcehd|escape} 2x" {/if} /></li>
{/if}
</ul>
</nav>

<div class="sqreyecatcher" style="background-color: #{$topcolor}">
{if isset($topich264) || isset($topicogv) || isset($topicwebm)}
<div class="sqreyecatchercontainer">
<video  {if $parallax}class="sqreyecatcherparallax"{/if} class="perpetuumcontainerchild" loop autoplay="autoplay" playsinline="playsinline" {if isset($poster)} poster="{$poster|escape}"{/if} {if isset($mutevideo)}muted="muted"{/if} >
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
</div>
{else if count($pictures)>0}
<div class="sqreyecatchercontainer">
<div class="sqreyecatcherstage{if $parallax} sqreyecatcherparallax{/if}" data-fadeeffect="{$fadeeffect}" data-autoprogress="{$autoprogress}">
<img src="{$pictures[0]|escape}" alt="" />
</div>
</div>
{if count($pictures)>1}
<div class="sqreyecatchernav" style="width: {count($pictures)*24}px">
{foreach $pictures as $picture}
<a href="{$picture|escape}"></a>
{/foreach}
</div>
{/if}
{else if isset($eyecatchersource)}
<div class="sqreyecatchercontainer">
<img src="{$eyecatchersource|escape}" {if $parallax}class="sqreyecatcherparallax"{/if} alt="" />
</div>
{else}
<div class="sqrnoeyecatcher"></div>
{/if}
</div>

{if $page->pagecaption()!==''}
<div id="captioncontainer" style="background-color: #{$topcolor}">
	<div class="sqrallwaysboxed" >
		<h1>{$page->pagecaption()|escape}</h1>
	</div>
</div>
{/if}



{if $streams['header']->isVisible}
<div id="headercontainer">
	<div class="{if $previewmode}ngparagraphstreamcontainer {/if}" id="header">
		{$streams['header']->output}		
	</div>
</div>		
{/if}


<div id="maincontainer">
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
</div>

{if $streams['footer']->isVisible}
<div id="footercontainer">
	<div class="{if $previewmode}ngparagraphstreamcontainer {/if}" id="footer">
		{$streams['footer']->output}		
	</div>		
</div>
{/if}

</div>

{if $footer!=='' || count($commonnav)>0}
<footer class="sqrcommon">
<ul class="sqrcommonnav">
{foreach $commonnav as $item}
<li>
<a href="{$item->link|escape}">{$item->caption|escape}</a>
</li>
{/foreach}
</ul>

{if $footer!==''}
<div class="sqrfootertext"> 
{$footer}
</div>
{/if}
</footer>
{/if}
		
{include file='footer.tpl'}