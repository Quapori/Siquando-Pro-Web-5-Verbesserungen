<ul class="ngcontent ngparatoc" style="list-style: url({$bullet|escape})">
    {foreach $items as $item}
    <li>
        <a href="#{$item->anchor}">{$item->caption|escape}</a>
    </li>
    {/foreach}
</ul>