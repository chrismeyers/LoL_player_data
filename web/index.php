<!DOCTYPE html>
<html>
    <head>
        <title>LoL player data</title>
        <link rel="shortcut icon" href="../images/lol_guy.ico">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="Author" content="Chris Meyers" />
        
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
        
        <link rel="stylesheet" href="custom.css">
        <link rel="stylesheet" href="custom-small.css">
        <link rel="stylesheet" href="../simplemodal/basic/css/basic.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="../simplemodal/basic/css/basic_ie.css" type="text/css" media="screen" />

        <script type="text/javascript" src="../scripts/vendor/jquery-2.2.4.min.js"></script>
        <script type="text/javascript" src="../simplemodal/basic/js/jquery.simplemodal.js"></script>
        
    </head>

    <body>
        <div id="namebox">
            
            Please enter a Summoner name:
            <?php 
            if (!empty($_GET['e'])) {
                    $message = $_GET['e'];
                    switch($message){
                        case(400):
                            echo "<br /> <span class='error'>Bad request. Unspecified Summoner name.</span>";
                            break;
                        case(401):
                            echo "<br /> <span class='error'>Unauthorized.</span>";
                            break;
                        case(404):
                            echo "<br /> <span class='error'>Summoner not found.</span>";
                            break;
                        case(429):
                            echo "<br /> <span class='error'>Rate limit exceeded.</span>";
                            break;
                        case(500):
                            echo "<br /> <span class='error'>Internal server error.</span>";
                            break;
                        case(503):
                            echo "<br /> <span class='error'>Service unavailable.</span>";
                            break;
                    }}?><br /><br />
                        
            <?php include 'summonerForm.php'; ?>
        </div>
        
        <?php include 'footer.php'; ?>
             
    </body>
</html>