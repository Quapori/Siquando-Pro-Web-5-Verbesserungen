### 6. Ausgehende Links sichern durch den Zusatz _rel='noopener noreferrer'_

Lange Zeit war es Standard externe Links mit dem Attribut [target] (Ziel) und dem Wert (Value) [_blank] zu versehen. Dies informiert Browser darüber, dass der Link automatisch ein neues Tab (Browser-Fenster) öffnet um den verlinkten Inhalt aufzurufen. Das stellt jedoch ein Sicherheitsrisiko dar, da Browser mit dem Befehl [window.opener] arbeiten. Genau zu diesem Zeitpunkt, wenn sich das neue Fenster (Tab) öffnet, öffnet sich kurzfristig auch eine Sicherheitslücke (da hilft auch kein https). Mit dem JavaScript-Befehl [window.open.location] und einer URL, auf welche verwiesen wird [„= https://www.url…“] gelangt der User plötzlich auf eine Website, auf welcher er gar nicht wollte! **Ist euch das schon einmal passiert?**

Um dieses Risiko zu unterbinden, kann man im Prinzip ganz einfach mit dem Zusatz [rel=“noopener noreferrer“] den externen Link absichern. In der Praxis sieht das dann so aus:
```html
<a href=“https://externe.webseite.xyz/“ target=“_blank“ rel=“noopener noreferrer“>externe.webseite.xyz</a>
```

Die Anleitung dazu wird noch ausgearbeitet, diese ist etwas umfangreicher.
