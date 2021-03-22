<table class="ngparafoodmenu">
    {foreach $items as $item}
        <tr>
            <td><p class="ngparafoodmenuheading">{$item->caption|escape}</p></td>
            <td><p class="ngparafoodmenuprice">{$item->price|escape}</p></td>
        </tr>
        {if isset($item->summary)}
        <tr>
            <td colspan="2">{$item->summary}</td>
        </tr>
        {/if}
        {if isset($item->picture)}
            <tr>
                <td colspan="2"><a data-nggroup="{$id}" title="{$item->caption|escape}" href="{$item->fullpicture|escape}" class="gallery"><img src="{$item->picture|escape}" width="{$item->size->width}" height="{$item->size->height}" alt="{$item->alt}" /></a></td>
            </tr>
        {/if}
    {/foreach}
</table>