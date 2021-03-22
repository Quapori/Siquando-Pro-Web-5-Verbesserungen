<div class="ngparaconsent">
    <ul>
        {foreach $items as $item}
            <li>
                <div>
                    <h3>{$item->caption|escape}</h3>
                    {if $item->essential}
                        <div class="ngparaconsenttoggleconsent">

                            <span class="ngparaconsentlabelessential">{$lang['essential']->value|escape}</span>
                            <div>
                                <div></div>
                            </div>
                        </div>
                    {else}
                        <a class="ngparaconsenttoggleconsent" href="#" data-id="{$item->id|escape}">
                            <span class="ngparaconsentlabelactive">{$lang['on']->value|escape}</span>
                            <span class="ngparaconsentlabelnotactive">{$lang['off']->value|escape}</span>
                            <div>
                                <div></div>
                            </div>
                        </a>
                    {/if}
                </div>
                {$item->summary}
            </li>
        {/foreach}
    </ul>
    {if $nonessential}
        <div>
            <button class="ngparaconsentnone">{$lang['none']->value|escape}</button>
            <button class="ngparaconsentall">{$lang['all']->value|escape}</button>
        </div>
    {/if}
</div>