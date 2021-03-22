{if $loginsuccess}
<p>
{$lang['loginsuccess']->value|escape}
</p>
{else}

<form action="{$action|escape}" class="nglogin" method="post" enctype="application/x-www-form-urlencoded">

{if $loginerror}
<div class="ngloginerror">
{$lang['loginerror']->value|escape}
</div>
{/if}



<div class="clearfix">
<label>{$lang['loginname']->value|escape}:</label>
<input required="required" type="email" name="nglogin" value="{$nglogin}" />
</div>

<div class="clearfix">
<label>{$lang['password']->value|escape}:</label>
<input type="password" name="ngpassword" required="required"/>
</div>

<input type="submit" value="{$lang['buttonlogin']->value|escape}" />

<div class="clearfix"></div>

</form>
{/if}

{if $forgotpassword}
<p>
<a href="{$forgotpasswordlink|escape}">{$lang['forgotpassword']->value|escape}</a>
</p>
{/if}

{if $changepassword}
<p>
<a href="{$changepasswordlink|escape}">{$lang['changepassword']->value|escape}</a>
</p>
{/if}


{if $createaccount}
<p>
<a href="{$createaccountlink|escape}">{$lang['createaccount']->value|escape}</a>
</p>
{/if}
