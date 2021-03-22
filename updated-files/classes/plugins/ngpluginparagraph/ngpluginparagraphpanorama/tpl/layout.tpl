<div class="ngpluginparagraphpanorama" id="ngpluginparagraphpanorama{$uid}"{if isset($bgolcor)} style="background-color: {$bgcolor}"{/if}>
<img class="ngpluginparagraphpanoramaimage{if isset($lazyload)} nglazyload{/if}" {if isset($lazyload)}data-src="{$source|escape}" src="{$lazyload|escape}" {else}src="{$source|escape}"{/if} width="{$width}" height="{$height}" alt="{$alt}" />
{if isset($fade)}<img class="ngpluginparagraphpanoramafade" src="{$fade|escape}" alt="" width="100" height="100" />{/if}
<div class="ngpluginparagraphpanorama{$position} sqrmobileboxed">
{if $caption!==''}<h3>{$caption}</h3>{/if}
{$summary}
</div>
</div>