# Siquando Pro Web 5 - Liste mit Verbesserungen

Ich habe hier mal eine Liste mit Mängeln zusammen gestellt, welche ich persönlich gefunden habe und mir persönlich nicht
gefallen.

> Alle Änderungen die hier beschrieben werden sind auf eigenes Risiko zu verwenden. Nach jeder Änderung muss Siquando diese erst einmal einlesen und selbst anwenden.
> Dies kann erreicht werden wenn man im Menü auf Datei -> Webseiten-Eigenschaften die Häkchen bei Code optimieren deaktiviert/aktiviert.

### [1. jQuery Version 2.2.4 mit 4 Schwachstellen](1.jQuery)

jQuery bekommt nur noch selten Updates, aber wenn eins veröffentlicht wird, ist es normalerweise wichtig. Siquando Pro
Web 5 nutzt die Version 2.2.4, diese Version hat [4 Schwachstellen](https://snyk.io/test/npm/jquery/2.2.4) und sollte
aktualisiert werden.

### [2. Einbindung von Javascripten](2.js.files)

Es wird grundsätzlich empfohlen JavaScript & JavaScript-Dateien am Ende der HTML-Datei zu referenzieren. Im Allgemeinen
führt der Browser kein Rendering auf dem Bildschirm aus, wenn er noch Ressourcen aus dem _&lt;head&gt;_ lädt – man
spricht hier vom Render-Blocking. Das bedeutet alle JavaScript-Dateien, die im _&lt;head&gt;_ referenziert sind,
blockieren das Rendering.

### [3. Einbindung von Stylesheet Dateien](3.css.files)

Es wird grundsätzlich empfohlen CSS-Dateien im _&lt;head&gt;_ der HTML-Datei zu referenzieren. Eine grundsätzliche
Empfehlung der Web Performance Optimierung ist es, dass einzelne Dateien zusammengefasst werden sollen, damit Requests
eingespart werden können.

### [4. fehlende Preload Funktion von Schriften](4.preload.fonts)

Verursacht der Webfont normalerweise ein [FOUT (Flash Of Unstyled Text)](https://kulturbanause.de/faq/fout/ "kulturnanause.de"), der
markant wahrnehmbar ist, dann ist der Webfont ein Kandidat zum Vorabladen.

### [5. fehlende oder fehlerhafte _alt=""_ Attribute bei Bildern](5.alt.attribute.images)

Bei einem ALT-Attribut oder ALT-Tag handelt es sich um einen Text, der eine Grafik beschreibt. Das Kürzel „ALT“ steht
für „Alternative“. Das ALT-Attribut wird bei Bilddateien auf einer Webseite hinterlegt. Falls ein Bild aus bestimmten
Gründen nicht angezeigt werden kann, erscheint der Text des hinterlegten ALT-Attributs. Er wird zum Alternativtext.
Suchmaschinen benutzen dieses Attribut, um den Bildinhalt zu erkennen, da Bilddateien in der Regel nicht direkt
ausgelesen werden können. Für sehbehinderte Nutzer trägt das ALT-Attribut zur Barrierefreiheit bei. Sie lassen sich
Webseiten mit einem Screenreader vorlesen. Dabei werden auch die ALT-Tags verwendet.

### [6. Ausgehende Links sichern durch den Zusatz _rel='noopener noreferrer'_](6.rel.attribute.externallinks)

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

### [7. PNG Bilddateien werden nicht als WEBP Dateien ausgegeben](7.no.png.to.webp)

Mit dem Plugin [Erweiterung Photo Pack PLUS](https://www.siquando.de/pro-web/erweiterungen/photo-pack/) wurde die WebP Unterstützung hinzugefügt. Wie in der Beschreibung zu lesen werden nur JPG Dateien unterstützt!?

> Die neue WebP-Unterstützung im Photo Pack Plus erkennt automatisch, ob Ihr Browser WebP unterstützt, und ersetzt, ohne dass Sie einen Finger krümmen müssten, JPEGs automatisch durch ihre modernen Pendants.
