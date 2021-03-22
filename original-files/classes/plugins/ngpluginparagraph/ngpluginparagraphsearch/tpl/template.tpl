{if $searchfield}
<form action="{$self|escape}" class="parasearch" >
<input type="text" name="criteria" placeholder="{$lang['searchfor']->value|escape}" value="{$fts->criteria|escape}" {if !$responsive}style="width: {$width-36}px"{/if} />
<button type="submit" class="search_btn" style="background: url({$picture}) no-repeat;"></button>
</form>
{/if}

{if count($fts->result)>0}
{foreach $fts->result as $result}

<p class="parasearchresult"><a href="{$result->url|escape}">{$result->caption|escape}</a></p>

{if $result->pictureURL!==''}<a href="{$result->url|escape}"><img src="{$result->pictureURL|escape}" class="searchimage" alt="{$result->caption|escape}" style="width:{$picturewidth}px;border:{$borderwidth}px solid #{$bordercolor}" /></a>{/if}
<p>{$result->summary}</p>
{if $result->pictureURL!==''}<div class="clearfix"></div>{/if}
{/foreach}
{else}
{if $fts->criteria===''}
<p>{$lang['noquery']->value|escape}</p>
{else}
{if strlen($fts->criteria)>3}
<p>{$lang['nomatches']->value|escape}</p>
{else}
<p>{$lang['tooshort']->value|escape}</p>
{/if}
{/if} 
{/if}

{if isset($subpages)}
<p class="parasearchpagination">
{foreach $subpages as $subpage}
<a{if $subpage->iscurrent} class="parasearchcurrent"{/if} href="{$subpage->url}">{$subpage->caption}</a>
{/foreach}
</p>
{/if}
