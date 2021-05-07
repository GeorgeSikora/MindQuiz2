<?php

if (!isset($_GET['lang'])) die("Language is not selected!");

$lang = $_GET['lang'];

$languageDir = $_SERVER["DOCUMENT_ROOT"].'/MindQuiz2/languages/' . $lang;

if (!file_exists($languageDir)) die('Tento jazyk neexistuje!');

$file = fopen($languageDir  . '/' . 'newfile.txt', 'w') or die("Unable to open file!");

$txt = "John Doe\n";
fwrite($file, $txt);

$txt = "Jane Doe\n";
fwrite($file, $txt);

fclose($file);

?>