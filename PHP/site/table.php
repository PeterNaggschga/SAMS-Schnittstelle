<!DOCTYPE html>
<html lang="de-DE">
<head>
    <meta charset="UTF-8">
    <title>Tabelle</title>
</head>
<body>
<!-- https://github.com/PeterNaggschga/SAMS-Schnittstelle -->
<?php
$filename = $_SERVER['DOCUMENT_ROOT'] . '/sams_api/ranking/rankings.xml';
if (file_exists($filename)){
    $rankingsXml = simplexml_load_file($filename);
    $league = $rankingsXml->matchSeries->name;
}else{
    exit('Tabelle konnte nicht geladen werden!');
}
?>
<div class="widget-wrap">
    <div class="textwidget">
        <p>Tabelle <?php echo $league ?>:</p>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Mannschaft</th>
                    <th>Spiele</th>
                    <th>Siege</th>
                    <th>Sätze</th>
                    <th>Punkte</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($rankingsXml as $element){
                    if (isset($element->place)) {
                        $rank = $element->place;
                        $name = $element->team->name;
                        $games = $element->matchesPlayed;
                        $wins = $element->wins;
                        $sets = $element->setPoints;
                        $points = $element->points;
                        echo "
                            <tr>
                                <td>$rank</td>
                                <td>$name</td>
                                <td>$games</td>
                                <td>$wins</td>
                                <td>$sets</td>
                                <td>$points</td>                       
                            </tr>
                                ";
                    }
                }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>