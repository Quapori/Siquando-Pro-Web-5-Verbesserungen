### 3. einzelne Einbindung von Stylesheet Dateien
je nach Verwendung von Absatztypen werden mitunter auch weitere Stylesheets (CSS) eingebunden.   
Diese werden alle einzelnd in den Quellcode hinzugefügt. Besser wäre es diese in einer Datei zusammenzufassen.

>Meine Not-Lösung dazu ist eine Verwendung der @import Funktion innerhalb des <style> Tags.

Anleitung:
- navigiert auf dem Server zu folgendem Pfad: classes/model/simple/templates/
- öffnet die Datei header.tpl
- sucht & entfernt folgende Zeilen:
```html
{foreach $stylesheets as $stylesheet}
<link rel="stylesheet" href="{$stylesheet|escape}" />
{/foreach}
```
```html
{if (count($styles) > 0)}
<style>
    <!--
    {foreach $styles as $style}
    {$style}
    {/foreach}
    -->
</style>
{/if}
```
- jetzt fügt ihr folgende Zeilen an der gleichen Stelle ein:
```html
<style>
    {foreach $stylesheets as $stylesheet}
    @import "{$stylesheet|escape}";
    {/foreach}
    {if (count($styles) >= 0)}
    <!--
    {foreach $styles as $style}
    {$style}
    {/foreach}
    -->
    {/if}
</style>
``` 
- speichert & schliesst die Datei
