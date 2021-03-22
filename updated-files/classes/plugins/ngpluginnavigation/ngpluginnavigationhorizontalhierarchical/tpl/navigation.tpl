<ul>
	{$nav}
</ul>
{if isset($search)}
<form action="{$search|escape}"  >
	<input placeholder="{$langsearch['searchfor']->value|escape}" type="text" name="criteria"  />
	<button type="submit"></button>
</form>
{/if}