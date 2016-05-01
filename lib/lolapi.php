<?php

class lolapi{
    private $summonerdataurl = "/v1.4/summoner/by-name/";
    private $championdataurl = "/v1.2/champion/";
    private $statsurl = "/v1.3/stats/by-summoner/";
    private $gameurl = "/v1.3/game/by-summoner/";
    private $spellsurl = "/v1.2/summoner-spell/";
    private $staticdataurl = "/static-data/";
    private $recenturl = "/recent/";
    private $summarystatsurl = "/summary/";
    private $rankedstatsurl = "/ranked/";
    private $apikeytext = "?api_key=";
    
    //=========Background player data=========
    public function buildBaseUrl($region){
        return "https://" . $region . ".api.pvp.net/api/lol/" . $region;
    }
    
    public function buildStaticBaseUrl($region){
        return "https://" . $region . ".api.pvp.net/api/lol";
    }
    
    public function buildApiKeyUrl(){
        return $this->apikeytext . file_get_contents('../notes/key.txt');
    }

    public function translateRegion($region){
        switch($region){
          case "na":
              return "North America";
          case "euw":
              return "Europe West";
          case "eune":
              return "Europe Nordic/East";
          case "br":
              return "Brazil";
          case "kr":
              return "Korea";
          case "lan":
              return "Latin America North";
          case "las":
              return "Latin America South";
          case "oce":
              return "Oceanic";
          case "ru":
              return "Russia";
          case "tr":
              return "Turkey";
          default:
              return "Somewhere on earth, maybe.";
        }
    }
    
    //=========Current player data=========
    public function buildAvatarUrl($region, $name){
        return "http://avatar.leagueoflegends.com/" . $region . "/" . $name .".png";
    }
    
    public function getSummonerDataUrl(){
        return $this->summonerdataurl;
    }
    
    public function getChampionDataUrl(){
        return $this->championdataurl;
    }
    
    public function getStatsUrl(){
        return $this->statsurl;
    }
    
    public function getSummaryStatsUrl(){
        return $this->summarystatsurl;
    }
    
    public function getSpellsUrl(){
        return $this->spellsurl;
    }
    
    public function getStaticDataUrl(){
        return $this->staticdataurl;
    }
    
    public function getRankedStatsUrl(){
        return $this->rankedstatsurl;
    }
    
    public function getSummoner($name){
        return str_replace(' ', '', strtolower($name));
    }
    
    public function getSummonerId($summonerArray, $name){
        return $summonerArray[$name]["id"];
    }
    
    public function getFormattedName($summonerArray, $name){
        return $summonerArray[lcfirst($name)]["name"];
    }

    public function getSummonerLevel($summonerArray, $name){
        return $summonerArray[lcfirst($name)]["summonerLevel"];
    }
    
    /*
     * Returns Summoner data JSON if name is valid.  Otherwise, an error code
     * corresponding to the HTTP response is returned.
     */
    public function getSummonerData($baseurl, $summonerdataurl, $summoner, $apikey){
        $jsonSumm = @file_get_contents($baseurl 
                                       . $summonerdataurl 
                                       . $summoner 
                                       . $apikey);  //summoner query
        
        $http_code = $this->error($http_response_header);
        if($http_code == NULL){
            return $jsonSumm;
        }
        else{
            return $http_code;
        }
    
    }
    
    //=========Stat summary=========
    public function getStatSummary($baseurl, $currentSummId, $apikey, $season){ 
        return @file_get_contents($baseurl . $this->statsurl 
                                           . $currentSummId 
                                           . $this->summarystatsurl 
                                           . $apikey 
                                           . "&season=" . $season); 
    }
    
    //=========Static Data=========
        //Does NOT count towards query limit
    public function getChampionData($region, $champId, $apikey){
        return @file_get_contents($this->buildStaticBaseUrl($region)  
                                  . $this->staticdataurl 
                                  . $region
                                  . $this->championdataurl
                                  . $champId 
                                  . $apikey); 
    }
    
    public function getSpellName($region, $id, $apikey){
        $spellJson = @file_get_contents($this->buildStaticBaseUrl($region) 
                                        . $this->staticdataurl
                                        . $region 
                                        . $this->spellsurl 
                                        . $id 
                                        . $apikey);
        $spellArr = $this->jsonToArray($spellJson);
        
        return $spellArr["name"];
    }
    
    //=========Recent games=========
    public function getRecentGames($baseurl, $currentSummId, $apikey){
        return @file_get_contents($baseurl 
                                  . $this->gameurl
                                  . $currentSummId
                                  . $this->recenturl 
                                  . $apikey);
    }
    
    //=========JSON conversion=========
    public function jsonToArray($json){
        return json_decode($json, true);
    }
    
    //=========Error Handling=========
    public function possibleErrors(){
        return array(400, 401, 404, 429, 500, 503);
    }
    
    public function error($errorResponse){
        $error_str = explode(' ', $errorResponse[0]);
        $code = NULL;
        // $error_str[0] = "HTTP/1.1"
        // $error_str[1] = ERROR_CODE
        // $error_str[2..n-1] = ERROR_MSG words 

        switch($error_str[1]){
            case(400):
                $code = 400;
                break;
            case(401):
                $code = 401;
                break;
            case(404):
                $code = 404;
                break;
            case(429):
                $code = 429;
                break;
            case(500):
                $code = 500;
                break;
            case(503):
                $code = 503;
                break;
        }
        return $code;
    }
    
    //=============DEBUG==============
    public function varDump($var){
        echo "<br />";
        echo "<pre>"; var_dump($var); echo "</pre>";
        echo "<br /><br />";
    }
}