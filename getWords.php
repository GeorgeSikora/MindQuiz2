<?php

if (!isset($_POST['word'])) return;
if (!isset($_POST['languageId'])) return;

require_once($_SERVER["DOCUMENT_ROOT"].'/MindQuiz2/library/main.php');

reqlib('database');

$word = $_POST['word'];
$languageId = $_POST['languageId'];

$words = SQL("SELECT * FROM words WHERE word LIKE ? AND languageId = ?", [$word.'%', $languageId]);

echo json_encode($words);

?>