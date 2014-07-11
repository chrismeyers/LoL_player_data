<!DOCTYPE html>
<html>
    <head>
        <title>LoL player data</title>
        <link rel="shortcut icon" href="images/lol_guy.ico">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="Author" content="Chris Meyers" />

        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
        
        <link rel="stylesheet" href="custom.css">

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>
        
        
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
            <form action="main.php" method="post" target="_top">
                <input type="text" placeholder="Name" name="name">

                <select name="region">
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

                <br />
                
                <button type="submit">Search</button>
                <button type="reset" name="reset">Reset</button>
            </form>
        </div>
        
    </body>
</html>