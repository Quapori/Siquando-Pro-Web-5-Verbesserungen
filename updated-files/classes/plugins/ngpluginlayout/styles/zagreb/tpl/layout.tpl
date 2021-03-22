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



<header data-autoprogress="{$autoprogress}" data-parallax="{$parallax}" data-small="{$small}" data-speed="{$speed}">
<div id="headercontainer">
{if isset($topich264) || isset($topicogv) || isset($topicwebm)}
<video class="eyecatcherchild" loop autoplay="autoplay" playsinline="playsinline" {if isset($poster)} poster="{$poster|escape}"{/if} {if $mutevideo}muted="muted"{/if}>
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
<img class="eyecatcherchild" src="{$pictures[0]|escape}" alt="" />
{else if isset($eyecatchersource)}
<img class="eyecatcherchild" src="{$eyecatchersource|escape}" alt="" />
{/if}

</div>
{if $wait}
<div id="eyecatcherwait"></div>
{/if}

<div id="sqrheadertopbox"></div>
<div id="sqrheaderbottombox">

<div>

{if $page->pagecaption()!==''}
<h1>{$page->pagecaption()|escape}</h1>
{/if}

{if $page->summary!==''}
{$page->summary}
{/if}

{if count($pictures)>1 && !isset($topich264) && !isset($topicogv) && !isset($topicwebm)}
<div id="headersliderbullets">
{foreach $pictures as $picture}
<a href="{$picture|escape}"></a>
{/foreach}
</div>
{/if}

{if $down}
<div id="sqrtobottom"></div>
{/if}

</div>
</div>
</header>


{if $streams['header']->isVisible}
<div id="topcontainer">
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