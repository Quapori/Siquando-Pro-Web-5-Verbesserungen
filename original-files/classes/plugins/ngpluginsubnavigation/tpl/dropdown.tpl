<p class='ngsubnavdropdown'>
<select>
{foreach $items as $item}
<option {if $item->item->objectUID==$current} selected{/if} value={$item->displayLink()->getURL()}>{$item->displayCaption()}</option>
{/foreach}
</select>
</p>