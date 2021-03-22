<div class="sqrfactpano{if $animation!==''} sqrfactpanoanimation{$animation}{/if}" id="sqrfactpano{$uid}" data-sqrfactpanpparallax="{$parallax}">
<div class="sqrfactpanostage{if $animation!==''} sqrfactpanofadein{/if}">
{if $subcaption!==''}<h2>{$subcaption|escape}</h2>{/if}
{$text}
{if count($items)>0}
<div class="sqrfactpanoitems">
{foreach $items as $item}
<a href="{$item->linkurl|escape}"{if isset($item->linkclass)} class="{$item->linkclass}"{/if}{if isset($item->linktarget)} target="{$item->linktarget}"{/if}>{$item->caption}{if isset($item->icon)}<img src="{$item->icon|escape}" width="32" height="32" alt="" />{/if}</a>
{/foreach}
</div>
{/if}
</div>
<div class="sqrfactpanoback">

{if isset($mp4) || isset($ogg) || isset($webm)}
<video class="sqrfactpanoimg" width="1920" height="1080" muted="muted" autoplay="autoplay" loop="loop" playsinline="playsinline"{if isset($picturesrc)} poster="{$picturesrc|escape}"{/if}>
{if isset($mp4)}
  <source src="{$mp4}" type="video/mp4" />
{/if}
{if isset($ogg)}
  <source src="{$ogg}" type="video/ogg" />
{/if}
{if isset($webm)}
  <source src="{$webm}" type="video/webm" />
{/if}
</video>
{else}
{if isset($picturesrc)}
<img class="sqrfactpanoimg" src="{$picturesrc|escape}" width="{$picturesize->width}" height="{$picturesize->height}" alt="" />
{/if}
{/if}
<div class="sqrfactpanooverlay"></div>
</div>
</div>