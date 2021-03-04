# Siquando Pro Web 5 - Liste mit Verbesserungen
 Ich habe hier mal eine Liste mit Mängeln zusammen gestellt, welche ich persönlich gefunden habe und mir persönlich nicht gefallen.

> Alle Änderungen die hier beschrieben werden sind auf eigenes Risiko zu verwenden. Nach jeder Änderung muss Siquando diese erst einmal einlesen und selbst anwenden.
> Dies kann erreicht werden wenn man im Menü auf Datei -> Webseiten-Eigenschaften die Häkchen bei Code optimieren deaktiviert/aktiviert.

### 1. jQuery Version 2.2.4 mit 4 Schwachstellen

[Anleitung](./jquery.js.md)

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

>Meine Not-Lösung dazu ist die Verwendung der .getScript() Funktion von jQuery.

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
### 3. fehlende Preload Funktion von Schriften
>Meine Lösung dazu ist es die Schriften in ein eigenes Array zu bündeln und diese dann mit einer Variable an die Smarty Templates zu übergeben

Anleitung:
- navigiert auf dem Server zu folgendem Pfad: classes/plugins/ngpluginlayout
- öffnet die Datei ngpluginlayout.php
- fügt unter folgender Zeile:
```php
/**
*
* Array with links to style sheets
*
* @var Array
*/
public $styleSheets = array();
``` 
- diese Zeilen ein:
```php
/**
*
* Array with links to webfont files
*
* @var Array
*/
public $fontfiles = array();
``` 
- sucht weiter nach folgender Zeile:
```php
/**
* Append all web fonts
*/
public function appendWebFonts() {
	$fontutil = NGFontUtil::getInstance ();
	
	foreach ( $fontutil->styleSheets as $styleSheet ) {
		$this->styleSheets ['webfont' . $styleSheet] = NGUtil::prependRootPath ( 'classes/plugins/ngplugintypography/css/' . $styleSheet . '.css' );
	}		
}
```
- fügt in diesem Block unter folgender Zeile:
```php
$this->styleSheets ['webfont' . $styleSheet] = NGUtil::prependRootPath ( 'classes/plugins/ngplugintypography/css/' . $styleSheet . '.css' );
```
- diese Zeilen hinzu:
```php
if (file_exists(NGUtil::prependRootPath('classes/plugins/ngplugintypography/fonts/' . $styleSheet . '-regular-webfont.woff'))) {
    $this->fontfiles[$styleSheet . '-regular-webfont'] = NGUtil::prependRootPath('classes/plugins/ngplugintypography/fonts/' . $styleSheet . '-regular-webfont.woff');
}
if (file_exists(NGUtil::prependRootPath('classes/plugins/ngplugintypography/fonts/' . $styleSheet . '-italic-webfont.woff'))) {
    $this->fontfiles[$styleSheet . '-italic-webfont'] = NGUtil::prependRootPath('classes/plugins/ngplugintypography/fonts/' . $styleSheet . '-italic-webfont.woff');
}
if (file_exists(NGUtil::prependRootPath('classes/plugins/ngplugintypography/fonts/' . $styleSheet . '-bold-webfont.woff'))) {
    $this->fontfiles[$styleSheet . '-bold-webfont'] = NGUtil::prependRootPath('classes/plugins/ngplugintypography/fonts/' . $styleSheet . '-bold-webfont.woff');
}
if (file_exists(NGUtil::prependRootPath('classes/plugins/ngplugintypography/fonts/' . $styleSheet . '-bolditalic-webfont.woff'))) {
    $this->fontfiles[$styleSheet . '-bolditalic-webfont'] = NGUtil::prependRootPath('classes/plugins/ngplugintypography/fonts/' . $styleSheet . '-bolditalic-webfont.woff');
}
if (file_exists(NGUtil::prependRootPath('classes/plugins/ngplugintypography/fonts/' . $styleSheet . '-webfont.woff'))) {
    $this->fontfiles[$styleSheet . '-webfont'] = NGUtil::prependRootPath('classes/plugins/ngplugintypography/fonts/' . $styleSheet . '-webfont.woff');
}
```
- jetzt sucht ihr diese Zeilen:
```php
public function setDefaultVariables() {
	$this->template->assign ( 'page', $this->page );
	$this->template->assign ( 'streams', $this->page->paragraphStreams );
		
	// ksort($this->styleSheets);
		
	$this->template->assign ( 'stylesheets', $this->styleSheets );
	$this->template->assign ( 'javascripts', $this->javaScripts );
	$this->template->assign ( 'styles', $this->styles );
}
```
- fügt unter folgender Zeile:
```php
$this->template->assign ( 'styles', $this->styles );
```
- diese Zeile ein:
```php
$this->template->assign('fontfiles', $this->fontfiles);
```
- speichert & schliesst die Datei
- navigiert auf dem Server zu folgendem Pfad: classes/model/simple/templates/
- öffnet die Datei header.tpl
- sucht folgenden Zeilen:
```html
{if isset($touchicons)}
{foreach $touchicons as $size => $url}
<link rel="apple-touch-icon{if $touchiconprecomposed}-precomposed{/if}" {if $size!==''}sizes="{$size}" {/if}href="{$url|escape}" />
{/foreach}
{/if}
```
- darunter fügt ihr diese Zeile ein:
```html
{foreach $fontfiles as $font}
	<link rel="preload" href="{$font}" as="font" type="font/woff" crossorigin>
{/foreach}
```
- speichert & schliesst die Datei
