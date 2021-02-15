<?php

function reqlib($libName) {
    require_once($_SERVER["DOCUMENT_ROOT"].'/MindQuiz2/library/'.$libName.'.php');
}

?>