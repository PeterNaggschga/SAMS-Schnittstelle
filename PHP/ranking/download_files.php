<?php
$rankingFileName = 'rankings.xml';
$apiKey = '05b4a417-dba5-4382-b40d-ac2b6d6cb516';

if (file_exists($rankingFileName)){
    $rankingsXml = simplexml_load_file($rankingFileName);
    $updatedOld = $rankingsXml->matchSeries->resultsUpdated;
    $seriesId = $rankingsXml->matchSeries->id;
}else{
    $updatedOld = '1970-01-01 01:00:00.000';
    $seriesId = '0';
}

if ($sportsClubXml = simplexml_load_file("https://ssvb.sams-server.de/xml/sportsclub.xhtml?apiKey=$apiKey&sportsclubId=514")) {   // wenn Club mit Id 514 gefunden wurde
    foreach ($sportsClubXml->teams->team as $team) {
       if (strcmp($team->name, 'MH Metallprofil Volleys Dippoldiswalde') == 0   // finde MH Volleys
            and strcmp('League', $team->matchSeries->type) == 0                 // betrachte nur Liga-Tabellen
            and strcmp($seriesId, $team->matchSeries->id) <= 0) {                      // finde höchste seriesId
            $updatedNew = $team->matchSeries->resultsUpdated;
            $seriesId = $team->matchSeries->id;
        }
    }
    if (!isset($updatedNew)) {
        exit('Mannschaft konnte nicht gefunden werden!');
    }
}else{
    exit('Verein konnte nicht gefunden werden!');
}

if (strcmp($updatedOld, $updatedNew) == 0){ // wenn Ranking aktuell
    exit('Keine Änderungen in der Tabelle!');
}

$url = "https://ssvb.sams-server.de/xml/rankings.xhtml?apiKey=$apiKey&matchSeriesId=$seriesId";
if ($rankingsXml = simplexml_load_file($url)){
    if (file_exists($rankingFileName)){
        unlink($rankingFileName);
    }
    $rankingFile = fopen($rankingFileName, "w");
    fwrite($rankingFile, $rankingsXml->asXML());
    fclose($rankingFile);
    exit('Tabelle wurde gespeichert!');
}else{
    exit('Tabelle konnte nicht geladen werden!');
}
