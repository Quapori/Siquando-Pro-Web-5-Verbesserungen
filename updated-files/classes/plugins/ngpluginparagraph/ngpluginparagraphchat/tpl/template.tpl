<div id="ngparachat{$uid}" class="ngparachat" data-rest="{$rest|escape}" data-uid="{$uid}" data-postdate="{$postdate}">
    <ul class="ngparachatoutput"></ul>
    <form>
        <label>{$lang->languageResources['nickname']->value|escape}:</label>
        <input maxlength="100" type="text" class="ngparachatnick"/>
        <label>{$lang->languageResources['line']->value|escape}:</label>
        <input maxlength="1000" type="text" class="ngparachatline"/>

        {if isset($privacytext)}
            <span class="ngcontent ngparachatconsent">
                <input type="checkbox" value="privacyconsent"/> {$privacytext}
            </span>
        {/if}


        <div>
            {if $emojis}
                <div class="ngparachatemojis">
                    <a href="#" title="{$lang->languageResources['happy']->value|escape}" class="ngparachathappy"><span>:-)</span></a>
                    <a href="#" title="{$lang->languageResources['sad']->value|escape}" class="ngparachatsad"><span>:-(</span></a>
                    <a href="#" title="{$lang->languageResources['wink']->value|escape}" class="ngparachatwink"><span>;-)</span></a>
                    <a href="#" title="{$lang->languageResources['dead']->value|escape}" class="ngparachatdead"><span>x-(</span></a>
                    <a href="#" title="{$lang->languageResources['lol']->value|escape}" class="ngparachatlol"><span>:lol:</span></a>
                    <a href="#" title="{$lang->languageResources['surprise']->value|escape}" class="ngparachatsurprise"><span>:-o</span></a>
                    <a href="#" title="{$lang->languageResources['love']->value|escape}" class="ngparachatlove"><span>:love:</span></a>
                    <a href="#" title="{$lang->languageResources['angry']->value|escape}" class="ngparachatangry"><span>:angry:</span></a>
                </div>
            {/if}
            <input type="submit" class="ngparachatsubmit" value="{$lang->languageResources['send']->value|escape}"/>
        </div>
    </form>
</div>