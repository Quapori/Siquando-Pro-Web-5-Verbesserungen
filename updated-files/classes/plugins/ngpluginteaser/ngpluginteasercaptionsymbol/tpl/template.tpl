<ul class="ngteasercaptionsymbol ngteasercaptionsymbola{$align} ngteasercaptionsymbolc{$columns}{if $circle} ngteasercaptionsymbolcircle{/if}"
    id="ngteasercaptionsymbol{$uid}">
    {foreach $items as $item}
        <li><a href="{$item->link->getUrl()|escape}" {if $item->link->linkType == NGLink::LinkPicture} class="gallery"{/if}>{if isset($item->icon)}{$item->icon}{/if}{if isset($item->picturesource)}<img src="{$item->picturesource|escape}" width="64" height="64" class="ngteasercaptionsymbolsymbol" alt="{$item->caption|escape}"/>{/if}{$item->caption}</a></li>
    {/foreach}
</ul>

