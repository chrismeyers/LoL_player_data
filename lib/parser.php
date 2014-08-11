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
$jsonStatSummary = $lolapi->getStatSummary($baseurl, $currentSummId, $apikey);
$objNormStatsArr = $lolapi->jsonToArray($jsonStatSummary);

//Returned normal json and converted array
//echo $jsonStatSummary;
//echo "<br />";
//echo "<pre>"; var_dump($objNormStatsArr); echo "</pre>";
//echo "<br /><br />";
  
//Number of game modes
$gameModes = sizeof($objNormStatsArr["playerStatSummaries"]);

$modes = array();
for($i = 0;$i < $gameModes; $i++){
    array_push($modes, $objNormStatsArr["playerStatSummaries"]
                                       [$i]["playerStatSummaryType"]);
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

//=========Current player recent games=========
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

//=========Current player ranked stats=========
//$jsonRankStats = file_get_contents($baseurl . $statsurl . $currentSummId . $rankedstatsurl . $apikey); //ranked stats query
//$objRankStatsArr = json_decode($jsonRankStats, true);

//Returned ranked json and converted array
//echo $jsonRankStats;
//echo "<br />";
//echo "<pre>"; var_dump($objRankStatsArr); echo "</pre>";
?>