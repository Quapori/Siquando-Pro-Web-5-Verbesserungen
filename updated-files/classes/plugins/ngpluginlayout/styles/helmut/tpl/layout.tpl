{include file='header.tpl'}

<nav class="sqrnav">
<ul>
{if isset ($logosource)}
<li class="sqrnavlogo"><a href="{$home|escape}"><img src="{$logosource|escape}" alt="" {if isset ($logosourcehd)} srcset="{$logosource|escape} 1x, {$logosourcehd|escape} 2x" {/if} /></a></li>
{/if}{$nav}
</ul>
</nav>

{if isset($websitetitle) || isset($pagetitle)}
<header class="sqrheader">
<h1>{if isset($websitetitle)}{$websitetitle|escape} {/if}{if isset($pagetitle)}<span>{if isset($websitetitle)}/ {/if}{$pagetitle}</span>{/if}</h1>
</header>
{/if}

<div id="maincontainer">

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
  
{if isset($commonnav)}
<ul>
{foreach $commonnav as $item}
<li>
<a href="{$item->link|escape}">{$item->caption|escape}</a>
</li>
{/foreach}
</ul>
{/if}


{if $footer!==''}
<div> 
{$footer}
</div>
{/if}
</footer>
	
{include file='footer.tpl'}