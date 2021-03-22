{include file='header.tpl'}
{if $navvisible && ($navposition=='above' || $navposition=='fixed')}
		<div id="navouterbox">
			<div id="nav">
				{$nav->output}
				<div class="clearfix"></div>
			</div>
		</div>
{/if}

{if $eyecatchervisible} 	
		<div id="eyecatcherouterbox">			
			<div id="eyecatcher">
				{$eyecatcher->output}
			</div>
		</div>
{/if}

{if $navvisible && $navposition=='below'}
		<div id="navouterbox">
			<div id="nav">
				{$nav->output}
				<div class="clearfix"></div>
			</div>
		</div>
{/if}


{if $streams['header']->isVisible}
		<div id="headerouterbox">
			<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="header">
				{if $page->pagecaption()!=='' && $captionposition==='header'}
					<h1>{$page->pagecaption()|escape}</h1>
				{/if}
				{$streams['header']->output}
			</div>
		</div>
{/if}
		<div id="containermainouterbox">
			<div id="containermain"{if $containermainfauxcolumns!=''} style="background-image: url({$containermainfauxcolumns}); background-repeat: repeat-y"{/if}>
{if $containerleftwidth>0} 			
			<div id="containerleft" style="width:{$containerleftwidth}px">
{if $logoleftvisible}
			<div id="logoleft">
				<a href="{$logoleftlink|escape}"><img src="{$logoleftsource|escape}" style="width:{$logoleftwidth}px;height:{$logoleftheight}px" alt="" /></a>
			</div>		
{/if}
{if $searchleftvisible}				
			<div id="searchleft">
				<form action="{$search|escape}"  >
					<input placeholder="{$langsearch['searchfor']->value|escape}" type="text" name="criteria"  />
					<button type="submit"></button>
				</form>
			</div>		
{/if}
{if $navleftvisible}				
			<div id="navleft">{$navleft->output}</div>		
{/if}	
{if $streams['sidebarleft']->isVisible}
				<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="sidebarleft">
				{if $page->pagecaption()!=='' && $captionposition==='sidebarleft'}
					<h1>{$page->pagecaption()|escape}</h1>
				{/if}
				{$streams['sidebarleft']->output}
				</div>
{/if}
			</div>
{/if}
				
				<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="content" style="width:{$streams['content']->renderWidth}px">
{if isset($breadcrumbs)}
<p class="breadcrumbs">{$lang['youarehere']->value} {$breadcrumbs}</p>
{/if}				
{if $page->pagecaption()!=='' && $captionposition==='content'}
<h1>{$page->pagecaption()|escape}</h1>
{/if}
				{$streams['content']->output}
				
{if isset($subnav)}
{$subnav}
{/if}				
				
				</div>
				
				
{if $containerrightwidth>0}
<div id="containerright" style="width:{$containerrightwidth}px">
{if $logorightvisible}
			<div id="logoright">
				<a href="{$logorightlink|escape}"><img src="{$logorightsource|escape}" style="width:{$logorightwidth}px;height:{$logorightheight}px" alt="" /></a>
			</div>		
{/if}
{if $searchrightvisible}	
				<div id="searchright">
					<form action="{$search|escape}"  >
						<input placeholder="{$langsearch['searchfor']->value|escape}" type="text" name="criteria"  />
						<button type="submit"></button>
					</form>
				</div>	
{/if}
{if $navrightvisible}	
				<div id="navright">{$navright->output}</div>	
{/if}
{if $streams['sidebarright']->isVisible}
				<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="sidebarright">
				{if $page->pagecaption()!=='' && $captionposition==='sidebarright'}
					<h1>{$page->pagecaption()|escape}</h1>
				{/if}
				{$streams['sidebarright']->output}
				</div>
{/if}				
</div>
{/if}

				<div class="clearfix"></div>
			</div>
		</div>
{if $streams['footer']->isVisible}
		<div id="footerouterbox">
			<div {if $previewmode}class="ngparagraphstreamcontainer"{/if} id="footer">
				{if $page->pagecaption()!=='' && $captionposition==='footer'}
					<h1>{$page->pagecaption()|escape}</h1>
				{/if}
				{$streams['footer']->output}
			</div>
		</div>
{/if}
{if $commonvisible}
		<div id="commonouterbox">
			<div id="common">
				{$common->output}
			</div>
		</div>
{/if}
{include file='footer.tpl'}