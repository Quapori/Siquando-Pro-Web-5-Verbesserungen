{include file='header.tpl'}

{if isset ($logosource)}
<div class="sqrlogo"><a href="{$home|escape}"><img class="sqrlogo" src="{$logosource|escape}" alt="" {if isset ($logosourcehd)} srcset="{$logosource|escape} 1x, {$logosourcehd|escape} 2x" {/if} /></a></div>
{/if}


<nav class="sqrnav">

<a href="#" class="sqrnavhide">{$lang['hidenavigation']->value}</a>
<a href="#" class="sqrnavshow">{$lang['shownavigation']->value}</a>

<ul>
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


{if isset($topich264) || isset($topicogv) || isset($topicwebm)}
<div class="sqrvideoeyecatcher">
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
</div>
{elseif count($pictures)>0}
<div class="sqreyecatcher" data-autoprogress="{$autoprogress}">
<div class="sqreyecatchershifter">
{foreach $pictures as $picture}
<img src="{$picture['source']|escape}" width="{$picture['size']->width}" height="{$picture['size']->height}" alt="" />
{/foreach}
</div>
</div>
{elseif isset($eyecatchersource)}
<div class="sqreyecatcher">
<div class="sqreyecatchershifter">
<img src="{$eyecatchersource|escape}" width="{$eyecatcherwidth}" height="{$eyecatcherheight}" alt="" />
</div>
</div>
{/if}


{if !isset($topich264) && !isset($topicogv) && !isset($topicwebm) && count($pictures)===0 && !isset($eyecatchersource)}
<div id="toplinebox"></div>
{/if}

<div id="maincenterbox">


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
	<div class="{if $previewmode}ngparagraphstreamcontainer {/if}{if isset($topich264) || isset($topicogv) || isset($topicwebm) || count($pictures)>0 || isset($eyecatchersource)}sqrcontentpushup {/if}" id="content">
	
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