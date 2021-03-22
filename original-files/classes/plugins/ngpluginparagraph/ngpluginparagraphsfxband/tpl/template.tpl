<div class="ngparasfxband" data-size="{$size}" data-effect="{$effect}" data-gutter="{$gutter}" data-inertia="{$inertia}">
    <div>
        {foreach $pictures as $picture}
        <img src="{$picture->source|escape}" alt="{$picture->alt|escape}" width="{$picture->size->width}" height="{$picture->size->height}" />
        {/foreach}
    </div>
</div>