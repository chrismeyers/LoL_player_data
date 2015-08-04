<?php
class Featured{
    private $featuredmodes = array(
        "CounterPick", "URF", "Hexakill", "KingPoro",
        "NightmareBot", "OneForAll5x5", "SummonersRift6x6", "Ascension", 
        "OneForAll5x5", "FirstBlood1x1", "FirstBlood2x2", "Bilgewater");
    
    public function isFeaturedMode($modeCheck){
        if(in_array($modeCheck, $this->featuredmodes)){
            return TRUE;
        }
        return FALSE;
    }
}
