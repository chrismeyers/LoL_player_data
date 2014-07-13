<?php
//=========Determine region=========
$regionurl = "";
switch(strtolower($_GET['region'])){
    case "na":
        $regionurl = "na";
        break;
    case "euw":
        $regionurl = "euw";
        break;
    case "eune":
        $regionurl = "eune";
        break;
    case "br":
        $regionurl = "br";
        break;
    case "kr":
        $regionurl = "kr";
        break;
    case "lan":
        $regionurl = "lan";
        break;
    case "las":
        $regionurl = "las";
        break;
    case "oce":
        $regionurl = "oce";
        break;
    case "ru":
        $regionurl = "ru";
        break;
    case "tr":
        $regionurl = "tr";
        break;
    default:
        $regionurl = "???";
        echo "Region not supported.";
}

//=========Core url data=========
$baseurl = "https://" . $regionurl . ".api.pvp.net/api/lol/" . $regionurl;
$summonerdataurl = "/v1.4/summoner/by-name/";
$championdataurl = "/v1.2/champion/";
$statsurl = "/v1.3/stats/by-summoner/";
$normalstatsurl = "/summary";
$rankedstatsurl = "/ranked";
$apikey = "?api_key=" . file_get_contents('./notes/key.txt');

//=========Parsing user data=========
$summoner = str_replace(' ', '', $_GET['name']);
$jsonSumm = @file_get_contents($baseurl . $summonerdataurl . $summoner . 
                              $apikey);  //summoner query

//Error handling if name is invalid.
if($jsonSumm === false){
    header('Location: index.php?e=404');
    exit();
}

$objSummArr = json_decode($jsonSumm, true);

//Returned json and converted array
//echo $jsonSumm;
//echo "<br />";
//echo "<pre>"; var_dump($objSummArr); echo "</pre>";

//Save user data to vars
$currentSummID = $objSummArr[lcfirst($summoner)]["id"];
$userName = $objSummArr[lcfirst($summoner)]["name"];
$summLvl = $objSummArr[lcfirst($summoner)]["summonerLevel"];
$currentSummAvatar = "http://avatar.leagueoflegends.com/" . $regionurl 
                        . "/" . $summoner .".png";


//echo "<br /><br />";
//=========Current player normal stats=========
$jsonNormStats = file_get_contents($baseurl . $statsurl . $currentSummID 
                      . $normalstatsurl . $apikey); //normal stats query
$objNormStatsArr = json_decode($jsonNormStats, true);

//Returned normal json and converted array
//echo $jsonNormStats;
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
/*echo $jsonRankStats;
echo "<br />";
echo "<pre>"; var_dump($objRankStatsArr); echo "</pre>";*/
?>