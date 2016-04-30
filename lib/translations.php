<?php
class Translations{
    private $gameModeNamesSummary = array(
        "AramUnranked5x5"             => "ARAM",
        "CoopVsAI"                    => "Coop vs AI 5v5",
        "CoopVsAI3x3"                 => "Coop vs AI 3v3",
        "NightmareBot"                => "Doom Bots of Doom",
        "OdinUnranked"                => "Dominion",

        "RankedPremade3x3_SEASON3"    => "Ranked Premade 3v3" . " Season 3",
        "RankedPremade5x5_SEASON3"    => "Ranked Premade 5v5" . " Season 3",
        "RankedSolo5x5_SEASON3"       => "Ranked Solo/Duo"    . " Season 3",
        "RankedTeam3x3_SEASON3"       => "Ranked Teams 3v3"   . " Season 3",
        "RankedTeam5x5_SEASON3"       => "Ranked Teams 5v5"   . " Season 3",
 
        "RankedPremade3x3_SEASON2014" => "Ranked Premade 3v3" . " Season 4",
        "RankedPremade5x5_SEASON2014" => "Ranked Premade 5v5" . " Season 4",
        "RankedSolo5x5_SEASON2014"    => "Ranked Solo/Duo"    . " Season 4",
        "RankedTeam3x3_SEASON2014"    => "Ranked Teams 3v3"   . " Season 4",
        "RankedTeam5x5_SEASON2014"    => "Ranked Teams 5v5"   . " Season 4",
 
        "RankedPremade3x3_SEASON2015" => "Ranked Premade 3v3" . " Season 5",
        "RankedPremade5x5_SEASON2015" => "Ranked Premade 5v5" . " Season 5",
        "RankedSolo5x5_SEASON2015"    => "Ranked Solo/Duo"    . " Season 5",
        "RankedTeam3x3_SEASON2015"    => "Ranked Teams 3v3"   . " Season 5",
        "RankedTeam5x5_SEASON2015"    => "Ranked Teams 5v5"   . " Season 5",
 
        "RankedPremade3x3_SEASON2016" => "Ranked Premade 3v3" . " Season 6",
        "RankedPremade5x5_SEASON2016" => "Ranked Premade 5v5" . " Season 6",
        "RankedSolo5x5_SEASON2016"    => "Ranked Solo/Duo"    . " Season 6",
        "RankedTeam3x3_SEASON2016"    => "Ranked Teams 3v3"   . " Season 6",
        "RankedTeam5x5_SEASON2016"    => "Ranked Teams 5v5"   . " Season 6",

        "Unranked"                    => "Normal 5v5",
        "Unranked3x3"                 => "Normal 3v3",
        "OneForAll5x5_Original"       => "One for All Original",
        "OneForAll5x5_Mirror"         => "One for All Mirror",
        "OneForAll5x5_2015"           => "One for All 2015",
        "FirstBlood1x1"               => "First Blood 1v1",
        "FirstBlood2x2"               => "First Blood 2v2", 
        "SummonersRift6x6"            => "Hexakill Summoner's Rift",
        "Hexakill_TT_Original"        => "Hexakill Twisted Treeline",
        "Hexakill_TT_Bans"            => "Hexakill Twisted Treeline w/ Bans",
        "Hexakill_2016"               => "Hexakill 2016",
        "CAP5x5"                      => "Team Builder",
        "URF"                         => "Ultra Rapid Fire (URF)",
        "URFBots"                     => "Ultra Rapid Fire (URF) Bots",
        "URF_2014"                    => "Ultra Rapid Fire (URF) 2014",
        "URFBots_2014"                => "Ultra Rapid Fire (URF) Bots 2014",
        "URF_2015"                    => "Ultra Rapid Fire (URF) 2015",
        "URFBots_2015"                => "Ultra Rapid Fire (URF) Bots 2015",
        "URF_2016"                    => "Ultra Rapid Fire (URF) 2016",
        "URFBots_2016"                => "Ultra Rapid Fire (URF) Bots 2016",
        "Ascension_Original"          => "Ascension",
        "Ascension_2016"              => "Ascension 2016",
        "KingPoro"                    => "Legend of the Poro King",
        "CounterPick"                 => "Nemesis Draft",
        "Bilgewater"                  => "Black Market Brawlers"
    );
    
    private $gameModeNamesRecent = array(
        "NONE"               => "None",
        "NORMAL"             => "Normal",
        "BOT"                => "Bot",
        "RANKED_SOLO_5x5"    => "Ranked Solo/Duo",
        "RANKED_PREMADE_3x3" => "Ranked Premade 3v3",
        "RANKED_PREMADE_5x5" => "Ranked Premade 5v5",
        "ODIN_UNRANKED"      => "Dominion",
        "RANKED_TEAM_3x3"    => "Ranked Teams 3v3",
        "RANKED_TEAM_5x5"    => "Ranked Teams 5v5",
        "NORMAL_3x3"         => "Normal 3v3",
        "BOT_3x3"            => "Bot 3v3",
        "CAP_5x5"            => "Team Builder",
        "ARAM_UNRANKED_5x5"  => "ARAM",
        "ONEFORALL_5x5"      => "One for All",
        "FIRSTBLOOD_1x1"     => "First Blood 1v1",
        "FIRSTBLOOD_2x2"     => "First Blood 2v2",
        "SR_6x6"             => "Hexakill",
        "URF"                => "Ultra Rapid Fire (URF)",
        "URF_BOT"            => "URF Bots",
        "NIGHTMARE_BOT"      => "Doom Bots of Doom",
        "ASCENSION_5x5"      => "Ascension",
        "ASCENSION"          => "Ascension"
    );

    private $seasons = array(
        "SEASON3"    => "Season 3",
        "SEASON2014" => "Season 4",
        "SEASON2015" => "Season 5",
        "SEASON2016" => "Season 6"
    );
    
    function translateModeSummary($rawMode){
        return $this->gameModeNamesSummary[$rawMode];
    }

    function translateModeRecent($rawMode){
        return $this->gameModeNamesRecent[$rawMode];
    }

    function translateSeason($rawMode){
        return $this->seasons[$rawMode];
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
        
    function translateTeam($teamCode){
        if($teamCode === 100){
            return "Blue Team";
        }
        else{
            return "Red Team";
        }
    }

    function getSeasonKeys(){
        return array_keys($this->seasons);
    }
}