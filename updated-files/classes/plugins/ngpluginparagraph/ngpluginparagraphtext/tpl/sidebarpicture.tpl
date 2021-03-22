{if $sidebarpicturesource!=''}

{if $sidebarpicturelink!=''}
<a {if ($sidebarpicturetitle!=='')}title="{$sidebarpicturetitle|escape}"{/if} href="{$sidebarpicturelink|escape}"{if isset($sidebarpicturelinkclass)} class="{$sidebarpicturelinkclass}"{/if}{if isset($sidebarpicturelinktarget)} target="{$sidebarpicturelinktarget}"{/if}>
{/if}

<img {if ($sidebarpicturetitle!=='')}title="{$sidebarpicturetitle|escape}"{/if} alt="{$sidebarpicturealt|escape}" {if isset($lazyload)}data-src="{$sidebarpicturesource|escape}" src="{$lazyload|escape}" {else}src="{$sidebarpicturesource|escape}"{/if} {if isset($sidebarpicturesourcehd)} data-src-hd="{$sidebarpicturesourcehd|escape}"{/if} class="picture{if isset($lazyload)} nglazyload{/if}" {if $responsive} width="{$sidebarpicturewidth}" height="{$sidebarpictureheight}" style="width:100%;height:auto;" {else}style="width:{$sidebarpicturewidth}px;height:{$sidebarpictureheight}px;"{/if}/>

{if $sidebarpicturelink!=''}
</a>
{/if}

{if $sidebarpicturecaption != ''}
<h3>{$sidebarpicturecaption}</h3>
{/if}
{if $sidebarpicturesummary != ''}
{$sidebarpicturesummary}
{/if}

{/if}