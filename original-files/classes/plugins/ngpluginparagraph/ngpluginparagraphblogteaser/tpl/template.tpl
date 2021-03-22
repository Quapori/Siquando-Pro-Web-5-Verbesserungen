<ul class="ngparablogteaser ngparablogteaser{$ratio}{if $twocols} ngparablogteaser2col{/if}{if $animate} ngparablogteaseranimate{/if}">
    {foreach $posts as $post}
        <li>
            {if isset($post->picturesource)}
                <div class="ngparablogteaserpicture">
                    <a href="{$post->url}">
                        <img src="{$post->picturesource|escape}" alt="{$post->heading|escape}"/>
                    </a>
                </div>
            {/if}

            {if isset($post->authorpicture)}
            {if isset($post->authorlinkurl)}<a href="{$post->authorlinkurl|escape}"{if isset($post->authorlinktarget)} target="{$post->authorlinktarget}"{/if}{if isset($post->authorlinkclass)} class="{$post->authorlinkclass}"{/if}>{/if}
                <img class="ngparablogteaserauthor" src="{$post->authorpicture}" alt="{$post->authorcaption}" width="64" height="64"/>
            {if isset($post->authorlinkurl)}</a>{/if}
            {/if}

            {if isset($post->nicedate) || isset($post->authorcaption)}
                <em>{if isset($post->nicedate)}{$post->nicedate}{/if}{if isset($post->authorcaption)} {$by|escape} {$post->authorcaption|escape}{/if}</em>
            {/if}
            {if $showcaptions}
            {if $post->subheading!==''}<h3>{$post->subheading|escape}</h3>{/if}
            {if $post->heading!==''}<h2>{$post->heading|escape}</h2>{/if}
            {/if}
            {if isset($post->intro)}{$post->intro}{/if}
            {if isset($more)}
                <div class="ngparablogteasermore ngcontent">
                    <a href="{$post->url}">{$more|escape}</a>
                </div>
            {/if}
        </li>
    {/foreach}
</ul>