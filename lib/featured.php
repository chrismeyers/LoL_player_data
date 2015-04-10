<?php
class Featured{
    private $featuredmodes = array(
        "CounterPick", "URF", "Hexakill", "KingPoro", "NightmareBot", "OneForAll5x5",
        "SummonersRift6x6");
    
    public function isFeaturedMode($modeCheck){
        if(in_array($modeCheck, $this->featuredmodes)){
            return TRUE;
        }
        return FALSE;
    }
}
