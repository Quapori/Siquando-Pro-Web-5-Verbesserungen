{if $forgotsuccess!==''}
<p>
{$forgotsuccess|escape}
</p>

{else}

<form action="{$action}" class="nglogin" method="post" enctype="application/x-www-form-urlencoded">

<p>
{$lang['forgotpasswordhelp']->value|escape}
</p>


<div class="clearfix">
<label >{$lang['loginname']->value|escape}:</label>
<input required="required" type="email" name="nglogin" value="{$nglogin}" />
</div>

<input type="submit" value="{$lang['buttonforgotpassword']->value|escape}" />

<div class="clearfix"></div>

</form>

{/if}

<p>
<a href="{$backtologinlink|escape}">{$lang['backtologin']->value|escape}</a>
</p>