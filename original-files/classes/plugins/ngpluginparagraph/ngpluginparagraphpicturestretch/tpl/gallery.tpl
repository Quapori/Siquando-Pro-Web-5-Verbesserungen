<!DOCTYPE html>
<html{if (array_key_exists('w2dng.lang', $metatags))} lang="{$metatags['w2dng.lang']}"{/if}>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    {foreach $metatags as $id => $value}
        {if substr($id,0,6)!=='w2dng.'}
            {if substr($id,0,3)=='og:'}
                <meta property="{$id|escape}" content="{$value|escape}"/>
            {else}
                <meta name="{$id|escape}" content="{$value|escape}"/>
            {/if}
        {/if}
    {/foreach}
    <title>{$caption|escape}</title>
    <link rel="stylesheet" href="css/gallery.css"/>
    {foreach $fonts as $font}
        <link rel="stylesheet" href="{$fontspath}{$font}.css"/>
    {/foreach}
    <script src="{$jquery}"></script>
    <script src="js/photostory.js"></script>
    <style type="text/css">
        body {
            background-color: #{$background};
            color: #{$foreground};
            font: {{$font|ngfont}};
        }

        .ngparaphotostory a.ngparaphotostoryclose {
            background-image: url({$closeimage});
        }

        .ngparaphotostory a.ngparaphotostorynext {
            background-image: url({$nextimage});
        }

        .ngparaphotostory a.ngparaphotostoryprev {
            background-image: url({$previmage});
        }
    </style>
</head>
<body>

<div class="ngparaphotostory">
    <div class="ngparaphotostorytop">
        <div>
            {if $caption!==''}<h1>{$caption|escape}</h1>{/if}
            {$summary}
            <span></span>
        </div>
    </div>
    <div class="ngparaphotostorycenter">
        <ul>
            {foreach $pictures as $picture}
                <li>
                    <img src="{$picture->source|escape}" width="{$picture->size->width}"
                         height="{$picture->size->height}" alt=""/>
                    <span>{$picture->caption|escape}</span>
                </li>
            {/foreach}
        </ul>
    </div>

    <div class="ngparaphotostorybottom">
        <span></span>
    </div>

    <a href="{$backlink|escape}#paraps{$uid}" class="ngparaphotostoryclose"></a>
    <a href="#" class="ngparaphotostorynext"></a>
    <a href="#" class="ngparaphotostoryprev"></a>
</div>

</body>
</html>