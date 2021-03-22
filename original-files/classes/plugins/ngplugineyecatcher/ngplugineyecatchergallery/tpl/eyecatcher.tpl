<div data-changeeffect="{$settings[2]}" data-autochangedelay="{$settings[3]}">
{if count($pictures)>0} 
<ul>
{foreach $pictures as $picture}
<li>
{if ($picture['link']!==null)}
<a href="{$picture['link']->getUrl()|escape}"{if ($picture['link']->linkType == NGLink::LinkPagePopup || $picture['link']->linkType == NGLink::LinkTopicPopup)} class="galleryiframe"{/if}{if $picture['link']->linkType == NGLink::LinkPicture} class="gallery"{/if}{if $picture['link']->linkType == NGLink::LinkWWW} target="_blank"{/if}>
{/if}
<img src="{$picture['source']|escape}" alt="{$picture['alt']|escape}"  />
{if ($picture['link']!==null)}
</a>
{/if}
</li>
{/foreach}
</ul>

{if $settings[4]=='Bullets'}
<div id="eyecatcherbullets">
{foreach $pictures as $picture}
<div></div>
{/foreach}
</div>
{else}
<div id="eyecatcherprev"></div>
<div id="eyecatchernext"></div>
{/if}
{/if}
</div>