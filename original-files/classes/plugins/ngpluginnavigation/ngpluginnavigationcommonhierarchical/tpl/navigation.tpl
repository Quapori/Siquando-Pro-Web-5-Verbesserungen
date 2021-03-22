<ul>
{foreach $topics as $topic}
<li style="width: {$width}px">
<em>{$topic->caption|escape}</em>
<ul>
{foreach $topic->pages as $page}
<li><a {if $lightbox}class="galleryiframe"{/if} href="{$page->link|escape}">{$page->caption|escape}</a></li>
{/foreach}
</ul>
</li>
{/foreach}
</ul>

<div class="clearfix"></div>