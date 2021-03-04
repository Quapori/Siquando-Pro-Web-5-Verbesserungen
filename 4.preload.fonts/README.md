### 4. fehlende Preload Funktion von Schriften
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
