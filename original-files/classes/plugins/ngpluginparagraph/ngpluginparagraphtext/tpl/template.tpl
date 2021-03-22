{if $sidebarmode!=='None'}
<div class="paragraphsidebar{$sidebarplacement} {if isset($sidebarwidthclass)}paragraphsidebar{$sidebarwidthclass}{/if}" {if isset($widthsidebar)}style="width: {$widthsidebar}px"{/if}>
{$sidebar}
</div>
{/if}



{if $sidebarmode!=='None' && !$sidebarflow}
<div {if isset($sidebarwidthclass)} class="paragraphcontent{if $sidebarplacement=='left'}indent{/if}sidebar{$sidebarwidthclass}"{/if} style="{if isset($widthcontent)}width:{$widthcontent}px;{if $sidebarplacement=='left'}margin-left: {$widthsidebar+$gutter}px;{/if}{/if}">
{/if}

{$text}

{if $sidebarmode!=='None' && !$sidebarflow}
</div>
{/if}

<div class="clearfix"></div>
