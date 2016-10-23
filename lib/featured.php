<?php
class Featured{
    private $featuredmodes = array(
        "CounterPick", "URF", "Hexakill", "KingPoro",
        "NightmareBot", "OneForAll5x5", "SummonersRift6x6", "Ascension", 
        "OneForAll5x5", "FirstBlood1x1", "FirstBlood2x2", "Bilgewater");

    private $dupeFeaturedModes = array(
        "OneForAll5x5", "URF", "URFBots", "Hexakill", "Ascension",
        "NightmareBot");

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
        switch($season){
            case "SEASON3": {
                switch($newmode){
                    case "OneForAll5x5":
                        return $newmode . "_Original";
                }
            }
            case "SEASON2014": {
                switch($newmode){
                    case "OneForAll5x5":
                        return $newmode . "_Mirror";
                    case "URF":
                    case "URFBots":
                        return $newmode . "_2014";
                    case "Hexakill":
                        return $newmode . "_TT_Original";
                    case "Ascension":
                        return $newmode . "_Original";
                    case "NightmareBot":
                        return $newmode . "_Original";
                }
            }
            case "SEASON2015": {
                switch($newmode){
                    case "OneForAll5x5":
                        return $newmode . "_2015";
                    case "URF":
                    case "URFBots":
                        return $newmode . "_2015";
                    case "Hexakill":
                        return $newmode . "_TT_Bans";
                }
            }
            case "SEASON2016": {
                switch($newmode){
                    case "URF":
                    case "URFBots":
                        return $newmode . "_2016";
                    case "Hexakill":
                        return $newmode . "_2016";
                    case "Ascension":
                        return $newmode . "_2016";
                    case "OneForAll5x5":
                        return $newmode . "_2016";
                    case "NightmareBot":
                        return $newmode . "_Teemo";
                }
            }
            default: {
                return "_Kappa";
            }
        }
    }

    public function filterRankedModes($newmode, $season){
        return $newmode . "_" . $season;
    }
}
