<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/MindQuiz2/library/main.php');
reqlib('database');

SQL("DELETE FROM translations");
SQL("DELETE FROM words");

?>