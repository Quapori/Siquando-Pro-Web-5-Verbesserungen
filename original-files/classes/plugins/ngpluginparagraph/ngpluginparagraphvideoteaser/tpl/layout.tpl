<div class="sqpvideoteaser">
<div>
{if isset($link)}
<a href="{$link|escape}"{if isset($linkclass)} class="{$linkclass}"{/if}{if isset($linktarget)} target="{$linktarget}"{/if}>
{/if}
<video width="1920" height="1080" muted="muted" playsinline="playsinline" {if $loop}loop="loop"{/if}>
{if isset($mp4)}
  <source src="{$mp4|escape}" type="video/mp4" />
{/if}
{if isset($ogg)}
  <source src="{$ogg|escape}" type="video/ogg" />
{/if}
{if isset($webm)}
  <source src="{$webm|escape}" type="video/webm" />
{/if}
</video>
{if isset($poster)}
<img width="1920" height="1080" alt="" src="{$poster|escape}" />
{/if}
{if isset($link)}
</a>
{/if}
{if $controls}
<div class="sqpvideoteasertrackouter" style="background-color: rgba({$colorbackground|ngrgb},0.5)">
	<div class="sqpvideoteasertrackinner" style="background-color: rgba({$colorforeground|ngrgb},0.5)"></div>
</div>
{/if}
{if $restart}
<div class="sqpvideoteaserrestart" style="background-image: url({$sprite|escape})"></div>
{/if}
<div class="sqpvideoteasermute" style="background-image: url({$sprite|escape})"></div>
{if $closer}
<div class="sqpvideoteaserclose" style="background-image: url({$sprite|escape})"></div>
{/if}
</div>
</div>