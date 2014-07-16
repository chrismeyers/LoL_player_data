<?php
include '../lib/lolapi.php';
$lolapi = new lolapi();

//=========Determine region=========
$regionurl = $lolapi->getRegion($_GET['region']);

//=========Core url data=========
$baseurl = $lolapi->buildBaseUrl($regionurl);
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
    header('Location: ../index.php?e=' . $jsonSumm);
    exit();
}

$objSummArr = $lolapi->jsonToArray($jsonSumm);

//Returned json and converted array
//echo $jsonSumm;
//echo "<br />";
//echo "<pre>"; var_dump($objSummArr); echo "</pre>";

//Save user data to vars
$currentSummID = $lolapi->getSummonerId($objSummArr, $summoner);
$userName = $lolapi->getFormattedName($objSummArr, $summoner);
$summLvl = $lolapi->getSummonerLevel($objSummArr, $summoner);
$currentSummAvatar = $lolapi->buildAvatarUrl($regionurl, $summoner);


//echo "<br /><br />";
//=========Current player normal stats=========
$jsonStatSummary = $lolapi->getStatSummary($baseurl, $statsurl, $currentSummID, 
                                           $summarystatsurl, $apikey);
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

//=========Current player ranked stats=========
//$jsonRankStats = file_get_contents($baseurl . $statsurl . $currentSummID . $rankedstatsurl . $apikey); //ranked stats query
//$objRankStatsArr = json_decode($jsonRankStats, true);

//Returned ranked json and converted array
//echo $jsonRankStats;
//echo "<br />";
//echo "<pre>"; var_dump($objRankStatsArr); echo "</pre>";
?>