<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/MindQuiz2/library/main.php');
reqlib('database');

/* INPUT VALUES */

$langName = "czech";
$targetLangName = "english";

$word = "postel";
$translation = "bed";

$difficult = 1;

/* PROGRAM */

$lang = SQL("SELECT * FROM languages WHERE englishName = ?", [$langName])[0];
$targetLang = SQL("SELECT * FROM languages WHERE englishName = ?", [$targetLangName])[0];

print_r($lang); echo '<br>';
print_r($targetLang); echo '<br>';

$wordId = SQL("INSERT INTO words (word, languageId) VALUES (?, ?)", [$word, $lang['id']]);
$translationId = SQL("INSERT INTO words (word, languageId) VALUES (?, ?)", [$translation, $targetLang['id']]);

SQL("INSERT INTO translations VALUES (0,?,?,?)", [$wordId, $translationId, $difficult]);
SQL("INSERT INTO translations VALUES (0,?,?,?)", [$translationId, $wordId, $difficult]);

?>