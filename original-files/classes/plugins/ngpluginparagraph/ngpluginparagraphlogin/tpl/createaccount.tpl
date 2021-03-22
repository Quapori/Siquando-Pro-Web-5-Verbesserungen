{if $createsuccess!==''}
<p>
{$createsuccess|escape}
</p>

{else}

<form action="{$action}" class="nglogin" method="post" enctype="application/x-www-form-urlencoded">

{if $sendpassword}
<p>
{$lang['createaccountsendhelp']->value|escape}
</p>
{else}
<p>
{$lang['createaccounthelp']->value|escape}
</p>
{/if}


{if $createerror!==''}
<div class="ngloginerror">
{$createerror}
</div>
{/if}

<div class="clearfix">
<label>{$lang['loginname']->value|escape}:</label>
<input required="required" type="email" name="nglogin" value="{$nglogin}" />
</div>

{if !$sendpassword}

<div class="clearfix">
<label>{$lang['password']->value|escape}:</label>
<input type="password" name="ngpassword" required="required"/>
</div>

<div class="clearfix">
<label>{$lang['passwordrepeat']->value|escape}:</label>
<input type="password" name="ngpasswordrepeat" required="required"/>
</div>
{/if}

{if isset($privacytext)}
<div class="clearfix ngcontent ngloginconsent">
<div>
<input type="hidden" name="privacymustconsent" value="privacymustconsent" />
<input name="privacyconsent" type="checkbox" value="privacyconsent" /> {$privacytext}
</div>
</div>
{/if}

<input type="submit" value="{$lang['buttoncreateaccount']->value|escape}" />

<div class="clearfix"></div>

</form>

{/if}

<p>
<a href="{$backtologinlink|escape}">{$lang['backtologin']->value|escape}</a>
</p>
