<div id="ngimagemap{$uid}" class="ngimagemap">

<img alt="{$alt|escape}" {if ($title!=='')}title="{$title|escape}"{/if} src="{$source|escape}" width="{$width}" height="{$height}" />

{foreach $items as $item}
{if $item->linkuid!=='' && $item->popupmode!==NGImageMapStageItem::PopupModeClick}
<a title="{$item->linktitle|escape}" href="{$item->getLinkUrl()|escape}"{if ($item->getLinkClass()!=='')} class="{$item->getLinkClass()}"{/if}{if ($item->getLinkTarget()!=='')} target="{$item->getLinkTarget()}"{/if}>
{/if}
<div data-type="{$item->type}" data-offsetx="{$item->offsetx}" data-offsety="{$item->offsety}" data-left="{$item->left}" data-top="{$item->top}" data-width="{$item->width}" data-height="{$item->height}" id="ngimagemapi{$uid}{$item@index}" data-popupposition="{$item->popupposition}" data-popupmode="{$item->popupmode}" class="ngimagemapi{if $item->type == NGImageMapStageItem::TypePin && $item->hidepin} ngimagemaph{/if}"></div>
{if $item->linkuid!=='' && $item->popupmode!==NGImageMapStageItem::PopupModeClick}
</a>
{/if}

{if $item->getPopupVisible()}
<div id="ngimagemapp{$uid}{$item@index}" class="ngimagemapp">
{if ($item->pictureuid!=='')}
<img alt="{$item->getPictureAlt()|escape}" {if ($item->getPictureTitle()!=='')}title="{$item->getPictureTitle()|escape}"{/if} src="{$item->getPictureSource()|escape}" style="width:{$item->getPictureWidth()}px;height:{$item->getPictureHeight()}px" />
{/if}
{$item->getPopupText()}
{if $item->arrow}
<div id="ngimagemapa{$uid}{$item@index}" class="ngimagemapa"></div>
{/if}
</div>
{/if}

{if ($item->getOggSrc()!=='' || $item->getMP3Src()!=='')}

<audio id="ngimagemaps{$uid}{$item@index}" class="ngimagemaps">
{if $item->getOggSrc()!==''}
  <source src="{$item->getOggSrc()|escape}" type="audio/ogg">
{/if}
{if $item->getMP3Src()!==''}
  <source src="{$item->getMP3Src()|escape}" type="audio/mpeg">
{/if}
</audio>

{/if}

{/foreach}

</div>