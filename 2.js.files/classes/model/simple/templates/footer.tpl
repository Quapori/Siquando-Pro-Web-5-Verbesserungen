{if isset($htmlcode['bodybottom'])}{$htmlcode['bodybottom']}{/if}
{if isset($cookiewarning)}
    <div class="ngcookiewarning {if $cookiewarningtop}ngcookiewarningtop{else}ngcookiewarningbottom{/if}">
        {$cookiewarning}
        <button class="ngcookiewarningaccept">{$lang['accept']->value}</button>
        <button class="ngcookiewarningdecline">{$lang['decline']->value}</button>
    </div>
{/if}
{if isset($topicmp3) || isset($topicogg)}
    <audio style="display:none" autoplay="autoplay">
        {if isset($topicmp3)}
            <source src="{$topicmp3|escape}" type="audio/mpeg">
        {/if}
        {if isset($topicogg)}
            <source src="{$topicogg|escape}" type="audio/ogg">
        {/if}
    </audio>
{/if}
{foreach $javascripts as $id=>$javascript}
    {if substr($javascript,0,7)==='http://' || substr($javascript,0,8)==='https://'}<!-- START-NGCON [{$id|escape}] -->{/if}
    {if $id=='jquery'}
        <script src="{$javascript|escape}"></script>
    {/if}
    {if substr($javascript,0,7)==='http://' || substr($javascript,0,8)==='https://'}<!-- END-NGCON -->{/if}
{/foreach}
<script>
    $(document).ready(function () {
        {foreach $javascripts as $id => $javascript}
        {if $id !== 'jquery' } $.getScript("{$javascript|escape}");{/if}
        {/foreach}
    });
</script>
</body>
</html>	
