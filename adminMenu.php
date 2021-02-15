<?php require_once($_SERVER["DOCUMENT_ROOT"].'/MindQuiz2/library/main.php');

reqlib('database');
reqlib('language');

?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>

    <select name="language">
        <?php getLanguageOptions() ?>
    </select>

    <select name="translationLanguage">
        <?php getLanguageOptions() ?>
    </select>
    
</body>
</html>