<!DOCTYPE html>

<html{if (array_key_exists('w2dng.lang', $metatags))} lang="{$metatags['w2dng.lang']}"{/if}>
	<head>
		<title>{$settings->caption|escape}</title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
{foreach $metatags as $id => $value}
    {if substr($id,0,6)!=='w2dng.'}
        {if substr($id,0,3)=='og:'}
		<meta property="{$id|escape}" content="{$value|escape}" />
		{else}
		<meta name="{$id|escape}" content="{$value|escape}" />
		{/if}
    {/if}
{/foreach}
{if isset($favicon)}
		<link rel="icon" href="{$favicon|escape}" type="image/png" />
{/if}
{if isset($touchicons)}
	{foreach $touchicons as $size => $url}
		<link rel="apple-touch-icon{if $touchiconprecomposed}-precomposed{/if}" {if $size!==''}sizes="{$size}" {/if}href="{$url}" />
	{/foreach}
{/if}
{foreach $fonts as $font}
		<link rel="stylesheet" href="{$fontspath}{$font}.css" />
{/foreach}		
		<style>
			body {
				background-color: #{$settings->background};
				margin: 0;
				padding: 40px;
			}		
			div {
				margin: 0 auto;
				max-width: 800px;
				width: 100%;
			}
{if isset($picturesource)}
			img {
				width: 100%;
				height: auto;
				display: block;
			}
{/if}
			h1 {
				color: #{$settings->captionfontcolor};
				font-family: {$captionfontfamily};
				font-size: {$settings->captionfontsize}px;
				font-weight: {if ($settings->captionbold)}bold{else}normal{/if};
				font-style: {if ($settings->captionitalic)}italic{else}normal{/if};
				text-align: center;
				margin: 16px 0;
			}
			p {
				color: #{$settings->summaryfontcolor};
				font-family: {$summaryfontfamily};
				font-size: {$settings->summaryfontsize}px;
				font-weight: {if ($settings->summarybold)}bold{else}normal{/if};
				font-style: {if ($settings->summaryitalic)}italic{else}normal{/if};
				text-align: center;
				line-height: 1.6;
				margin: 16px 0;
			}

			@media (max-width: 767px) {
				body {
					padding: 20px;
				}
			}
		</style>
	</head>
	<body>	
		<div>
{if isset($picturesource)}
			<img src="{$picturesource|escape}" alt="" height="{$pictureheight}" width="{$picturewidth}" />
{/if}
{if $settings->caption!==''}
			<h1>{$settings->caption|escape}</h1>
{/if}		
{if $settings->summary!==''}
			<p>{$settings->summary|escape|nl2br}</p>
{/if}		
		</div>
	</body>
</html>