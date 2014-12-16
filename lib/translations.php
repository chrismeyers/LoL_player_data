<?php
class Translations{
    private $gameModeNamesSummary = array(
        "AramUnranked5x5" => "ARAM",
        "CoopVsAI" => "Coop vs AI 5v5",
        "CoopVsAI3x3" => "Coop vs AI 3v3",
        "NightmareBot" => "Doom Bots of Doom",
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
        "SummonersRift6x6" => "Hexakill: Summoner's Rift",
        "Hexakill" => "Hexakill: Twisted Treeline",
        "CAP5x5" => "Team Builder",
        "URF" => "Ultra Rapid Fire (URF)",
        "URFBots" => "URF Bots",
        "Ascension" => "Ascension",
        "KingPoro" => "Legend of the Poro King"
    );
    
    private $gameModeNamesRecent = array(
        "NONE" => "None",
        "NORMAL" => "Normal",
        "BOT" => "Bot",
        "RANKED_SOLO_5x5" => "Ranked Solo/Duo",
        "RANKED_PREMADE_3x3" => "Ranked Premade 3v3",
        "RANKED_PREMADE_5x5" => "Ranked Premade 5v5",
        "ODIN_UNRANKED" => "Dominion",
        "RANKED_TEAM_3x3" => "Ranked Teams 3v3",
        "RANKED_TEAM_5x5" => "Ranked Teams 5v5",
        "NORMAL_3x3" => "Normal 3v3",
        "BOT_3x3" => "Bot 3v3",
        "CAP_5x5" => "Team Builder",
        "ARAM_UNRANKED_5x5" => "ARAM",
        "ONEFORALL_5x5" => "One for All",
        "FIRSTBLOOD_1x1" => "First Blood 1v1",
        "FIRSTBLOOD_2x2" => "First Blood 2v2",
        "SR_6x6" => "Hexakill",
        "URF" => "Ultra Rapid Fire (URF)",
        "URF_BOT" => "URF Bots",
        "NIGHTMARE_BOT" => "Doom Bots of Doom",
        "ASCENSION_5x5" => "Ascension"
    );
    
    function translateModeSummary($rawMode){
        return $this->gameModeNamesSummary[$rawMode];
    }
    
    function translateModeRecent($rawMode){
        return $this->gameModeNamesRecent[$rawMode];
    }
    
    function translateTeam($teamCode){
        if($teamCode === 100){
            return "Blue Team";
        }
        else{
            return "Purple Team";
        }
    }
}