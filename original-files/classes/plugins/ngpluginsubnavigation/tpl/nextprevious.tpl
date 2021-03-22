<p class='ngsubnavnextprevious'>
{if $previous!==''}
<a href="{$previous}">« {$lang['previous']->value}</a>
{/if}
{if $next!==''}
<a href="{$next}">{$lang['next']->value} »</a>
{/if}
</p>