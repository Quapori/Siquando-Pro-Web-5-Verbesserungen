<!DOCTYPE html>

<html{if (array_key_exists('w2dng.lang', $metatags))} lang="{$metatags['w2dng.lang']}"{/if}{if isset($htmlclass)} class="{$htmlclass}"{/if}>
	<head>
		<title>{$title|escape}</title>
		<meta charset="UTF-8" />
{if (isset($viewport))}
		<meta name="viewport" content="{$viewport}" />
{elseif (isset($viewportwidth))}
		<meta name="viewport" content="maximum-scale=8.0, width={$viewportwidth}" />
{/if}
{if (isset($canonical))}
		<link rel="canonical" href="{$canonical}" />
{/if}
{if isset($favicon)}
		<link rel="shortcut icon" sizes="16x16" href="{$favicon|escape}" />
{/if}
{if isset($favicon2x)}
		<link rel="shortcut icon" sizes="32x32" href="{$favicon2x|escape}" />
{/if}
{if isset($androidicon)}
		<link rel="shortcut icon" sizes="196x196" href="{$androidicon|escape}" />
{/if}
{if isset($touchicons)}
{foreach $touchicons as $size => $url}
		<link rel="apple-touch-icon{if $touchiconprecomposed}-precomposed{/if}" {if $size!==''}sizes="{$size}" {/if}href="{$url|escape}" />
{/foreach}
{/if}
{foreach $metatags as $id => $value}
{if substr($id,0,6)!=='w2dng.'}
{if substr($id,0,3)=='og:'}
		<meta property="{$id|escape}" content="{$value|escape}" />
{else}
		<meta name="{$id|escape}" content="{$value|escape}" />
{/if}
{/if}
{/foreach}

{foreach $stylesheets as $stylesheet}
<link rel="stylesheet" href="{$stylesheet|escape}" />
{/foreach}
{*
	Dieser Block kann entfernt werden. Es dient nur Darstellung dieser Anleitung
*}
{foreach $javascripts as $id=>$javascript}
	{if substr($javascript,0,7)==='http://' || substr($javascript,0,8)==='https://'}<!-- START-NGCON [{$id|escape}] -->{/if}
	<script src="{$javascript|escape}"{if $deferjs && $id!=='jquery' && $id!=='lightbox' && $id!=='ngshopglobals'} defer="defer"{/if}></script>
	{if substr($javascript,0,7)==='http://' || substr($javascript,0,8)==='https://'}<!-- END-NGCON -->{/if}
{/foreach}
{*
	Hier endet der Block
*}
{if (count($styles) > 0)}
<style>
<!--
{foreach $styles as $style}
{$style}
{/foreach}
-->
</style>
{/if}
{if $googleanalytics!==''}
		<!-- START-NGCON [googleanalytics] -->
		<script>
		/* <![CDATA[ */

		(function(i,s,o,g,r,a,m){ i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', '{$googleanalytics|escape}');  
{if $googleanalyticsanonip}
		ga('set', 'anonymizeIp', true);
{/if}
		ga('send', 'pageview');   
				
		/* ]]> */
		</script>
		<!-- END-NGCON -->
{/if}
{if isset($htmlcode['head'])}{$htmlcode['head']}{/if}		
	</head>
	<body>
{if isset($htmlcode['bodytop'])}{$htmlcode['bodytop']}{/if}
