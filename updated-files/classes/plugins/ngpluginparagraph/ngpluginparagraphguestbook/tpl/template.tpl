<div class="ngparaguestbook" data-rest="{$rest|escape}" {if $starsresult}data-result="on"{/if} {if $starsresultdetails}data-details="on"{/if} data-uid="{$uid}" data-star="{$star|escape}" data-postsperpage="{$postsperpage}" data-star1="{$lang->languageResources['star1']->value|escape}" data-star2="{$lang->languageResources['star2']->value|escape}" data-star3="{$lang->languageResources['star3']->value|escape}" data-star4="{$lang->languageResources['star4']->value|escape}" data-star5="{$lang->languageResources['star5']->value|escape}" data-average="{$lang->languageResources['average']->value|escape}" data-location="{$lang->languageResources['from']->value|escape}">
    <div class="ngparaguestbookposts"></div>
    <div class="ngparaguestbookpagination"></div>
    {if $recaptchapublic!==''}<!-- START-NGCON [recaptcha] -->{/if}
    {if !$locked}
        <h3>{$lang->languageResources['post']->value|escape}</h3>
        <div class="ngparaguestbookformerror"></div>
        <form action="">
            <label data-id='name'>{$lang->languageResources['name']->value|escape}</label>
            <input type="text" name="name" maxlength="100" />
            {if $stars}
                <label>{$lang->languageResources['stars']->value|escape}</label>
                <input type="hidden" name="stars" />
                <div class="ngparaguestbookstars">
                    <a href="#"></a>
                    <a href="#"></a>
                    <a href="#"></a>
                    <a href="#"></a>
                    <a href="#"></a>
                    <div class="clearfix"></div>
                </div>
            {/if}
            {if $email}
                <label data-id='email'>{$lang->languageResources['email']->value|escape}</label>
                <input type="email" name="email" maxlength="100" />
            {/if}
            {if $location}
                <label data-id='location'>{$lang->languageResources['location']->value|escape}</label>
                <input type="text" name="location" maxlength="100" />
            {/if}
            <label data-id='caption'>{$lang->languageResources['caption']->value|escape}</label>
            <input type="text" name="caption" maxlength="200" />
            <label data-id='message'>{$lang->languageResources['message']->value|escape}</label>
            <textarea name="message" maxlength="1000"></textarea>
            {if isset($privacytext)}
                <label class="ngparaguestbookconsent ngcontent" data-id='privacyconsent'>
                    <input type="hidden" name="privacymustconsent" value="privacymustconsent" />
                    <input name="privacyconsent" type="checkbox" value="privacyconsent" /> {$privacytext}
                </label>
            {/if}

            {if $recaptchapublic!==''}
                <label data-id='captcha'>{$lang->languageResources['recaptcha']->value|escape}</label>
                <div id="ngguestbook-{$uid}-recaptcha" class="g-recaptcha ngparaguestbookcaptcha" data-sitekey="{$recaptchapublic}"></div>
            {/if}
            <button>{$lang->languageResources['submit']->value|escape}</button>
            <div class="clearfix"></div>
        </form>
    {/if}
    {if $recaptchapublic!==''}<!-- END-NGCON -->{/if}
</div>
