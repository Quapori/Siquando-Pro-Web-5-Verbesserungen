<div class="ngparasfxgallery" data-zoom="{$zoom}">
    <div style="background-color:#{$fadecolor}">
        {foreach $pictures as $picture}
            <div style="background-image: url({$picture|escape})"></div>
        {/foreach}
    </div>
</div>