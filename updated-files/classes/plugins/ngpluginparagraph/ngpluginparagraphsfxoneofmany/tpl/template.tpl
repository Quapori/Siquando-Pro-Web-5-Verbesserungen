<div class="ngparasfxoneofmany" data-effect="{$shift}" data-ratio="{$ratio}" data-padding="{$spacing}">
    <div>
        {foreach $columns as $column}
            <div class="ngparasfxoneofmanycolumn{$column->priority}">
                {foreach $column->pictures as $picture}
                    <img src="{$picture->source|escape}" width="{$picture->size->width}" height="{$picture->size->height}"
                         alt="{$picture->alt|escape}" class="ngparasfxoneofmanyimg{$picture->priority}" {if $radius>0}style="border-radius:{$radius}px"{/if} />
                {/foreach}
            </div>
        {/foreach}
    </div>
</div>