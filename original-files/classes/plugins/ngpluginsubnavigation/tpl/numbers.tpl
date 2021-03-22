<p class='ngsubnavnumbers'>
{foreach $items as $item}
{if $item->item->objectUID==$current}<b>{/if} 
<a href="{$item->displayLink()->getURL()}">{$item@index+1}</a>
{if $item->item->objectUID==$current}</b>{/if}
{/foreach}
</p>