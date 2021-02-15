<?php require_once($_SERVER["DOCUMENT_ROOT"].'/MindQuiz2/library/main.php');
reqlib('database');

/*
$myObj = new \stdClass();
$myObj->name = "John";
$myObj->age = 30;
$myObj->city = "New York";
*/

if (!isset($_POST['word'])) return;
if (!isset($_POST['languageId'])) return;

$word = $_POST['word'];
$languageId = $_POST['languageId'];

$words = SQL("SELECT * FROM words WHERE word LIKE ? AND languageId = ?", [$word.'%', $languageId]);

$myJSON = json_encode($words);

echo $myJSON;

/*
$myArr = array("John", "Mary", "Peter", "Sally");
$myJSON = json_encode($myArr);
echo $myJSON;
*/

?>