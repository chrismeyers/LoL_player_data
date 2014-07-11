<!DOCTYPE html>
<html>
    <head>
        <title>LoL player data</title>
        <link rel="shortcut icon" href="images/lol_guy.ico">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="Author" content="Chris Meyers" />
        
        <!-- CSS -->
        <link rel="stylesheet" href="custom.css">
        <!-- jQuery -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>
        
<?php include 'parser.php'; //Parsing Logic ?>
        
    </head>

    <body>
        <div id="main">
            <table class="centered">
                <td class="icon">
                    <h1> 
                        <?php 
                        echo $userName . "<br /> Level: " .$summLvl;
                        echo "<br />";
                        switch($regionurl){
                          case("na"):
                              echo "North America";
                              break;
                          case("euw"):
                              echo "Europe West";
                              break;
                          case("eune"):
                              echo "Europe Nordic/East";
                              break;
                          case("br"):
                              echo "Brazil";
                              break;
                          case("kr"):
                              echo "Korea";
                              break;
                          case("lan"):
                              echo "Latin America North";
                              break;
                          case("las"):
                              echo "Latin America South";
                              break;
                          case("oce"):
                              echo "Oceanic";
                              break;
                          case("ru"):
                              echo "Russia";
                              break;
                          case("tr"):
                              echo "Turkey";
                              break;
                          default:
                              echo "Somewhere on earth, maybe.";
                              break;
                        }
                        ?> 
                    </h1>
                </td>
                <td class="icon">
                    <img src="<?php echo $currentSummAvatar; ?>">
                </td>
            </table>
            
            
            <br /><br />

            <?php 
            //echo $AramUnranked5x5Wins . " " . $AramUnranked5x5Stats['totalChampionKills'] . "<br />";
            foreach($modes as $currentMode){
                echo "<b>" . $currentMode  . "</b><br />";
                echo "Wins: " . ${$currentMode . 'Wins'} . "<br />";

                $currentStatArray = ${$currentMode . 'Stats'};
                foreach($currentStatArray as $currentStat){
                    echo ucfirst(preg_replace('/(?!^)[[:upper:]]+/',' \0', 
                                 array_search($currentStat, $currentStatArray) . 
                                 ": <span class='values'>" . $currentStat . "</span><br />"));
                }
                echo "<br /><br />";
            }
            ?>
        </div>
    </body>
</html>
