<ul class="ngpluginnavigationflyout"{if $sound!=''} data-sound="{$sound}"{/if}>
{if isset($logosource)}
	<li class="logo">
		<a href="{$logolink|escape}"><img src="{$logosource|escape}" alt="" /></a>
	</li>
{/if}
	{$nav}
</ul>