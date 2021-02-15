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

function getWordOptions() {

    $words = SQL("SELECT * FROM words");

    foreach ($words as $word) {
        $id = $word['id'];
        $word = $word['word'];

        echo '<option ';
        echo 'value="'. $id .'"';
        echo '>';

        echo $word;

        echo '</option>';
    }
}

?>