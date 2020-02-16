<!DOCTYPE html>
<html lang="de-DE">
<head>
    <meta charset="UTF-8">
    <title>Tabelle</title>
</head>
<body>
<?php
$rankingsXml = simplexml_load_file('rankings.xml');
$league = strtoupper($rankingsXml->matchSeries->name);
?>
<div class="widget-wrap">
    <div class="textwidget">
        <p>TABELLE <?php echo $league ?>:</p>
        <table
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
			<!-- SAMS-Server-API by Per Natzschka -->
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
    </div>
</div>
</body>
</html>