{include file='header.tpl'}
		<div id="main">
		
{if $choosevisible}
		<div id="choose">
			<p>{$langphone['chooseheader']->value|escape}</p>
			<button id="choosedesktop">{$langphone['choosedesktop']->value|escape}</button>	
			<button id="choosequiet">{$langphone['choosequiet']->value|escape}</button>
		</div>
{/if}
		
{if isset($eyecatchersource)} 	
			<div id="eyecatcherouterbox">			
				<div id="eyecatcher">
					<img src="{$eyecatchersource|escape}" alt="" class="logo" />
				</div>
			</div>
{/if}
{if isset($nav)}
			<div id="nav">
			
{if $navshownav}			
				<ul>
					<li id="hidenav" style="display: none"><a href="#">{$langphone['hidenav']->value|escape}</a></li>
					<li id="shownav"><a href="#">{$langphone['shownav']->value|escape}</a></li>
				</ul>
{/if}
				<ul>
{foreach $nav as $navitem}
					<li><a href="{$navitem->fullURL($previewmode)}">{$navitem->caption|escape}</a></li>
{/foreach}
				</ul>
			</div>
{/if}
{if isset($search)}	
			<div id="search">
				<form action="{$search|escape}"  >
					<input placeholder="{$langsearch['searchfor']->value|escape}" type="text" name="criteria"  />
					<button type="submit"></button>
				</form>
			</div>	
{/if}
{if $streams['header']->isVisible}
			<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="header">
				{$streams['header']->output}
			</div>
{/if}
{if $streams['sidebarleft']->isVisible}
			<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="sidebarleft">
				{$streams['sidebarleft']->output}
			</div>		
{/if}
{if $streams['content']->isVisible}
			<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="content">
{if $page->pagecaption()!==''}
			<h1>{$page->pagecaption()|escape}</h1>
{/if}
				{$streams['content']->output}
			</div>		
{/if}
{if $streams['sidebarright']->isVisible}
			<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="sidebarright">
				{$streams['sidebarright']->output}
			</div>		
{/if}
{if $streams['footer']->isVisible}
			<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="footer">
				{$streams['footer']->output}
			</div>		
{/if}
{if isset($commonpages)}
	<div id="common">
				<ul>
{foreach $commonpages as $commonpage}
					<li><a href="{$commonpage->link|escape}">{$commonpage->caption|escape}</a></li>
{/foreach}
				</ul>
	</div>
{/if}
{if isset($commontopics)}
	<div id="common">
				<ul>
{foreach $commontopics as $commontopic}
					<li><span>{$commontopic->caption|escape}:</span></li>
{foreach $commontopic->pages as $commonpage}
					<li><a href="{$commonpage->link|escape}">{$commonpage->caption|escape}</a></li>
{/foreach}
{/foreach}
				</ul>
	</div>
{/if}



		</div>	
{include file='footer.tpl'}