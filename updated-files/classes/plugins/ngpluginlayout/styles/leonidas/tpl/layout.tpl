{include file='header.tpl'}

<div class="sqrtopspacer"></div>

<nav class="sqrnav">

    {if isset ($logosource)}
        <a href="{$home|escape}"><img class="sqrlogo" src="{$logosource|escape}" alt="" {if isset ($logosourcehd)} srcset="{$logosource|escape} 1x, {$logosourcehd|escape} 2x" {/if} /></a>
    {else}
        <div style="height:20px"></div>
    {/if}

    <a href="#" class="sqrnavhide">{$lang['hidenavigation']->value}</a>
    <a href="#" class="sqrnavshow">{$lang['shownavigation']->value}</a>
    <ul>
        {$nav}

        {if $search!==''}
            <li class="sqrnavsearch"><a href="#"><span>{$lang['search']->value}</span></a>
                <div>
                    <form action="{$search|escape}"  >
                        <input type="text" name="criteria"  />
                    </form>
                </div>
            </li>
        {/if}

    </ul>
</nav>

{if count($pictures)>0 || isset($eyecatchersource) || isset($topich264) || isset($topicogv) || isset($topicwebm)}

<div id="sqrheader" data-autoprogress="{$autoprogress}" data-size="{$size}"  >
    <div id="headercontainer">
        {if isset($topich264) || isset($topicogv) || isset($topicwebm)}
            <video class="eyecatcherchild" loop autoplay="autoplay" playsinline="playsinline" {if isset($poster)} poster="{$poster|escape}"{/if} {if $mutevideo}muted="muted"{/if}>
                {if isset($topich264)}
                    <source src="{$topich264|escape}" type="video/mp4" />
                {/if}
                {if isset($topicogv)}
                    <source src="{$topicogv|escape}" type="video/ogg" />
                {/if}
                {if isset($topicwebm)}
                    <source src="{$topicwebm|escape}" type="video/webm" />
                {/if}
            </video>
        {else if count($pictures)>0}
            <img class="eyecatcherchild" src="{$pictures[0]|escape}" alt="" />
        {else if isset($eyecatchersource)}
            <img class="eyecatcherchild" src="{$eyecatchersource|escape}" alt="" />
        {/if}

    </div>

    {if count($pictures)>1 && !isset($topich264) && !isset($topicogv) && !isset($topicwebm)}
        <div id="headersliderbullets">
            {foreach $pictures as $picture}
                <a href="{$picture|escape}"></a>
            {/foreach}
        </div>
    {/if}

</div>

{/if}


<div id="maincontainer">

    {if $page->pagecaption()!==''}
        <div class="sqrallwaysboxed">
            <h1>{$page->pagecaption()|escape}</h1>
            {if (isset($breadcrumbs))}
                <p class="sqrbreadcrumbs">{$lang['youarehere']->value} {$breadcrumbs}</p>
            {/if}
        </div>
    {/if}


    {if $streams['header']->isVisible}
        <div class="{if $previewmode}ngparagraphstreamcontainer {/if}" id="header">
            {$streams['header']->output}
        </div>
    {/if}

    <div id="main">
        {if $cols>1}
        <div class="{$mainstyle} sqrdesktopboxed">
            {/if}
            {if $streams['sidebarleft']->isVisible}
                <div class="{if $previewmode}ngparagraphstreamcontainer {/if}" id="sidebarleft">
                    {$streams['sidebarleft']->output}
                </div>
            {/if}


            {if $streams['content']->isVisible}
                <div class="{if $previewmode}ngparagraphstreamcontainer {/if}" id="content">
                    {$streams['content']->output}
                </div>
            {/if}

            {if $streams['sidebarright']->isVisible}
                <div class="{if $previewmode}ngparagraphstreamcontainer{/if}" id="sidebarright">
                    {$streams['sidebarright']->output}
                </div>
            {/if}
            {if $cols>1}
        </div>
        {/if}
    </div>

    {if $streams['footer']->isVisible}
        <div class="{if $previewmode}ngparagraphstreamcontainer {/if}" id="footer">
            {$streams['footer']->output}
        </div>
    {/if}

</div>


<footer class="sqrcommon">

    {if isset($commonnavhierarchical)}
        <ul class="sqrcommonnavhierarchical sqrcommonnavhierarchical{min(5,count($commonnavhierarchical))}col">
            {foreach $commonnavhierarchical as $topic}
                <li>
                    <em>{$topic->caption|escape}</em>
                    <ul>
                        {foreach $topic->pages as $page}
                            <li><a href="{$page->link|escape}">{$page->caption|escape}</a></li>
                        {/foreach}
                    </ul>
                </li>
            {/foreach}
        </ul>
    {/if}

    {if isset($commonnav)}
        <ul class="sqrcommonnav">
            {foreach $commonnav as $item}
                <li>
                    <a href="{$item->link|escape}">{$item->caption|escape}</a>
                </li>
            {/foreach}
        </ul>
    {/if}

    {if $footer!==''}
        <div>
            {$footer}
        </div>
    {/if}


</footer>


{include file='footer.tpl'}