### 1. jQuery Version 2.2.4 mit 4 Schwachstellen
jQuery bekommt nur noch selten Updates, aber wenn eins veröffentlicht wird, ist es normalerweise wichtig. 
Siquando Pro Web 5 nutzt die Version 2.2.4, diese Version hat [4 Schwachstellen](https://snyk.io/test/npm/jquery/2.2.4) und sollte 
aktualisiert werden.

Ich verwende v3.5.1

Downloads:
[jQery.com](https://jquery.com/download/) oder [Google Hosted Libraries
](https://developers.google.com/speed/libraries#jquery)

Verbindet euch per ftp/sftp oder ssh, mit dem Server wo euer Siquando Projekt installiert wurde.

- auf eurem Server wechselt ihr in folgendes Verzeichnis eurer Siquando Installation:
  
/js

hier findet ihr 2 Dateien:
- jquery.color.js
- jquery.js

Jetzt müsst ihr die *jquery.js* umbenennen z. Bsp. *jquery.2.2.4.js*   
Danach könnt ihr die neue jquery Datei hochladen und in jquery.js umbennennen.

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