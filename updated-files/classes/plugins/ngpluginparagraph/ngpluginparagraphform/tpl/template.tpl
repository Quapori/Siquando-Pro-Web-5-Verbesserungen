{if isset($recaptchapublic)}<!-- START-NGCON-MSG [recaptcha] -->{/if}
<form id="ngform-{$uid}" class="ngform" action="{$action}" method="post" enctype="multipart/form-data">

{if $formerror}
<div class="ngformerror">
{$lang['error']->value|escape}
</div>
{/if}

<div class="ngformcolumns{$columns}">

{foreach $formcolumns as $formcolumn}

{if !$mobile}
<div class="ngformcolumn">
{/if}

{foreach $formcolumn as $formitem}

<div class="clearfix">

{if $formitem->type==='Headline'}
<h3>{$formitem->caption}</h3>
{else if $formitem->type==='Info'}
{$formitem->caption}
{else if $formitem->type==='Spacer'}
    <div class="ngformspacer"></div>
{else if $formitem->type==='Line'}
    <div class="ngformline"><hr /></div>
{else}
<label class="ngformlabel ngformleft{if $formitem->mandatory} ngmandatory{/if}{if $formitem->error} ngerror{/if}"{if $formitem->type!=='Picture'} for="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}"{/if}>{$formitem->caption} {if $formitem->mandatory}*{/if}</label>

{if $formitem->type==='Text'}
<input {if $formitem->mandatory}required="required"{/if} {if isset($formitem->placeholder)}placeholder="{$formitem->placeholder|escape}"{/if} {if isset($formitem->autocomplete)}autocomplete="{$formitem->autocomplete}"{/if} class="ngformright" type="text" value="{$formitem->default|escape}" id="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}" name="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}"/>
{/if}

{if $formitem->type==='Date'}
<input class="ngformright" {if $formitem->mandatory}required="required"{/if} type="date" value="{$formitem->default|escape}" id="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}" name="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}"/>
{/if}

{if $formitem->type==='Time'}
<input class="ngformright" width="10" {if $formitem->mandatory}required="required"{/if} type="time" value="{$formitem->default|escape}" id="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}" name="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}"/>
{/if}

{if $formitem->type==='Email'}
<input {if $formitem->mandatory}required="required"{/if} class="ngformright" type="email" value="{$formitem->default|escape}" id="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}" name="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}"/>
{/if}

{if $formitem->type==='Number'}
<input {if $formitem->mandatory}required="required"{/if} {if isset($formitem->min)}min="{$formitem->min|escape}"{/if} {if isset($formitem->max)}max="{$formitem->max|escape}"{/if} class="ngformright" type="number" value="{$formitem->default|escape}" id="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}" name="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}"/>
{/if}


{if $formitem->type==='CheckBox'}
<label class="ngformright">
<input type="checkbox" {if $formitem->default==='true'}checked="checked"{/if} value="true" id="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}" name="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}" />
{$formitem->valuecaption}
</label>
{/if}

{if $formitem->type==='Consent'}
<label class="ngformright ngcontent">
<input type="checkbox" value="true" id="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}" name="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}" />
{$formitem->valuecaption}
</label>
{/if}

{if $formitem->type==='Picture' && isset($formitem->picturesource)}
<img class="ngformright" src="{$formitem->picturesource|escape}" alt="" width="{$formitem->picturesize->width}" height="{$formitem->picturesize->height}" style="max-width:{$formitem->picturesize->width}px;" />
{/if}

{if $formitem->type==='Password'}
<input class="ngformright" type="password" name="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}" id="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}" />
<label class="ngformlabel ngformleft" for="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}-repeat">{$lang['repeat']->value|escape}</label>
<input class="ngformright" type="password" name="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}-repeat" id="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}-repeat" />
{/if}

{if $formitem->type==='File'}
<input name="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}" class="ngformright" type="file" id="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}"{if isset($formitem->accept)} accept="{$formitem->accept|escape}"{/if}/>
{/if}

{if $formitem->type==='TextArea'}
<textarea name="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}" class="ngformright" id="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}">{$formitem->default|escape}</textarea>
{/if}

{if $formitem->type==='Select'}
<select name="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}" class="ngformright" id="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}" >
{foreach $formitem->options as $option}
<option {if $option->default} selected="selected"{/if}>{$option->caption}</option>
{/foreach}
</select>
{/if}

{if $formitem->type==='Radio'}
<div class="ngformright ngformnopad">
{foreach $formitem->options as $option}
<label class="ngradiogroup">
<input type="radio" value="{$option->caption|escape}" {if $option->default}checked="checked"{/if} name="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}" {if $option@index===0}id="ngform-{$uid}-{$formcolumn@index}-{$formitem@index}"{/if} />
{$option->caption}
</label>
{/foreach}
</div>
{/if}
{/if}
</div>
{/foreach}

{if $formcolumn@last}
{if isset($recaptchapublic)}
<div class="clearfix">
<label class="ngformlabel ngformleft">{$lang['captchalabel']->value|escape}</label>
<div id="ngform-{$uid}-recaptcha" data-sitekey="{$recaptchapublic}" class="g-recaptcha ngformright{if $captchaerror} ngerror{/if}"></div>
</div>
{/if}
{/if}


{if !$mobile}</div>{/if}
{/foreach}

</div>


<div class="clearfix">
<input name="ngform-{$uid}" type="submit" value="{$lang['submit']->value|escape}" />
</div>

<div class="clearfix"></div>

</form>
{if isset($recaptchapublic)}<!-- END-NGCON -->{/if}