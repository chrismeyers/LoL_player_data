<div id="footer">
            <a id="simplemodal-about" class="footer-links">about</a>
            &nbsp;&bull;&nbsp; 
            <a href="index.php" class="footer-links"> home </a> 
            &nbsp;&bull;&nbsp;
            <a id="simplemodal-legal" class="footer-links">legal</a>
        </div>
        
        <div id="about" style="margin-top: 50px; display:none;">
            <h1 style="text-align: center;">about</h1>
            <span class="modaltxt">LoL_player_data is a statistics parser based on the video game
            <i>League of Legends</i>. Upon entering a player name and specifying a region, various
            information about the player will be parsed and presented to you.  This information
            includes: summoner name, level, region, icon and a listing of all game mode stats that
            the player has earned.<br /><br /></span>
            <div style="text-align: center;"><a class="simplemodal-close">close</a></div>
        </div>
        <div id="legal" style="margin-top: 50px; display:none;">
            <h1 style="text-align: center;">legal</h1>
            <span class="modaltxt">LoL_player_data isn’t endorsed by Riot Games and doesn’t reflect the
            views or opinions of Riot Games or anyone officially involved in 
            producing or managing <i>League of Legends</i>. <i>League of Legends</i>
            and Riot Games are trademarks or registered trademarks of Riot
            Games, Inc. <i>League of Legends</i> &COPY; Riot Games, Inc.<br /><br />
            LoL_player_data uses <a href="https://github.com/ericmmartin/simplemodal">SimpleModal</a>
            to display informational windows.<br /><br /></span>
            <div style="text-align: center;"><a class="simplemodal-close">close</a></div>
        </div>

        <script>
            $('#simplemodal-about').click(function() {
                $('#about').modal({
                    overlayClose:true,
                    autoResize:true
                });
            });
            $('#simplemodal-legal').click(function() {
                $('#legal').modal({
                    overlayClose:true,
                    autoResize:true
                });
            });
        </script>
