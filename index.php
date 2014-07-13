<!DOCTYPE html>
<html>
    <head>
        <title>LoL player data</title>
        <link rel="shortcut icon" href="images/lol_guy.ico">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="Author" content="Chris Meyers" />

        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
        
        <link rel="stylesheet" href="custom.css">
        <link rel="stylesheet" href="simplemodal/basic/css/basic.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="simplemodal/basic/css/basic_ie.css" type="text/css" media="screen" />

        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script type="text/javascript" src="simplemodal/basic/js/jquery.simplemodal.js"></script>
        
    </head>

    <body>
        <div id="namebox">
            Please enter a Summoner name:
            <?php if (!empty($_GET['e'])) {
                        $message = $_GET['e'];
                        switch($message){
                            case(404):
                                echo "<br /> Summoner not found.";
                        }
                    } ?>
            <br /><br />
            <form action="main.php" method="get" target="_top">
                <input class="inputbox-mod" type="text" placeholder="Name" name="name">

                <select class="inputbox-mod" name="region">
                    <option value="na">na</option>
                    <option value="euw">euw</option>
                    <option value="eune">eune</option>
                    <option value="br">br</option>
                    <option value="kr">kr</option>
                    <option value="lan">lan</option>
                    <option value="las">las</option>
                    <option value="oce">oce</option>
                    <option value="ru">ru</option>
                    <option value="tr">tr</option>
                </select>

                <br /><br />
                
                <button class="submit-button" type="submit">Search</button>
                <button class="submit-button" type="reset" name="reset" 
                        onclick="window.location='index.php'">Reset</button>
            </form>
        </div>
        
        <?php include 'footer.php'; ?>
        
    </body>
</html>