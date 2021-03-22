<ul class="ngpluginnavigationsuperdropdown"{if $sound!=''} data-sound="{$sound}"{/if}{if $animate} data-animate="animate"{/if}>
	{foreach $root->children as $primary}
	<li class="{if $primary@index > 3}ar{/if}{if $primary->objectUID==$activeUID } active{/if}" ><a href="{$primary->fullURL($preview)}">{$primary->caption}</a>
	
	{if count($primary->children)>0}
	<div>
	
	<ul>
	{foreach $primary->children as $secondary}
	<li><a href="{$secondary->fullURL($preview)}">{$secondary->caption}</a>
	{/foreach}
	</ul>
		
	<a class="ngsuperdropdownimage" href="{$primary->fullURL($preview)}">{if ($primary->picture!=='')}<img src="{$primary->pictureSource(200,-1,$crop)}" alt="" />{else}<div class="ngsuperdropdownnoimage"></div>{/if}</a>
	
	<div class="ngsuperdropdownsummary">
	
	<div class="ngsuperdropdropheadline">{$primary->caption}</div>
	
	{$primary->summary}
		
	</div>
	
	<div class="clearfix"></div>
	
	</div>
	
	{/if}
	</li>
	{/foreach}
</ul>
{if isset($search)}
<form action="{$search|escape}"  >
	<input placeholder="{$langsearch['searchfor']->value|escape}" type="text" name="criteria"  />
	<button type="submit"></button>
</form>
{/if}