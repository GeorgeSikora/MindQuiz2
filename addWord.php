<?php

if (!isset($_POST['langId'])) return;
if (!isset($_POST['translationLangId'])) return;

if (!isset($_POST['word'])) return;
if (!isset($_POST['translation'])) return;

require_once($_SERVER["DOCUMENT_ROOT"].'/MindQuiz2/library/main.php');
reqlib('database');

/* INPUT VALUES */

$langId = $_POST['langId']; // id for czech
$translationLangId = $_POST['translationLangId']; // id for english

$word = $_POST['word'];
$translation = $_POST['translation'];

$difficult = 1;

/* PROGRAM */

$wordExists = false;
$translationExists = false;

if (count($words = SQL("SELECT id FROM words WHERE word = ? AND languageId = ?", [$word, $langId])) > 0) {
    $wordId = $words[0]['id'];
    $wordExists = true;
} else {
    $wordId = SQL("INSERT INTO words (word, languageId) VALUES (?, ?)", [$word, $langId]);
}

if (count($words = SQL("SELECT id FROM words WHERE word = ? AND languageId = ?", [$translation, $translationLangId])) > 0) {
    $translationId = $words[0]['id'];
    $translationExists = true;
} else {
    $translationId = SQL("INSERT INTO words (word, languageId) VALUES (?, ?)", [$translation, $translationLangId]);
}

if ($wordExists && $translationExists) {
    echo 'překlad již existuje !';
    return;
}

SQL("INSERT INTO translations VALUES (0,?,?,?)", [$wordId, $translationId, $difficult]);
SQL("INSERT INTO translations VALUES (0,?,?,?)", [$translationId, $wordId, $difficult]);

echo 'success';

?>