<?php
    echo 
    "<form action='main.php' method='get' target='_top'>
        <input class='inputbox-mod inputbox-mod-name' type='text' placeholder='Summoner Name' name='name'>

        <select class='inputbox-mod inputbox-mod-region' name='region' id='region'>
            <option value='na'>na</option>
            <option value='euw'>euw</option>
            <option value='eune'>eune</option>
            <option value='br'>br</option>
            <option value='kr'>kr</option>
            <option value='lan'>lan</option>
            <option value='las'>las</option>
            <option value='oce'>oce</option>
            <option value='ru'>ru</option>
            <option value='tr'>tr</option>
        </select>

        <br /><br />
        
        <button class='submit-button' type='submit'>Search</button>
        <button class='submit-button' type='reset' name='reset' 
                onclick='window.location='index.php''>Reset</button>
    </form>"
?>