<div id="{$id}" class="ngslideshow" data-cropmain="{$cropratiomain}" data-cropthumbs="{$cropratiothumbs}" data-ngnavigationstyle="{$navigationstyle}" data-ngautochangedelay="{$autochangedelay}" data-changeeffect="{$changeeffect}">
<div class="ngslideshowstage {if $navigationalignment=='Left'}ngslideshowrightpad{else}ngslideshowleftpad{/if}">
{if $showcaptions}
<div class="ngslideshowcaptions {if $colorschemecaption=='Light'}ngslideshowcaptionslight{else}ngslideshowcaptionsdark{/if}"></div>
{/if}
<div class="ngslideshowcontainer">
{foreach $pictures as $picture}
<a title="{$picture->caption|escape}" id="{$picture->anchor}" href="{$picture->link->getUrl()|escape}"{if $picture->link->linkType == NGLink::LinkPicture} class="gallery" data-nggroup="{$id}"{/if}{if ($picture->link->linkType == NGLink::LinkPagePopup || $picture->link->linkType == NGLink::LinkTopicPopup)} class="galleryiframe"{/if}{if $picture->link->linkType == NGLink::LinkWWW} target="_blank"{/if} style="{if $changeeffect=='Slide'}left: {$picture->leftStage}px{else}{if !$picture@first}display:none{/if}{/if}">
<img {if isset($picture->sourcehd)} src="{$trans|escape}" data-src="{$picture->source|escape}" data-src-hd="{$picture->sourcehd|escape}" {else} src="{$picture->source|escape}" {/if} alt="{$picture->alt|escape}" />
</a>
{/foreach}
</div>
</div>
{if $navigationstyle=='Thumbnail'}
<div class="ngslideshowthumbnail {if $navigationalignment=='Left'}ngslideshowleft{else}ngslideshowright{/if}">
{foreach $pictures as $picture}
<a href="#{$picture->anchor}" {if $picture@first} class="ngslideshowselected"{/if}><img alt="{$picture->alt|escape}" src="{$picture->sourceThumbnail|escape}" /><div class="ngslideshowthumbnailmarker"></div></a>
{/foreach}
</div>
{/if}
{if $navigationstyle=='Caption'}
<div class="ngslideshowcaption {if $navigationalignment=='Left'}ngslideshowleft{else}ngslideshowright{/if}">
{foreach $pictures as $picture}
<a href="#{$picture->anchor}" {if $picture@first} class="ngslideshowselected"{/if}><em>{$picture->caption}</em></a>
{/foreach}
</div>
{/if}
{if $navigationstyle=='Bullet'}
<div class="ngslideshowbullet {if $navigationalignment=='Left'}ngslideshowleftbullet{else}ngslideshowrightbullet{/if}">
{foreach $pictures as $picture}
<a href="#{$picture->anchor}" style="left: {$picture->leftBullet}px"{if $picture@first} class="ngslideshowselected"{/if}></a>
{/foreach}
</div>
{/if}
{if $navigationstyle=='PrevNext'}
<a class="ngslideshowprev" href="#"></a>
<a class="ngslideshownext" href="#"></a>
{/if}
</div>