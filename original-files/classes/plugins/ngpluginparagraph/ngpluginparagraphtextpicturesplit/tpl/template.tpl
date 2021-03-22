<div class="ngparatextpicturesplit ngparatextpicturesplit{$pictureposition}" data-heightmode="{$heightmode}" data-parallax="{$parallax}" {if $colorbackground!==''}style="background-color: #{$colorbackground}"{/if}>

<div class="ngparatextpicturesplitpicture">

{if $link!=''}
<a title="{$alt|escape}" href="{$link|escape}"{if isset($linkclass)} class="{$linkclass}"{/if}{if isset($linktarget)} target="{$linktarget}"{/if}>
{/if}

<img alt="{$alt|escape}" {if ($title!=='')}title="{$title|escape}"{/if} {if isset($lazyload)}data-src="{$source|escape}" src="{$lazyload|escape}" {else}src="{$source|escape}"{/if} class="picture{if isset($lazyload)} nglazyload{/if}" {if isset($sourcehd)} data-src-hd="{$sourcehd|escape}"{/if} width="{$width}" height="{$height}" />

{if $link!=''}
</a>
{/if}

</div>

<div class="ngparatextpicturesplittext" style="color: #{$colorforeground}">
<div style="padding: {$textpadding}"{if $fadeeffect!==''} class="ngparatextpicturesplitfx{$fadeeffect}"{/if}>{$text}{if isset($watermark)}<img src="{$watermark}" alt="" />{/if}</div>
</div>


</div>