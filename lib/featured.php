<?php
class Featured{
    private $featuredmodes = array(
        "CounterPick", "URF", "Hexakill", "KingPoro",
        "NightmareBot", "OneForAll5x5", "SummonersRift6x6", "Ascension", 
        "OneForAll5x5", "FirstBlood1x1", "FirstBlood2x2", "Bilgewater");

    private $dupeFeaturedModes = array(
        "OneForAll5x5", "URF", "URFBots", "Hexakill");

    public function getDupeFeaturedModesArr() {
        return $this->dupeFeaturedModes;
    }
    
    public function isFeaturedMode($modeCheck){
        if(in_array($modeCheck, $this->featuredmodes)){
            return TRUE;
        }
        return FALSE;
    }

    public function filterDupeFeaturedModes($newmode, $season) {
        //One for all orginal
        if(strcmp($newmode, "OneForAll5x5") == 0 && strcmp($season, "SEASON3") == 0){
            return $newmode . "Original";
        }
        //One for all mirror
        else if(strcmp($newmode, "OneForAll5x5") == 0 && strcmp($season, "SEASON2014") == 0){
            return $newmode . "Mirror";
        }
        //URF 2014
        else if((strcmp($newmode, "URF") == 0 || strcmp($newmode, "URFBots") == 0) && strcmp($season, "SEASON2014") == 0){
            return $newmode . "2014";
        }
        //Hexakill TT original
        else if(strcmp($newmode, "Hexakill") == 0 && strcmp($season, "SEASON2014") == 0){
            return $newmode . "TTOriginal";
        }
        //URF 2015
        else if((strcmp($newmode, "URF") == 0 || strcmp($newmode, "URFBots") == 0) && strcmp($season, "SEASON2015") == 0){
            return $newmode . "2015";
        }
        //Hexakill TT with Bans
        else if(strcmp($newmode, "Hexakill") == 0 && strcmp($season, "SEASON2015") == 0){
            return $newmode . "TTBans";
        }
        //One for all 2015
        else if(strcmp($newmode, "OneForAll5x5") == 0 && strcmp($season, "SEASON2015") == 0){
            return $newmode . "2015";
        }
    }
}
