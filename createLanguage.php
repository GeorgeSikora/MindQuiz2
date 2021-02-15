<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/MindQuiz2/library/main.php');
reqlib('database');

$name = 'polskie';
$englishName = 'polish';
$czechName = 'polština';

SQL('INSERT INTO languages VALUES (0,?,?,?)', [$name, $englishName, $czechName]);

?>