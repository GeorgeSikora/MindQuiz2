<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/MindQuiz2/library/main.php');
reqlib('database');

/* INPUT VALUES */

$langId = 2; // id for czech
$translationLangId = 1; // id for english

$word = "postel";
$translation = "bed";

$difficult = 1;

/* PROGRAM */

$wordId = SQL("INSERT INTO words (word, languageId) VALUES (?, ?)", [$word, $langId]);
$translationId = SQL("INSERT INTO words (word, languageId) VALUES (?, ?)", [$translation, $translationLangId]);

SQL("INSERT INTO translations VALUES (0,?,?,?)", [$wordId, $translationId, $difficult]);
SQL("INSERT INTO translations VALUES (0,?,?,?)", [$translationId, $wordId, $difficult]);

?>