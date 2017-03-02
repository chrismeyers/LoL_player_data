<?php
include 'lolapi.php';
include 'featured.php';
include 'translations.php';

$DEBUG_FLAG = FALSE;

$translator = new Translations();
$lolapi = new lolapi();
$featured = new Featured();

$lolapi->setCurrentRegion($_GET['region']);
$apikey = $lolapi->buildApiKeyUrl();

//=========Parsing user data=========
$summoner = $lolapi->getSummoner(($_GET['name']));
$jsonSumm = $lolapi->getSummonerData($summoner, $apikey);

//HTTP Error handling.
if(in_array($jsonSumm, $lolapi->possibleErrors())){ 
    header('Location: ../web/index.php?e=' . $jsonSumm);
    exit();
}

$summArr = $lolapi->jsonToArray($jsonSumm);
$lolapi->setSummonerArray($summArr);

//Returned json and converted array
if($DEBUG_FLAG){
    $lolapi->varDump($summArr);
}

//Save user data to vars
$currentSummId = $lolapi->getSummonerId($summoner);
$userName = $lolapi->getFormattedName($summoner);
$summLvl = $lolapi->getSummonerLevel($summoner);
$currentSummAvatar = $lolapi->buildAvatarUrl($summoner);


//=========Current player stat summary=========
$seasons = $translator->getSeasonKeys();
$modes = array();
$statsFound = FALSE;

for($s = 0; $s < sizeof($seasons); $s++){
    $season = $seasons[$s];

    $currentjsonStatSummary = $lolapi->getStatSummary($currentSummId, $apikey, $season);
    $currentNormStatsArr = $lolapi->jsonToArray($currentjsonStatSummary);
    
    $currentSeasonNumGameModes = sizeof($currentNormStatsArr["playerStatSummaries"]);
    $statsFound = ($statsFound || $currentSeasonNumGameModes > 0) ? TRUE : FALSE;
    
    for($i = 0; $i < $currentSeasonNumGameModes; $i++){
        $newMode = $currentNormStatsArr["playerStatSummaries"][$i]["playerStatSummaryType"];
        $found = FALSE;

        // Several modes appear in multiple seasons and require a suffix
        // to remove ambiguity.
        if(in_array($newMode, $featured->getDupeFeaturedModesArr())) {
            $newMode = $featured->filterDupeFeaturedModes($newMode, $season);
            $found = TRUE;
        }

        // Ranked modes should be stored separately by SEASON.
        if(in_array($newMode, $featured->getRankedModesArr())) {
            $newMode = $featured->filterRankedModes($newMode, $season);
            $found = TRUE;
        }

        if($found){
            // Add mode back into mode array with new name. 
            $currentNormStatsArr["playerStatSummaries"][$i]["playerStatSummaryType"] = $newMode;
        }

        $modes[$newMode] = $currentNormStatsArr["playerStatSummaries"][$i];
    }
}

if($DEBUG_FLAG){
    $lolapi->varDump($modes);
}

/*
//=========Current player recent games=========
// !!!!! Slows down site due to API throttling. !!!!!
$recentGamesUrl = $lolapi->getRecentGames($currentSummId, $apikey);
$objRecentGamesArr = $lolapi->jsonToArray($recentGamesUrl);

//Returned recent games json and converted array
if($DEBUG_FLAG){
    $lolapi->varDump($objRecentGamesArr);
} 

for($i = 0; $i < 10; $i++){
    ${'recentMatch' . $i} = array();
    $currentChampId = $objRecentGamesArr["games"][$i]["championId"];
    $staticChampData = $lolapi->getChampionData($currentChampId, $apikey);
    $objStaticChampArr = $lolapi->jsonToArray($staticChampData);

    //Returned recent games json and converted array
    if($DEBUG_FLAG){
        $lolapi->varDump($objStaticChampArr);
    }
     
    ${'recentMatch' . $i}["champName"] = $objStaticChampArr["name"];
    ${'recentMatch' . $i}["mode"] = $objRecentGamesArr["games"][$i]["subType"]; //needs to be translated
    ${'recentMatch' . $i}["team"] = $objRecentGamesArr["games"][$i]["teamId"]; //needs to be translated
    ${'recentMatch' . $i}["spell1"] = $lolapi->getSpellName($objRecentGamesArr["games"][$i]["spell1"], $apikey);
    ${'recentMatch' . $i}["spell2"] = $lolapi->getSpellName($objRecentGamesArr["games"][$i]["spell2"], $apikey);
}
*/
?>
