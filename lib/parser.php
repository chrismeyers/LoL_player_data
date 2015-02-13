<?php
include '../lib/lolapi.php';
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
$jsonStatSummary = $lolapi->getStatSummary($baseurl, $currentSummId, $apikey, "SEASON2014");
$objNormStatsArr = $lolapi->jsonToArray($jsonStatSummary);

//Returned normal stats json and converted array
//decho $jsonStatSummary;
//echo "<br />";
//echo "<pre>"; var_dump($objNormStatsArr); echo "</pre>";
//echo "<br /><br />";

$jsonStatSummary2015 = $lolapi->getStatSummary($baseurl, $currentSummId, $apikey, "SEASON2015");
$objNormStatsArr2015 = $lolapi->jsonToArray($jsonStatSummary2015);

//Returned normal stats json and converted array
//decho $jsonStatSummary2015;
//echo "<br />";
//echo "<pre>"; var_dump($objNormStatsArr2015); echo "</pre>";
//echo "<br /><br />";

//Number of game modes
$gameModes = sizeof($objNormStatsArr["playerStatSummaries"]);

//Add modes before 2015
$modes = array();
for($i = 0; $i < $gameModes; $i++){
    $newMode = $objNormStatsArr["playerStatSummaries"][$i]["playerStatSummaryType"];
    array_push($modes, $newMode);
    
}

//Add new 2015 game modes
$gameModes2015 = sizeof($objNormStatsArr2015["playerStatSummaries"]);
$newmodes = array();
for($j = 0; $j < $gameModes2015; $j++){
    $found = FALSE;
    $oldMode = 0;
    $modeFrom2015 = $objNormStatsArr2015["playerStatSummaries"][$j]["playerStatSummaryType"];
    
    while($oldMode < $gameModes){
        $oldModeName = $objNormStatsArr["playerStatSummaries"][$oldMode]["playerStatSummaryType"];
        if(strcmp($modeFrom2015, $oldModeName) == 0){
            $found = TRUE;
            break;
        }
        $oldMode++;
    }
    if($found == FALSE){
        array_push($newmodes, $objNormStatsArr2015["playerStatSummaries"][$j]);
        array_push($modes, $modeFrom2015);
    }
}
for($addNew = 0; $addNew < sizeof($newmodes); $addNew++){
    array_push($objNormStatsArr["playerStatSummaries"], $newmodes[$addNew]);
}

//echo "<pre>"; var_dump($modes); echo "</pre>";

//Generate variable with stats for all modes
foreach($modes as $mode){
    $currentModeIndex = array_search($mode, $modes);
    $currentModeStatValues = $objNormStatsArr["playerStatSummaries"]
                                             [$currentModeIndex]
                                             ["aggregatedStats"];

    //Mode stat arrays
    ${$mode . 'Stats'} = array();

    //Mode win variable
    ${$mode . 'Wins'} = $objNormStatsArr["playerStatSummaries"]
                                        [$currentModeIndex]["wins"];
    
    foreach($currentModeStatValues as $stat){
        //Get Current stat name from array
        $currentStatName = array_search($stat, $currentModeStatValues);
        //Add entry to current gamemode array
        ${$mode . 'Stats'}[$currentStatName] = $stat;
    }
    //echo "<pre>"; var_dump(${$mode . 'Stats'}); echo "</pre>";
    //echo "<br />";
}

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