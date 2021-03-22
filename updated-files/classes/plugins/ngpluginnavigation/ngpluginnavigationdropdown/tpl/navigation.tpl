<ul class="ngpluginnavigationdropdown"{if $sound!=''} data-sound="{$sound}"{/if}{if $animate} data-animate="animate"{/if}>
{if isset($logosource)}
	<li class="logo">
		<a href="{$logolink|escape}"><img src="{$logosource|escape}" alt="" /></a>
	</li>
{/if}
	{$nav}
</ul>
{if isset($search)}
<form action="{$search|escape}"  >
	<input placeholder="{$langsearch['searchfor']->value|escape}" type="text" name="criteria"  />
	<button type="submit"></button>
</form>
{/if}