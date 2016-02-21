<?php
include '../lib/lolapi.php';
include '../lib/featured.php';
include 'translations.php';

$DEBUG_FLAG = 0;

$translator = new Translations();
$lolapi = new lolapi();
$featured = new Featured();

//=========Determine region=========
$regionurl = $lolapi->getRegion($_GET['region']);

//=========Core url data=========
$baseurl = $lolapi->buildBaseUrl($regionurl);
$summonerdataurl = $lolapi->getSummonerDataUrl();
$apikey = $lolapi->buildApiKeyUrl();

//=========Parsing user data=========
$summoner = $lolapi->getSummoner(($_GET['name']));
$jsonSumm = $lolapi->getSummonerData($baseurl, $summonerdataurl, $summoner, $apikey);

//HTTP Error handling.
if(in_array($jsonSumm, $lolapi->possibleErrors())){ 
    header('Location: ../web/index.php?e=' . $jsonSumm);
    exit();
}

$summArr = $lolapi->jsonToArray($jsonSumm);

//Returned json and converted array
if($DEBUG_FLAG){
    //echo $jsonSumm;
    $lolapi->varDump($summArr);
}

//Save user data to vars
$currentSummId = $lolapi->getSummonerId($summArr, $summoner);
$userName = $lolapi->getFormattedName($summArr, $summoner);
$summLvl = $lolapi->getSummonerLevel($summArr, $summoner);
$currentSummAvatar = $lolapi->buildAvatarUrl($regionurl, $summoner);


//=========Current player stat summary=========
$seasons = $translator->getSeasonKeys();
$modes = array();

if($DEBUG_FLAG){
    $lolapi->varDump($seasons);
}

for($s = 0; $s < sizeof($seasons); $s++){
    $season = $seasons[$s];

    $currentjsonStatSummary = $lolapi->getStatSummary($baseurl, $currentSummId, $apikey, $season);
    $currentNormStatsArr = $lolapi->jsonToArray($currentjsonStatSummary);
    
    $currentSeasonNumGameModes = sizeof($currentNormStatsArr["playerStatSummaries"]);
    
    for($i = 0; $i < $currentSeasonNumGameModes; $i++){
        $newMode = $currentNormStatsArr["playerStatSummaries"][$i]["playerStatSummaryType"];
        $found = FALSE;

        //The following modes appeared in multiple seasons and require a suffix
        //to remove ambiguity.
        //  - OneForAll5x5, URF, URFBots, Hexakill
        
        if(in_array($newMode, $featured->getDupeFeaturedModesArr())) {
            $newMode = $featured->filterDupeFeaturedModes($newMode, $season);
            $found = TRUE;
        }

        //The following modes are ranked and should be stored separately by SEASON.
        //  - RankedPremade3x3, RankedPremade5x5, RankedSolo5x5,
        //    RankedTeam3x3, RankedTeam5x5
        if(in_array($newMode, $featured->getRankedModesArr())) {
            $newMode = $featured->filterRankedModes($newMode, $season);
            $found = TRUE;
        }

        if($found){
            // Add mode back into mode array with new name. 
            $currentNormStatsArr["playerStatSummaries"][$i]["playerStatSummaryType"] = $newMode;
        }

        //If current season, push all modes.
        //If duplicate mode type ($found == true), push mode
        //If ranked mode or featured mode, push mode
        if($s == sizeof($seasons)-1 || $found || $featured->isFeaturedMode($newMode)){
            array_push($modes, $currentNormStatsArr["playerStatSummaries"][$i]);
        }
    }
}

if($DEBUG_FLAG){
    $lolapi->varDump($modes);
}

/*
//=========Current player recent games=========
//Slows down site due to API throttling.
$recentGamesUrl = $lolapi->getRecentGames($baseurl, $currentSummId, $apikey);
$objRecentGamesArr = $lolapi->jsonToArray($recentGamesUrl);

//Returned recent games json and converted array
if($DEBUG_FLAG){
    //echo $recentGamesUrl;
    $lolapi->varDump($objRecentGamesArr);
} 

for($i = 0; $i < 10; $i++){
    ${'recentMatch' . $i} = array();
    $currentChampId = $objRecentGamesArr["games"][$i]["championId"];
    $staticChampData = $lolapi->getChampionData($staticbaseurl, $regionurl, $currentChampId, $apikey);
    $objStaticChampArr = $lolapi->jsonToArray($staticChampData);

    //Returned recent games json and converted array
    if($DEBUG_FLAG){
        //echo $recentGamesUrl;
        $lolapi->varDump($objStaticChampArr);
    }
     
    ${'recentMatch' . $i}["champName"] = $objStaticChampArr["name"];
    ${'recentMatch' . $i}["mode"] = $objRecentGamesArr["games"][$i]["subType"]; //needs to be translated
    ${'recentMatch' . $i}["team"] = $objRecentGamesArr["games"][$i]["teamId"]; //needs to be translated
    ${'recentMatch' . $i}["spell1"] = $lolapi->getSpellName($regionurl, $objRecentGamesArr["games"][$i]["spell1"], $apikey);
    ${'recentMatch' . $i}["spell2"] = $lolapi->getSpellName($regionurl, $objRecentGamesArr["games"][$i]["spell2"], $apikey);
}
*/
?>