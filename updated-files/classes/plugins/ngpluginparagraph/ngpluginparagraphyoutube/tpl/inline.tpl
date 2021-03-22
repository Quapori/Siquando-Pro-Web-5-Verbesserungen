<!-- START-NGCON-MSG [youtube] -->
{if $responsive}
<div style="position: relative;padding-bottom: {$ratio}%;height: 0;overflow: hidden;">
{/if}
<iframe width="{$width}" height="{$height}" src="{$url|escape}" frameborder="0" allowfullscreen="allowfullscreen" style="border:none;{if $responsive}position: absolute;top: 0;left: 0;width: 100%;height: 100%;{/if}" ></iframe>
{if $responsive}
</div>
{/if}
<!-- END-NGCON -->