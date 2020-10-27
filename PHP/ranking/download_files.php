<?php
$rankingFileName = 'rankings.xml';
$sportsClubXml = simplexml_load_file('https://ssvb.sams-server.de/xml/sportsclub.xhtml?apiKey=05b4a417-dba5-4382-b40d-ac2b6d6cb516&sportsclubId=514');
if (!($sportsClubXml == false)) {
    foreach ($sportsClubXml->teams->team as $team) {
        if (strcmp($team->name, 'MH Metallprofil Volleys Dippoldiswalde') == 0) {
            $leagueShort = $team->matchSeries->shortName;
            $lastUpdate = $team->matchSeries->resultsUpdated;
            break;
        }
    }
}else{
    exit('Mannschaft konnte nicht gefunden werden!');
}
if (file_exists($rankingFileName)){
    $rankingsXml = simplexml_load_file($rankingFileName);
    if (strcmp($lastUpdate, $rankingsXml->matchSeries->resultsUpdated) == 0){
        exit('Keine Änderungen in der Tabelle!');
    }
}
$matchSeriesXml = simplexml_load_file('https://ssvb.sams-server.de/xml/matchSeries.xhtml?apiKey=05b4a417-dba5-4382-b40d-ac2b6d6cb516');
if (!($matchSeriesXml == false)){
    foreach ($matchSeriesXml->matchSeries as $item){
        if (strcmp($item->shortName, $leagueShort ) == 0){
            $seasonId = $item->id;
            break;
        }
    }
}else{
    exit('Spielrundenübersicht konnte nicht geladen werden!');
}

if (isset($seasonId)){
    $url = 'https://ssvb.sams-server.de/xml/rankings.xhtml?apiKey=05b4a417-dba5-4382-b40d-ac2b6d6cb516&matchSeriesId=' . $seasonId;
    $rankingsXml = simplexml_load_file($url);
    if (!($rankingsXml == false)){
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
}else{
    exit('Liga konnte nicht ermittelt werden!');
}