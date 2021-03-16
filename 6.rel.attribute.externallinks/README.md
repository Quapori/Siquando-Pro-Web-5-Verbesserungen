### 6. Ausgehende Links sichern durch den Zusatz _rel='noopener noreferrer'_

Lange Zeit war es Standard externe Links mit dem Attribut [target] (Ziel) und dem Wert (Value) [_blank] zu versehen. Dies informiert Browser darüber, dass der Link automatisch ein neues Tab (Browser-Fenster) öffnet um den verlinkten Inhalt aufzurufen. Das stellt jedoch ein Sicherheitsrisiko dar, da Browser mit dem Befehl [window.opener] arbeiten. Genau zu diesem Zeitpunkt, wenn sich das neue Fenster (Tab) öffnet, öffnet sich kurzfristig auch eine Sicherheitslücke (da hilft auch kein https). Mit dem JavaScript-Befehl [window.open.location] und einer URL, auf welche verwiesen wird [„= https://www.url…“] gelangt der User plötzlich auf eine Website, auf welcher er gar nicht wollte! **Ist euch das schon einmal passiert?**

Um dieses Risiko zu unterbinden, kann man im Prinzip ganz einfach mit dem Zusatz [rel=“noopener noreferrer“] den externen Link absichern. In der Praxis sieht das dann so aus:
```html
<a href=“https://externe.webseite.xyz/“
   target=“_blank“
   rel=“noopener noreferrer“>
  externe.webseite.xyz
</a>
```
Ein _rel=”noopener”_-Attribut schützt die neue Seite, auf die die Eigenschaft window.opener zugreifen soll, und stellt sicher, dass sie in einem separaten Prozess ausgeführt wird.
Das _rel=”noreferrer”_-Attribut hat eine ähnliche Qualität, verhindert aber auch die Weitergabe der Referrer-Informationen an die neue Seite.

> Es hat keinen Einfluss auf das SEO-Ranking der Website oder die Gesamtleistung Ihrer Website. Tatsächlich schützt es die Vertraulichkeit Ihres Website-Publikums und verhindert externe Websites durch die Verbreitung von schädlichem Code.

## Anleitung

- 90 Vorkommnisse in 27 *.tpl Dateien im Verzeichnis: /classes/plugins/ geändert
- /classes/util/ngrichtext.php [Zeile 63](classes/util/ngrichtext.php#L63) duplizieren und die Werte ändern

```php
$link->setAttribute('target','_blank'); // Zeile 63
$link->setAttribute('rel','noopener noreferrer'); // duplizierte Zeile
```
