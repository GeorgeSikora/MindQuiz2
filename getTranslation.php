<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/MindQuiz2/library/main.php');
reqlib('database');

/* INPUT VALUES */

$langName = "slovakia";
$targetLangName = "english";

$word = "bed";
$translation = "";

/* PROGRAM */

$lang = SQL("SELECT * FROM languages WHERE englishName = ?", [$langName])[0];
$targetLang = SQL("SELECT * FROM languages WHERE englishName = ?", [$targetLangName])[0];

print_r($lang); echo('<br>');
print_r($targetLang); echo('<br>');

$translations = SQL("SELECT w.id, w.languageId, t.translatedWordId, t.difficulty FROM words w JOIN translations t ON t.wordId = w.id WHERE w.word = ?", [$word]);

if (count($translations) == 0) {
    echo '<br>Nenašli jsme překlad na slovo <b>' . $word . '</b>';
}

foreach ($translations as $t) {

    $translatedWord = SQL("SELECT * FROM words WHERE id = ?", [$t['translatedWordId']])[0];

    $translation = $translatedWord['word'];

    echo '<br>Překlad slova <b>' . $word . '</b> je <b>' . $translation . '</b>';

    $wordLanguage = SQL("SELECT * FROM languages WHERE id = ?", [$t['languageId']])[0];
    $translatedWordLanguage = SQL("SELECT * FROM languages WHERE id = ?", [$translatedWord['languageId']])[0];

    echo '<br>Z jazyka <b>' . $wordLanguage['name'] . '</b> do <b>' . $translatedWordLanguage['name'] . '</b><br>';
}

?>