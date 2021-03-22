{if $changesuccess!==''}
<p>
{$changesuccess|escape}
</p>

{else}

<form action="{$action}" class="nglogin" method="post" enctype="application/x-www-form-urlencoded">

<p>
{$lang['changepasswordhelp']->value|escape}
</p>

{if $changeerror!==''}
<div class="ngloginerror">
{$changeerror}
</div>
{/if}


<div class="clearfix">
<label>{$lang['loginname']->value|escape}:</label>
<input required="required" type="email" name="nglogin" value="{$nglogin}" />
</div>

<div class="clearfix">
<label>{$lang['oldpassword']->value|escape}:</label>
<input type="password" name="ngpassword" required="required"/>
</div>

<div class="clearfix">
<label>{$lang['newpassword']->value|escape}:</label>
<input type="password" name="ngnewpassword" required="required"/>
</div>

<div class="clearfix">
<label>{$lang['passwordrepeat']->value|escape}:</label>
<input type="password" name="ngpasswordrepeat" required="required"/>
</div>


<input type="submit" value="{$lang['buttonchangepassword']->value|escape}" />

<div class="clearfix"></div>

</form>

{/if}

<p>
<a href="{$backtologinlink|escape}">{$lang['backtologin']->value|escape}</a>
</p>