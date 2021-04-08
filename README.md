# Siquando Pro Web 5 - Fehlerliste

| Komponenten             | Version    |
|-------------------------|------------|
| NGAppPermissions        | 5.0.0.1000 |
| NGBackupConnectorFile   | 5.0.0.1200 |
| NGBackupConnectorServer | 5.0.0.1200 |
| NGBackupController      | 5.0.0.1200 |
| NGPackage               | 5.0.0.1000 |
| NGUploadConnectorFile   | 5.0.0.1000 |
| NGUploadConnectorFTP    | 5.0.0.1000 |
| NGUploadConnectorSFTP   | 5.0.0.1000 |
| NGUploadController      | 5.0.0.1000 |
| ProjectCentral          | 5.0.0.1001 |
| SiquandoNGConnector     | 5.0.0.1204 |
| SiquandoNGConnectorUI   | 5.0.0.1204 |

Ich habe hier mal eine Liste mit Mängeln zusammen gestellt, welche ich persönlich gefunden habe und mir persönlich nicht
gefallen.
***
[Hier könnt ihr meine Anleitungen nachlesen wie ich die Fehler behoben habe](../../wiki)
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
8. doppelte Einträge in **classes/includes.php**
    * [Zeile 33](original-files/classes/includes.php#L33) > Duplikat von Zeile 9
    * [Zeile 49](original-files/classes/includes.php#L49) > Duplikat von Zeile 7
