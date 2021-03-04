# Siquando Pro Web 5 - Liste mit Verbesserungen
 Ich habe hier mal eine Liste mit Mängeln zusammen gestellt, welche ich persönlich gefunden habe und mir persönlich nicht gefallen.

> Alle Änderungen die hier beschrieben werden sind auf eigenes Risiko zu verwenden. Nach jeder Änderung muss Siquando diese erst einmal einlesen und selbst anwenden.
> Dies kann erreicht werden wenn man im Menü auf Datei -> Webseiten-Eigenschaften die Häkchen bei Code optimieren deaktiviert/aktiviert.

### [1. jQuery Version 2.2.4 mit 4 Schwachstellen](1.jquery.js.md)
um dies zu beheben wird eine aktuelle jQuery Version benötigt.

### [2. einzelne Einbindung von Javascripten](2.js.files.md)
Es wird grundsätzlich empfohlen JavaScript & JavaScript-Dateien am Ende der HTML-Datei zu referenzieren. Im Allgemeinen führt der Browser kein Rendering auf dem Bildschirm aus, wenn er noch Ressourcen aus dem _&lt;head&gt;_ lädt – man spricht hier vom Render-Blocking. Das bedeutet alle JavaScript-Dateien, die im _&lt;head&gt;_ referenziert sind, blockieren das Rendering.

### [3. einzelne Einbindung von Stylesheet Dateien](3.css.files.md)
s wird grundsätzlich empfohlen CSS-Dateien im _&lt;head&gt;_ der HTML-Datei zu referenzieren. Eine grundsätzliche Empfehlung der Web Performance Optimierung ist es, dass einzelne Dateien zusammengefasst werden sollen, damit Requests eingespart werden können.

### [4. fehlende Preload Funktion von Schriften](4.preload.fonts.md)
Verursacht der Webfont normalerweise ein [FOUT (Flash Of Unstyled Text)](https://kulturbanause.de/faq/fout/), der markant wahrnehmbar ist, dann ist der Webfont ein Kandidat zum Vorabladen.
