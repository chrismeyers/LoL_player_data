<?php
echo "<div id='footer'>
            <a id='simplemodal-about' class='footer-links'>about</a>
            &nbsp;&bull;&nbsp; 
            <a href='index.php' class='footer-links'> home </a> 
            &nbsp;&bull;&nbsp 
            <a id='simplemodal-legal' class='footer-links'>legal</a>
        </div>
        
        <div id='about' style='display:none;'>
            <h1 style='text-align: center;'>about</h1>
            This is a summer project that I am working on based on the video
            game League of Legends. It is very much in development. Currently,
            you can enter a player name and various information about this
            player will be parsed and presented to you. This information
            includes: summoner name, level, region, icon and a listing of all
            game mode stats that the player has earned.<br /><br />
            <a class='simplemodal-close'>close</a>
        </div>
        <div id='legal' style='display:none;'>
            <h1 style='text-align: center;'>legal</h1>
            LoL_player_data isn’t endorsed by Riot Games and doesn’t reflect the
            views or opinions of Riot Games or anyone officially involved in 
            producing or managing <i>League of Legends</i>. <i>League of Legends</i>
            and Riot Games are trademarks or registered trademarks of Riot
            Games, Inc. <i>League of Legends</i> &COPY; Riot Games, Inc.
        </div>
        
        <script>
            $('#simplemodal-about').click(function() {
                $('#about').modal({
                    overlayClose:true
                });
            });
            $('#simplemodal-legal').click(function() {
                $('#legal').modal({
                    overlayClose:true
                });
            });
        </script>";
?>