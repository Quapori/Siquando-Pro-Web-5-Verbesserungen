<div class="ngfullscreenslides" data-autoplay="{$autoplay}" id="{$id}" data-hidenavigation="{$hidenavigation}" data-fullscreen="{$fullscreen}">

<div class="ngfullscreenslidesstage" style="background-color: #{$picturebackgroundcolor}">

<img src="{$trans|escape}" alt="" />

<div class="ngfullscreenslidesnav ngfullscreenslideshide" style="background-color: rgba({$navigationbackgroundcolorr},{$navigationbackgroundcolorg},{$navigationbackgroundcolorb},0.8)">
<div class="ngfullscreenslidesnavright">
{foreach $pictures as $picture}
<div class="ngfullscreenslidesnavbutton"  style="background-image: url({$sprites})" data-href="{$picture->source|escape}" {if $captions!=='None'}data-caption="{$picture->caption|escape}"{/if}>
<img src="{$picture->thumb|escape}" alt="" style="border-color: rgba({$navigationbackgroundcolorr},{$navigationbackgroundcolorg},{$navigationbackgroundcolorb},0.8); width:{$picture->thumbWidth}px;height:{$picture->thumbHeight}px" />
</div>
{/foreach}
</div>
<div class="ngfullscreenslidesnavleft">
<div class="ngfullscreenslidesplay"  style="background-image: url({$sprites})"></div>
{if isset($mp3) || isset($ogg)}
<div class="ngfullscreenslidesaudio"  style="background-image: url({$sprites})"></div>
{/if}
<div class="ngfullscreenslidesfullscreen"  style="background-image: url({$sprites})"></div>

</div>
</div>

<div class="ngfullscreenslidesprev ngfullscreenslideshide" style="background-image: url({$sprites})"></div>
<div class="ngfullscreenslidesnext ngfullscreenslideshide" style="background-image: url({$sprites})"></div>
<div class="ngfullscreenslidesclose ngfullscreenslideshide" style="background-image: url({$sprites})"></div>
{if $captions!=='None'}
<h1 class="ngfullscreencaptions{$captions|lower}"{if $captionsize!==-1} style="font-size:{$captionsize}px"{/if}>&nbsp;</h1>
{/if}

</div>

{if isset($mp3) || isset($ogg) }
<audio loop="loop">
{if isset($mp3)}
  <source src="{$mp3|escape}" type="audio/mpeg">
{/if}
{if isset($ogg)}
  <source src="{$ogg|escape}" type="audio/ogg">
{/if}
</audio>
{/if}

{if isset($poster)}
<div class="ngfullscreenslidesposter">
<img src="{$poster|escape}" alt="{$textstart|escape}" width="{$posterwidth}" height="{$posterheight}" />
<div style="background-image: url({$play})"></div>
</div>
{else}
<div style="text-align: {$buttonorientation|lower}">
<span class="ngfullscreenslidesstart">{$textstart|escape}</span>
</div>
{/if}

</div>