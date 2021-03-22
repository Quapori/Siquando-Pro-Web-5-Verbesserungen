{if isset($htmlcode['bodybottom'])}{$htmlcode['bodybottom']}{/if}
{if isset($cookiewarning)}
<div class="ngcookiewarning {if $cookiewarningtop}ngcookiewarningtop{else}ngcookiewarningbottom{/if}">
{$cookiewarning}
	<button class="ngcookiewarningaccept">{$lang['accept']->value}</button>
	<button class="ngcookiewarningdecline">{$lang['decline']->value}</button>
</div>
{/if}
{if isset($topicmp3) || isset($topicogg)}
		<audio style="display:none" autoplay="autoplay">
{if isset($topicmp3)}
  			<source src="{$topicmp3|escape}" type="audio/mpeg">
{/if}
{if isset($topicogg)}
  			<source src="{$topicogg|escape}" type="audio/ogg">
{/if}
		</audio>
{/if}
	</body>
</html>	