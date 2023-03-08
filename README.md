# SAMS-Schnittstelle
Einige PHP-Skripte, die die aktuelle Tabelle der MH Metallprofil Volleys Dippoldiswalde über die SAMS-API als XML herunterladen ([download_files.php](/PHP/ranking/download_files.php)) und daraus eine Tabelle ([table.php](/PHP/site/table.php)) erstellen. Dazu wird der API-Key ```05b4a417-dba5-4382-b40d-ac2b6d6cb516``` genutzt.

## Anwendung
Die Datei [download_files.php](/PHP/ranking/download_files.php) muss im Verzeichnis ```/sams_api/ranking/``` des Servers abgelegt werden. Um die Tabelle aktuell zu halten, empfiehlt sich ein Cronjob, der das Skript regelmäßig ausführt (zum Beispiel alle 15 Minuten).

Die Datei [table.php](/PHP/site/table.php) muss überall dort eingebettet werden, wo die Tabelle auftauchen soll.
 
## Weitere Informationen

### MH Metallprofil Volleys Dippoldiswalde
- Website: https://www.metallprofil-volleys.de/

### SAMS-API
- Dokumentation: http://wiki.sams-server.de/wiki/XML-Schnittstelle
- Vereinsinfo der MH Volleys: https://ssvb.sams-server.de/xml/sportsclub.xhtml?apiKey=05b4a417-dba5-4382-b40d-ac2b6d6cb516&sportsclubId=514
- Spielrundenübersicht: https://ssvb.sams-server.de/xml/matchSeries.xhtml?apiKey=05b4a417-dba5-4382-b40d-ac2b6d6cb516
- Tabellen (2019/20): https://ssvb.sams-server.de/xml/rankings.xhtml?apiKey=05b4a417-dba5-4382-b40d-ac2b6d6cb516&matchSeriesId=7060877