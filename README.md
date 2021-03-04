# Siquando Pro Web 5 - Liste mit Verbesserungen
 Ich habe hier mal eine Liste mit Mängeln zusammen gestellt, welche ich persönlich gefunden habe und mir persönlich nicht gefallen.

### 1. jQuery Version 2.2.4 mit 4 Schwachstellen
um dies zu beheben wird eine aktuelle jQuery Version benötigt.
Einfach die minimierte jQuery Datei herunterladen. Ich verwende v3.5.1

[jQery.com](https://jquery.com/download/) oder [Google Hosted Libraries
](https://developers.google.com/speed/libraries#jquery)

Verbindet euch per ftp/sftp oder ssh, mit dem Server wo euer Siquando Projekt installiert wurde.
Navigiert zu dem Installations-Pfad und öffnet dort den Ornder:

/js

hier findet ihr 2 Dateien:     
- jquery.color.js    
- jquery.js

Jetzt müsst ihr die *jquery.js* umbenennen z. Bsp. *jqery.2.2.4.js*   
Danach könnt ihr die neue jquery Datei hochladen und in jqery.js umbennennen.

>Jetzt kann es sein das ein paar Funktionen auf eurer Webseite nicht korrekt ausgeführt werden.

Dies könnt ihr prüfen, indem ihr die Entwickler-Tools in eurem Browser nutzt.  
In der Konsolenausgabe werden euch die Fehler angezeigt. Diese Fehlerausgabe zeigt die betroffene Datei und den Fehler dazu an.  
Meistens ist es eine Änderung der load Funktion innerhalb der Javascript Dateien.

Bsp.:
```js script
$(this).load(function (){});
// oder 
$(window).load(function() {});
```
dies wird geändert zu
```js
$(this).on('load', function (){});
// oder
$(window).on('load', function() {});
```
### 2. einzelne Einbindung von Javascripten
je nach Verwendung von Absatztypen werden mitunter auch weitere Javascripte (JS) eingebunden.   
Diese werden alle einzelnd in den Quellcode hinzugefügt. Besser wäre es diese in einer Datei zusammenzufassen.

>Meine Not-Lösung dazu ist die Verwendung der .getScript() Funktion von jQery.

Anleitung:
- navigiert auf dem Server zu folgendem Pfad: classes/model/simple/templates/
- öffnet die Datei header.tpl
- sucht & entfernt folgende Zeilen:
```html
{foreach $javascripts as $id=>$javascript}
...
{/foreach}
```
- speichert & schliesst die Datei
- öffnet jetzt im gleichen Verzeichnis die Datei footer.tpl
- fügt jetzt die folgende Zeilen vor dem </bod> Tag ein
```html
{foreach $javascripts as $id=>$javascript}
	{if substr($javascript,0,7)==='http://' || substr($javascript,0,8)==='https://'}<!-- START-NGCON [{$id|escape}] -->{/if}
	{if $id=='jquery'}
		<script src="{$javascript|escape}"></script>
	{/if}
	{if substr($javascript,0,7)==='http://' || substr($javascript,0,8)==='https://'}<!-- END-NGCON -->{/if}
{/foreach}
<script>
	$(document).ready(function() {
		{foreach $javascripts as $id=>$javascript}{if $id!=='jquery'}$.getScript("{$javascript|escape}");{/if}{/foreach}
	});
</script>
```
- speichert & schliesst die Datei wieder

### 3. einzelne Einbindung von Stylesheet Dateien
je nach Verwendung von Absatztypen werden mitunter auch weitere Stylesheets (CSS) eingebunden.   
Diese werden alle einzelnd in den Quellcode hinzugefügt. Besser wäre es diese in einer Datei zusammenzufassen.

>Meine Not-Lösung dazu ist eine Verwendung der @import Funktion innerhalb des <style> Tags.
