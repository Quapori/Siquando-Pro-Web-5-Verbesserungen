<p>
{foreach $items as $item}
{if $item@index>0}{if $separator=='bullet'}&bull;{/if}{if $separator=='pipe'}|{/if}{/if}
	<a {if $lightbox}class="galleryiframe"{/if} href="{$item->link|escape}">{$item->caption}</a>
{/foreach}
</p>