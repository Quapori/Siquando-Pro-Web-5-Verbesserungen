# 2. einzelne Einbindung von Javascripten

je nach Verwendung von Absatztypen werden mitunter auch weitere Javascripte (JS) eingebunden.   
Diese werden alle einzelnd in den _&lt;head&gt;_ des Quellcodes hinzugefügt. Also raus damit, am Ende des Quellcodes
einbinden & optimieren.

> Meine Not-Lösung dazu ist die Verwendung der .getScript() Funktion von jQuery.

Anleitung:

- auf eurem Server wechselt ihr in folgendes Verzeichnis eurer Siquando Installation: classes/model/simple/templates/
- öffnet die Datei [header.tpl](classes/model/simple/templates/header.tpl)
- sucht & entfernt folgende Zeilen:

```html
{foreach $javascripts as $id=>$javascript}
...
{/foreach}
```

- speichert & schliesst die Datei
- öffnet jetzt im gleichen Verzeichnis die Datei [footer.tpl](classes/model/simple/templates/footer.tpl)
- fügt jetzt die folgenden Zeilen vor dem &lt;/body&gt; Tag ein

```html
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
```

- speichert & schliesst die Datei wieder
