<?php

function getLanguageOptions() {
    
    $languages = SQL("SELECT * FROM languages");

    foreach ($languages as $lang) {
        $id = $lang['id'];
        $name = $lang['name'];

        
        echo '<option ';
        echo 'value="'. $id .'"';
        echo '>';

        echo $name;

        echo '</option>';
    }
}

?>