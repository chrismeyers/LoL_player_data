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
        "OneForAll5x5Vanilla" => "One for All",
        "OneForAll5x5Mirror" => "One for All: Mirror",
        "FirstBlood1x1" =>  "First Blood 1v1",
        "FirstBlood2x2" => "First Blood 2v2", 
        "SummonersRift6x6" => "Hexakill: Summoner's Rift",
        "HexakillTTOriginal" => "Hexakill: Twisted Treeline, Original",
        "HexakillTTBans" => "Hexakill: Twisted Treeline, with Bans",
        "CAP5x5" => "Team Builder",
        "URF" => "Ultra Rapid Fire (URF)",
        "URFBots" => "Ultra Rapid Fire (URF) Bots",
        "URF2014" => "Ultra Rapid Fire (URF) 2014",
        "URFBots2014" => "Ultra Rapid Fire (URF) Bots 2014",
        "URF2015" => "Ultra Rapid Fire (URF) 2015",
        "URFBots2015" => "Ultra Rapid Fire (URF) Bots 2015",
        "Ascension" => "Ascension",
        "KingPoro" => "Legend of the Poro King",
        "CounterPick" => "Nemesis Draft"
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
    
    function translateAllModes($allModes){
        $tempModesArr = array();
        foreach($allModes as $mode){
            $translatedName = $this->translateModeSummary($mode["playerStatSummaryType"]);
            $mode["playerStatSummaryType"] = $translatedName;
            array_push($tempModesArr, $mode);
        }
        sort($tempModesArr);
        return $tempModesArr;
    }
    
    function translateModeRecent($rawMode){
        return $this->gameModeNamesRecent[$rawMode];
    }
    
    function translateTeam($teamCode){
        if($teamCode === 100){
            return "Blue Team";
        }
        else{
            return "Red Team";
        }
    }
}