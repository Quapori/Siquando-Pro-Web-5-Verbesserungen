# 7. PNG Bilddateien werden nicht als WEBP Dateien ausgegeben

Mit dem Plugin <a href="https://www.siquando.de/pro-web/erweiterungen/photo-pack/" rel="noopener noreferrer">Erweiterung
Photo Pack PLUS</a> wurde die WebP Unterstützung hinzugefügt. Wie in der Beschreibung zu lesen werden nur JPG Dateien
unterstützt!?

> Die neue WebP-Unterstützung im Photo Pack Plus erkennt automatisch, ob Ihr Browser WebP unterstützt, und ersetzt, ohne
> dass Sie einen Finger krümmen müssten, JPEGs automatisch durch ihre modernen Pendants.

### Hier die Anleitung dazu PNG Dateien ebenfalls zu unterstützen.

- im Verzeichnis: [classes/util/ngimagepump.php](classes/util/ngimagepump.php) öffnen
- in [Zeile 187](classes/util/ngimagepump.php#L187) beginnt folgende Funktion:

```php
private function useWebP() {...}
```

- [Zeile 190](classes/util/ngimagepump.php#L190) sieht wie folgt aus:

```php
if (strcasecmp(substr($this->picture->fileWeb, -4), '.jpg') === 0 || strcasecmp(substr($this->picture->fileWeb, -5), '.jpeg') === 0) {...}
```

- wird erweitert um:

```php
if (strcasecmp(substr($this->picture->fileWeb, -4), '.jpg') === 0 || strcasecmp(substr($this->picture->fileWeb, -5), '.jpeg') === 0 || strcasecmp(substr($this->picture->fileWeb, -4), '.png') === 0) {...}
```

- speichern und schliessen
