<?php
class Featured{
    private $featuredmodes = array(
        "CounterPick", "URF", "Hexakill", "KingPoro",
        "NightmareBot", "OneForAll5x5", "SummonersRift6x6", "Ascension", 
        "OneForAll5x5", "FirstBlood1x1", "FirstBlood2x2", "Bilgewater");

    private $dupeFeaturedModes = array(
        "OneForAll5x5", "URF", "URFBots", "Hexakill", "Ascension");

    private $rankedModes = array(
        "RankedPremade3x3", "RankedPremade5x5", "RankedSolo5x5",
        "RankedTeam3x3", "RankedTeam5x5");

    public function getDupeFeaturedModesArr() {
        return $this->dupeFeaturedModes;
    }
    
    public function getRankedModesArr() {
        return $this->rankedModes;
    }

    public function isFeaturedMode($modeToCheck){
        if(in_array($modeToCheck, $this->featuredmodes)){
            return TRUE;
        }
        return FALSE;
    }

    public function isRankedMode($modeToCheck){
        if(in_array($modeToCheck, $this->rankedModes)){
            return TRUE;
        }
        return FALSE;
    }

    public function filterDupeFeaturedModes($newmode, $season) {
        //One for all orginal
        if(strcmp($newmode, "OneForAll5x5") == 0 && strcmp($season, "SEASON3") == 0){
            return $newmode . "_Original";
        }
        //One for all mirror
        else if(strcmp($newmode, "OneForAll5x5") == 0 && strcmp($season, "SEASON2014") == 0){
            return $newmode . "_Mirror";
        }
        //URF 2014
        else if((strcmp($newmode, "URF") == 0 || strcmp($newmode, "URFBots") == 0) && strcmp($season, "SEASON2014") == 0){
            return $newmode . "_2014";
        }
        //Hexakill TT original
        else if(strcmp($newmode, "Hexakill") == 0 && strcmp($season, "SEASON2014") == 0){
            return $newmode . "_TT_Original";
        }
        //URF 2015
        else if((strcmp($newmode, "URF") == 0 || strcmp($newmode, "URFBots") == 0) && strcmp($season, "SEASON2015") == 0){
            return $newmode . "_2015";
        }
        //Hexakill TT with Bans
        else if(strcmp($newmode, "Hexakill") == 0 && strcmp($season, "SEASON2015") == 0){
            return $newmode . "_TT_Bans";
        }
        //One for all 2015
        else if(strcmp($newmode, "OneForAll5x5") == 0 && strcmp($season, "SEASON2015") == 0){
            return $newmode . "_2015";
        }
        //Ascension Shurima Event
        else if(strcmp($newmode, "Ascension") == 0 && strcmp($season, "SEASON2014") == 0){
            return $newmode . "_Original";
        }
        //Ascension Rotating 2016
        else if(strcmp($newmode, "Ascension") == 0 && strcmp($season, "SEASON2016") == 0){
            return $newmode . "_2016";
        }
    }

    public function filterRankedModes($newmode, $season){
        return $newmode . "_" . $season;
    }
}
