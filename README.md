# Siquando Pro Web 5 - Fehlerliste

Ich habe hier mal eine Liste mit Mängeln zusammen gestellt, welche ich persönlich gefunden habe und mir persönlich nicht
gefallen.
***
[Hier könnt ihr meine Anleitungen nachlesen wie ich die Fehler behoben habe](ANLEITUNGEN.md)
***
## Ab hier beginnt die Liste für die Technik/Programmierabteilung von Siquando

1. jQuery Version 2.2.4 mit 4 Schwachstellen
2. Einbindung von Javascripten gehört ans Ende des HTML Dokuments
3. zu viele Requests durch CSS- & JS-Dateien
4. fehlende Preload Funktion von Schriftdateien
5. fehlende oder fehlerhafte _alt=&quot;&quot;_ Attribute bei Bildern
   * [Suchergebnisse nach fehlenden _alt=&quot;&quot;_-Attributen in *.tpl Dateien](docs/1-SUCHERGEBNISSE.md)
   * [Sucherergebnisse nach falsch befüllten _alt=&quot;&quot;_-Attributen in *.tpl Dateien](docs/2-SUCHERGEBNISSE.md)
6. Ausgehende Links werde nicht gesichert durch den Zusatz _rel=&quot;noopener noreferrer&quot;_
7. PNG-Bilddateien werden nicht als WEBP-Dateien ausgegeben
