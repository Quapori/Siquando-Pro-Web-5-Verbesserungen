<div style="position: relative">

{if isset($buttonsource)}
{if $link!=''}
<a title="{$alt|escape}" href="{$link|escape}"{if isset($linkclass)} class="{$linkclass}"{/if}{if isset($linktarget)} target="{$linktarget}"{/if}>
{/if}
{if $responsive}
<img alt="" src="{$buttonsource|escape}" width="{$buttonwidth}" height="{$buttonheight}" style="max-width:25%;height:auto;position: absolute; border:0; {$offset}" class="sqrmobilehidden"/>
{else}
<img alt="" src="{$buttonsource|escape}" style="position: absolute; border:0; {$offset}; width:{$buttonwidth}px;height:{$buttonheight}px;"/>
{/if}
{if $link!=''}
</a>
{/if}
{/if}

{if $link!=''}
<a title="{$alt|escape}" href="{$link|escape}"{if isset($linkclass)} class="{$linkclass}"{/if}{if isset($linktarget)} target="{$linktarget}"{/if}>
{/if}

<img alt="{$alt|escape}" {if ($title!=='')}title="{$title|escape}"{/if} {if isset($lazyload)}data-src="{$source|escape}" src="{$lazyload|escape}" {else}src="{$source|escape}"{/if} class="picture{if isset($lazyload)} nglazyload{/if}" {if isset($sourcehd)} data-src-hd="{$sourcehd|escape}"{/if} {if $responsive} width="{$width}" height="{$height}" style="width:100%;height:auto;" {else}style="width:{$width}px;height:{$height}px;"{/if}/>

{if $link!=''}
</a>
{/if}

{if $responsive}
<div class="sqrmobileboxed">
{/if}

{if $caption != ''}
<h3>{$caption}</h3>
{/if}
{$summary}

{if $responsive}
</div>
{/if}


</div>