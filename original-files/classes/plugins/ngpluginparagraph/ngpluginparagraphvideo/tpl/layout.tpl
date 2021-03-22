{if $popup}
<a href="#" class="galleryelement" data-element="<video {if isset($poster)}poster='{$poster}'{/if} {if $autoplay}autoplay=&quot;autoplay&quot;{/if} width=&quot;{$width}&quot; height=&quot;{$height}&quot; style=&quot;display:block;background-color:black&quot; {if $controls}controls=&quot;controls&quot;{/if} {if $autoplay && !$popup}autoplay=&quot;autoplay&quot;{/if} {if $loop}loop=&quot;loop&quot;{/if}>{if isset($mp4)}<source src=&quot;{$mp4}&quot; type=&quot;video/mp4&quot; />{/if}{if isset($ogg)}<source src=&quot;{$ogg}&quot; type=&quot;video/ogg&quot; />{/if}{if isset($webm)}<source src=&quot;{$webm}&quot; type=&quot;video/webm&quot; />{/if}</video>" data-width="{$width}" data-height="{$height}">

<div style="position:relative">
<img src="{$poster|escape}" width="{$posterwidth}" height="{$posterheight}" alt="" style="display:block;{if $responsive}width:100%;height:auto;{/if}" />
<div style="width:48px;height:48px;background:url({$sourceplay|escape}) no-repeat; left: 50%; top: 50%; position: absolute; margin: -24px"></div>
</div>
</a>
{else}
<video width="{$width}" height="{$height}" style="outline:none;display:block;{if $responsive}box-sizing:border-box;width:100%;height:auto;{/if}" {if $controls}controls="controls"{/if} {if $muted}muted="muted"{/if} {if $autoplay}autoplay="autoplay"{/if} {if $loop}loop="loop"{/if} {if $playsinline}playsinline="playsinline"{/if} {if isset($poster)}poster="{$poster}"{/if}>
{if isset($mp4)}
  <source src="{$mp4}" type="video/mp4" />
{/if}
{if isset($ogg)}
  <source src="{$ogg}" type="video/ogg" />
{/if}
{if isset($webm)}
  <source src="{$webm}" type="video/webm" />
{/if}
{$boilerplate}
</video>
{/if}

