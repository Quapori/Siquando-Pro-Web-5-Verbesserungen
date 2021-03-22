<!DOCTYPE html>

<html lang="de" class="sqr"> 
	<head>
		<title>{$title}</title>
		<meta charset="UTF-8" />
{if (isset($canonical))}
		<link rel="canonical" href="{$canonical}" />
{/if}
{foreach $metatags as $metatag}
		<meta name="{$metatag@key|escape}" content="{$metatag|escape}" />
{/foreach}
{foreach $stylesheets as $stylesheet}
		<link rel="stylesheet" href="{$stylesheet}" />
{/foreach}
{foreach $javascripts as $javascript}
		<script src="{$javascript}"></script>
{/foreach}
{if (count($styles) > 0)}
		<style type="text/css">
		<!--
{foreach $styles as $style}
{$style}
{/foreach}
		-->
		</style>
{/if}
{if $googleanalytics!==''}
		<script>
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', '{$googleanalytics|escape}']);
		  _gaq.push(['_gat._anonymizeIp']);
		  _gaq.push(['_trackPageview']);
		
		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		</script>
{/if}
{if isset($htmlcode['head'])}{$htmlcode['head']}{/if}		
	</head>
	

	<body>	
{if isset($htmlcode['bodytop'])}{$htmlcode['bodytop']}{/if}

{if $page->pagecaption()!==''}
	<div class="sqrallwaysboxed" >
		<h1>{$page->pagecaption()|escape}</h1>
{if (isset($breadcrumbs))}
		<p class="breadcrumbs">{$lang['youarehere']->value} {$breadcrumbs}</p>
{/if}
	</div>
{/if}



<div id="content">
	{$streams['content']->output}
</div>		

{if isset($htmlcode['bodybottom'])}{$htmlcode['bodybottom']}{/if}
	</body>
</html>