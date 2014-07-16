<?php
class Translations{
    private $gameModeNames = array(
        "AramUnranked5x5" => "ARAM",
        "CoopVsAI" => "Coop vs AI 5v5",
        "CoopVsAI3x3" => "Coop vs AI 3v3",
        "OdinUnranked" => "Dominion",
        "RankedPremade3x3" => "Ranked Premade 3v3",
        "RankedPremade5x5" => "Ranked Premade 5v5",
        "RankedSolo5x5" => "Ranked Solo/Duo",
        "RankedTeam3x3" => "Ranked Teams 3v3",
        "RankedTeam5x5" => "Ranked Teams 5v5",
        "Unranked" => "Normal 5v5",
        "Unranked3x3" => "Normal 3v3",
        "OneForAll5x5" => "One for All",
        "FirstBlood1x1" =>  "First Blood 1v1",
        "FirstBlood2x2" => "First Blood 2v2", 
        "SummonersRift6x6" => "Hexakill",
        "CAP5x5" => "Team Builder",
        "URF" => "Ultra Rapid Fire (URF)",
        "URFBots" => "URF Bots"
    );
    
    function translateMode($rawMode){
        $formattedMode = $this->gameModeNames[$rawMode];
        return $formattedMode;
    }
}