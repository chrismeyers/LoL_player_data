<?php include '../lib/parser.php';?>
<!DOCTYPE html>
<html>
    <head>
        <title>LoL player data</title>
        <link rel="shortcut icon" href="../images/lol_guy.ico">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="Author" content="Chris Meyers" />
        
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
        
        <link rel="stylesheet" href="css/custom.css">
        <link rel="stylesheet" href="css/custom-small.css">
        <link rel="stylesheet" href="../scripts/vendor/simplemodal/basic/css/basic.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="../scripts/vendor/simplemodal/basic/css/basic_ie.css" type="text/css" media="screen" />

        <script type="text/javascript" src="../scripts/vendor/jquery-2.2.4.min.js"></script>
        <script type="text/javascript" src="../scripts/vendor/simplemodal/basic/js/jquery.simplemodal.js"></script>
    </head>

    <body>
        <div style="color: red; margin-bottom: 10px;">
        ATTENTION: Due to the deprecation of the stats-v1.3 API endpoint, this web application is no longer pulling
        live data from the League of Legends API. This page was created for historical purposes to capture the final
        state of the application before API services went offline.
        </div>
        <div id="main">
            <div class="summoner">
                <div class="summoner-info">
                    <h1> 
                        <?php 
                        echo $userName . " <br /> Level: " .$summLvl;
                        echo " <br /> ";
                        echo $lolapi->translateRegion();
                        ?> 
                    </h1>
                </div>
                <div class="summoner-icon">
                    <img src="<?php echo $currentSummAvatar; ?>">
                </div>
            </div>
            
            <h2 style="text-align: center">Stat Summary</h2>
            <div class="statbox">
            <?php
            $translator = new Translations();
            
            // Stat Summary
            if(!$statsFound){
                echo "<div style='text-align: center;'>No player stats found for <b>" . $userName . "</b> on <b>" . strtoupper($regionurl) . "</b>.</div>"; 
            }
            else{
                $i = 0;
                $modesTranslated = $translator->translateAllModes($modes);
                foreach($modesTranslated as $currentMode){
                    echo "<table class='statTables'>";
                    echo "<div class='mode'>" . $currentMode["playerStatSummaryType"] . "</div>";
                    echo "<tr class='stats'>" . 
                         "<td class='stat-name-half'>Wins</td>" .
                         "<td class='stat-value-half'>" . $currentMode["wins"] . "</td></tr>";
                         
                    if(array_key_exists("losses", $currentMode)) {
                        echo "<tr class='stats'>" .
                             "<td class='stat-name-half'>Losses</td>" . 
                             "<td class='stat-value-half'>" . $currentMode["losses"] . "</td></tr>";
                    }

                    $currentStatArray = $currentMode["aggregatedStats"];
                    foreach($currentStatArray as $currentStat){
                        echo preg_replace('/(?!^)[[:upper:]]+/',' \0', 
                             "<tr class='stats'><td class='stat-name-half'>" . 
                             ucfirst(array_search($currentStat, $currentStatArray)) .
                             "</td> <td class='stat-value-half'>" . number_format($currentStat) .
                             "</td></tr>");
                    }

                    if($i < sizeof($modesTranslated)-1){
                        echo "</table><br /><br />";
                        $i++;
                    }
                    else{
                        echo "</table>";
                    }   
                }
            }
            
            ?></div>
            
            <?php
            /* // Recent Matches 
            // !!!!! Slows down site due to API throttling. !!!!!
            for($match = 0; $match < 10; $match++){
                echo ${'recentMatch'.$match}["champName"] . " - " . $translator->translateModeRecent(${'recentMatch'.$match}["mode"])
                    . " - " . $translator->translateTeam(${'recentMatch'.$match}["team"])
                    . " - " . ${'recentMatch'.$match}["spell1"]
                    . " - " . ${'recentMatch'.$match}["spell2"];
                echo "<br />";
            }*/?>
                <div class="summoner-input">
                  <?php include 'summonerForm.php' ?>
                </div>
            
            </div>
        
        <?php include 'footer.php'; ?>
        
    </body>
</html>
