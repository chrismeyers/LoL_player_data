<?php
include '../lib/lolapi.php';
include '../lib/featured.php';
$lolapi = new lolapi();

//=========Determine region=========
$regionurl = $lolapi->getRegion($_GET['region']);

//=========Core url data=========
$baseurl = $lolapi->buildBaseUrl($regionurl);
$staticbaseurl = $lolapi->buildStaticBaseUrl($regionurl);
$summonerdataurl = $lolapi->getSummonerDataUrl();
$championdataurl = $lolapi->getChampionDataUrl();
$statsurl = $lolapi->getStatsUrl();
$summarystatsurl = $lolapi->getSummaryStatsUrl();
$rankedstatsurl = $lolapi->getRankedStatsUrl();
$apikey = $lolapi->buildApiKeyUrl();

//=========Parsing user data=========
$summoner = $lolapi->getSummoner(($_GET['name']));
$jsonSumm = $lolapi->getSummonerData($baseurl, $summonerdataurl, $summoner, $apikey);

//HTTP Error handling.
if(in_array($jsonSumm, $lolapi->possibleErrors())){ 
    header('Location: ../web/index.php?e=' . $jsonSumm);
    exit();
}

$objSummArr = $lolapi->jsonToArray($jsonSumm);

//Returned json and converted array
//echo $jsonSumm;
//echo "<br />";
//echo "<pre>"; var_dump($objSummArr); echo "</pre>";

//Save user data to vars
$currentSummId = $lolapi->getSummonerId($objSummArr, $summoner);
$userName = $lolapi->getFormattedName($objSummArr, $summoner);
$summLvl = $lolapi->getSummonerLevel($objSummArr, $summoner);
$currentSummAvatar = $lolapi->buildAvatarUrl($regionurl, $summoner);


//echo "<br /><br />";
//=========Current player stat summary=========
$seasons = array("SEASON3", "SEASON2014", "SEASON2015");  //ADD NEW SEASONS TO END OF THIS ARRAY
$modes = array();
$featured = new Featured();

for($s = 0; $s < sizeof($seasons); $s++){
    $season = $seasons[$s];

    ${"jsonStatSummary" . $season} = $lolapi->getStatSummary($baseurl, $currentSummId, $apikey, $season);
    ${"objNormStatsArr" . $season} = $lolapi->jsonToArray(${"jsonStatSummary" . $season});
    
    ${"gameModes" . $season} = sizeof(${"objNormStatsArr" . $season}["playerStatSummaries"]);
    
    
    for($i = 0; $i < ${"gameModes" . $season}; $i++){
        if($s == sizeof($seasons)-1){
            //Current season, push all data
            $newMode = ${"objNormStatsArr" . $season}["playerStatSummaries"][$i]["playerStatSummaryType"];
            $found = FALSE;

            //URF 2015
            if((strcmp($newMode, "URF") == 0 || strcmp($newMode, "URFBots") == 0) && strcmp($season, "SEASON2015") == 0){
                $newMode .= "2015";
                $found = TRUE;
            }

            if($found){
                ${"objNormStatsArr" . $season}["playerStatSummaries"][$i]["playerStatSummaryType"] = $newMode;
            }

            array_push($modes, ${"objNormStatsArr" . $season}["playerStatSummaries"][$i]);
        }
        else{
            //A previous season, only push featured modes.
            $newMode = ${"objNormStatsArr" . $season}["playerStatSummaries"][$i]["playerStatSummaryType"];
            $found = FALSE;

            //One for all orginal
            if(strcmp($newMode, "OneForAll5x5") == 0 && strcmp($season, "SEASON3") == 0){
                $newMode .= "Vanilla";
                $found = TRUE;
            }
            //One for all mirror
            else if(strcmp($newMode, "OneForAll5x5") == 0 && strcmp($season, "SEASON2014") == 0){
                $newMode .= "Mirror";
                $found = TRUE;
            }
            //URF 2014
            else if((strcmp($newMode, "URF") == 0 || strcmp($newMode, "URFBots") == 0) && strcmp($season, "SEASON2014") == 0){
                $newMode .= "2014";
                $found = TRUE;
            }

            if($found){
                ${"objNormStatsArr" . $season}["playerStatSummaries"][$i]["playerStatSummaryType"] = $newMode;
            }

            if($featured->isFeaturedMode($newMode) || $found){
                array_push($modes, ${"objNormStatsArr" . $season}["playerStatSummaries"][$i]);
            }
        }
    }
}

/*
echo "<br />";
echo "<pre>"; var_dump($modes); echo "</pre>";
echo "<br /><br />";
*/

/*
//=========Current player recent games=========
//Slows down site due to API throttling.
$recentGamesUrl = $lolapi->getRecentGames($baseurl, $currentSummId, $apikey);
$objRecentGamesArr = $lolapi->jsonToArray($recentGamesUrl);

//Returned recent games json and converted array
//echo $recentGamesUrl;
//echo "<br />";
//echo "<pre>"; var_dump($objRecentGamesArr); echo "</pre>";

for($i = 0; $i < 10; $i++){
    ${'recentMatch' . $i} = array();
    $currentChampId = $objRecentGamesArr["games"][$i]["championId"];
    $staticChampData = $lolapi->getChampionData($staticbaseurl, $regionurl, $currentChampId, $apikey);
    $objStaticChampArr = $lolapi->jsonToArray($staticChampData);

    //Returned recent games json and converted array
    //echo $recentGamesUrl;
    //echo "<br />";
    //echo "<pre>"; var_dump($objStaticChampArr); echo "</pre>";
     
    ${'recentMatch' . $i}["champName"] = $objStaticChampArr["name"];
    ${'recentMatch' . $i}["mode"] = $objRecentGamesArr["games"][$i]["subType"]; //needs to be translated
    ${'recentMatch' . $i}["team"] = $objRecentGamesArr["games"][$i]["teamId"]; //needs to be translated
    ${'recentMatch' . $i}["spell1"] = $lolapi->getSpellName($regionurl, $objRecentGamesArr["games"][$i]["spell1"], $apikey);
    ${'recentMatch' . $i}["spell2"] = $lolapi->getSpellName($regionurl, $objRecentGamesArr["games"][$i]["spell2"], $apikey);
}
*/
?>